<?php

namespace App\Http\Livewire;

use App\Services\PaymentService;
use App\Services\CartService;
use Livewire\Component;
use Illuminate\Support\Str;
use Exception;

class Payment extends Component
{
    public string $shipping_method = 'standard';
    public string $shipping_address = '';
    public float $shipping_price = 20;
    public float $payment = 0;
    public string $expiry = '';
    public string $card_number = '';
    public string $card_holder_name = '';
    public string $cvv = '';

    protected PaymentService $paymentService;
    protected CartService $cartService;

    /**
     * Validation rules
     */
    protected array $rules = [
        'card_number' => ['required', 'string', 'size:16', 'regex:/^[0-9]+$/'],
        'card_holder_name' => ['required', 'string', 'max:255'],
        'cvv' => ['required', 'string', 'min:3', 'max:4'],
        'expiry' => ['required', 'string', 'regex:/^(0[1-9]|1[0-2])\/([0-9]{2})$/'],
        'shipping_method' => ['required', 'in:jne,pos,tiki,exclusive,standard'],
        'shipping_address' => ['required', 'string', 'max:500'],
    ];

    /**
     * Custom validation messages
     */
    protected array $messages = [
        'card_number.size' => 'Card number must be exactly 16 digits.',
        'card_number.regex' => 'Card number must contain only numbers.',
        'expiry.regex' => 'Expiry must be in MM/YY format.',
    ];

    /**
     * Boot method for dependency injection
     */
    public function boot(PaymentService $paymentService, CartService $cartService): void
    {
        $this->paymentService = $paymentService;
        $this->cartService = $cartService;
    }

    /**
     * Mount component with initial data
     */
    public function mount(): void
    {
        $this->shipping_method = request()->shipping_method ?? 'jne';
        $this->shipping_address = request()->shipping_address ?? 'Jakarta';
        $this->shipping_price = (float) (request()->shipping_price ?? 0);
        
        if ($this->shipping_price <= 0) {
            $this->calculateShippingPrice();
        }
        
        $this->calculatePayment();
    }

    /**
     * Submit payment using PaymentService
     */
    public function submitPayment(): mixed
    {
        // Validate input
        $this->validate();

        // Sanitize card number - remove any non-numeric characters
        $this->card_number = preg_replace('/[^0-9]/', '', $this->card_number);
        $this->cvv = preg_replace('/[^0-9]/', '', $this->cvv);
        $this->card_holder_name = strip_tags(trim($this->card_holder_name));
        $this->shipping_address = strip_tags(trim($this->shipping_address));

        // Generate idempotency key for this payment
        $idempotencyKey = $this->generateIdempotencyKey();

        try {
            $user = auth()->user();
            $cartItems = $this->cartService->getCartItems($user->id);

            if ($cartItems->isEmpty()) {
                session()->flash('error', 'Your cart is empty.');
                return to_route('shopping-cart');
            }

            // Parse expiry date
            list($expMonth, $expYear) = explode('/', $this->expiry);

            // Prepare payment data
            $paymentData = [
                'user_id' => $user->id,
                'email' => $user->email,
                'name' => $user->first_name . ' ' . $user->last_name,
                'amount' => $this->payment,
                'shipping_address' => $this->shipping_address,
                'shipping_price' => $this->shipping_price,
                'shipping_method' => $this->shipping_method,
                'card_info' => [
                    'number' => $this->card_number,
                    'exp_month' => (int) $expMonth,
                    'exp_year' => (int) ('20' . $expYear),
                    'cvc' => $this->cvv,
                    'name' => $this->card_holder_name,
                ],
            ];

            // Process payment via service
            $result = $this->paymentService->processPayment($paymentData, $idempotencyKey);

            if ($result['success']) {
                session()->flash('message', $result['message'] ?? 'Payment successful!');
                
                if ($result['idempotent'] ?? false) {
                    session()->flash('info', 'This payment was already processed.');
                }
            } else {
                session()->flash('error', $result['message'] ?? 'Payment failed.');
            }

            return to_route('info-status');

        } catch (Exception $e) {
            session()->flash('error', 'Payment processing error: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Calculate shipping price based on method
     */
    public function calculateShippingPrice(): float
    {
        $weight = $this->cartService->getCartWeight(auth()->id());
        $this->shipping_price = app(\App\Contracts\Services\LogisticsServiceInterface::class)
            ->calculateShippingRate($this->shipping_address, $weight, $this->shipping_method);
            
        return $this->shipping_price;
    }

    /**
     * Calculate total payment
     */
    public function calculatePayment(): float
    {
        $userId = auth()->id();
        $this->payment = $this->paymentService->calculateTotal(
            $userId, 
            $this->shipping_method, 
            $this->shipping_address
        );
        return $this->payment;
    }

    /**
     * Generate unique idempotency key for payment
     */
    protected function generateIdempotencyKey(): string
    {
        return Str::uuid()->toString() . '_' . auth()->id() . '_' . time();
    }

    /**
     * Navigate back to shipping page
     */
    public function backToShippingPage(): mixed
    {
        return to_route('shipping', ['shipping_address' => $this->shipping_address]);
    }

    /**
     * Render the component
     */
    public function render()
    {
        $userId = auth()->id();
        $cartItems = $this->cartService->getCartItems($userId);
        $summary = $this->cartService->getCartSummary($userId, $this->shipping_method);

        return view('features.payment.payment', [
            'user_info' => $cartItems,
            'cart_summary' => $summary,
        ]);
    }
}

