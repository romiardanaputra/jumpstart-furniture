<?php

namespace App\Services;

use App\Contracts\Services\XenditServiceInterface;
use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;
use Xendit\Invoice\CreateInvoiceRequest;
use Exception;
use Illuminate\Support\Facades\Log;

class XenditService implements XenditServiceInterface
{
    protected InvoiceApi $invoiceApi;

    public function __construct()
    {
        Configuration::setXenditKey(config('services.xendit.secret_key'));
        $this->invoiceApi = new InvoiceApi();
    }

    public function createInvoice(array $data): array
    {
        try {
            $items = [];
            foreach ($data['items'] as $item) {
                $items[] = [
                    'name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price'],
                ];
            }

            $create_invoice_request = new CreateInvoiceRequest([
                'external_id' => $data['external_id'],
                'amount' => $data['amount'],
                'payer_email' => $data['payer_email'],
                'description' => $data['description'],
                'invoice_duration' => 86400, // 24 hours
                'currency' => 'IDR',
                'items' => $items,
                'success_redirect_url' => config('app.url') . '/payment/success',
                'failure_redirect_url' => config('app.url') . '/payment/failed',
            ]);

            $result = $this->invoiceApi->createInvoice($create_invoice_request);

            return [
                'invoice_url' => $result->getInvoiceUrl(),
                'invoice_id' => $result->getId(),
            ];
        } catch (Exception $e) {
            Log::error('Xendit Invoice Creation Failed', [
                'error' => $e->getMessage(),
                'data' => $data
            ]);
            throw $e;
        }
    }

    public function validateCallback(array $payload, string $token): bool
    {
        $verificationToken = config('services.xendit.callback_token');
        return $token === $verificationToken;
    }
}
