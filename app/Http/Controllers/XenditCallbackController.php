<?php

namespace App\Http\Controllers;

use App\Contracts\Repositories\CheckoutRepositoryInterface;
use App\Contracts\Repositories\CartRepositoryInterface;
use App\Contracts\Services\XenditServiceInterface;
use App\Contracts\Services\InventoryServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class XenditCallbackController extends Controller
{
    protected XenditServiceInterface $xenditService;
    protected CheckoutRepositoryInterface $checkoutRepo;
    protected CartRepositoryInterface $cartRepo;
    protected InventoryServiceInterface $inventoryService;

    public function __construct(
        XenditServiceInterface $xenditService,
        CheckoutRepositoryInterface $checkoutRepo,
        CartRepositoryInterface $cartRepo,
        InventoryServiceInterface $inventoryService
    ) {
        $this->xenditService = $xenditService;
        $this->checkoutRepo = $checkoutRepo;
        $this->cartRepo = $cartRepo;
        $this->inventoryService = $inventoryService;
    }

    public function handle(Request $request)
    {
        $payload = $request->all();
        $token = $request->header('x-callback-token');

        if (!$this->xenditService->validateCallback($payload, $token)) {
            Log::warning('Xendit Callback Validation Failed', [
                'payload' => $payload,
                'token' => $token
            ]);
            return response()->json(['message' => 'Invalid token'], 401);
        }

        $externalId = $payload['external_id'];
        $status = $payload['status'];

        Log::info('Xendit Callback Received', [
            'external_id' => $externalId,
            'status' => $status
        ]);

        if ($status === 'PAID') {
            return $this->handlePaidInvoice($externalId);
        }

        if ($status === 'EXPIRED') {
            return $this->handleExpiredInvoice($externalId);
        }

        return response()->json(['message' => 'Status handled']);
    }

    protected function handlePaidInvoice(string $externalId)
    {
        return DB::transaction(function () use ($externalId) {
            // Find all checkouts related to this invoice
            // Note: In our current schema, we might need a dedicated Order model
            // For now, we update all checkouts with this external_id
            $checkouts = DB::table('checkouts')
                ->where('xendit_external_id', $externalId)
                ->get();

            if ($checkouts->isEmpty()) {
                Log::error('No checkouts found for Xendit external_id', ['external_id' => $externalId]);
                return response()->json(['message' => 'Order not found'], 404);
            }

            foreach ($checkouts as $checkout) {
                // Update status to paid
                DB::table('checkouts')
                    ->where('checkout_id', $checkout->checkout_id)
                    ->update(['payment_status' => 'paid']);

                // Finalize stock deduction
                if ($checkout->sku_id) {
                    $this->inventoryService->deductStock($checkout->sku_id, 1);
                }
            }

            // Clear cart for the user
            $userId = $checkouts->first()->user_id;
            $this->cartRepo->clearByUserId($userId);

            Log::info('Order finalized via Xendit', ['external_id' => $externalId, 'user_id' => $userId]);

            return response()->json(['message' => 'Payment successful']);
        });
    }

    protected function handleExpiredInvoice(string $externalId)
    {
        DB::table('checkouts')
            ->where('xendit_external_id', $externalId)
            ->update(['payment_status' => 'expired']);

        Log::info('Order expired via Xendit', ['external_id' => $externalId]);

        return response()->json(['message' => 'Invoice expired handled']);
    }
}
