<?php

namespace App\Http\Livewire;

use App\Models\Cart as ModelsCart;
use Livewire\Component;

class Shipping extends Component
{
    public $shipping_address;
    public $shipping_method;
    public $availableCouriers = [];
    public $selectedCourier = 'jne';
    public $shippingRate = 0;
    public $totalWeight = 0;

    protected $logisticsService;
    protected $cartService;

    public function boot(
        \App\Contracts\Services\LogisticsServiceInterface $logisticsService,
        \App\Services\CartService $cartService
    ) {
        $this->logisticsService = $logisticsService;
        $this->cartService = $cartService;
    }

    public function mount()
    {
        $this->shipping_address = request()->shipping_address ?? 'Jakarta';
        $this->totalWeight = $this->cartService->getCartWeight(auth()->id());
        $this->availableCouriers = $this->logisticsService->getAvailableCouriers($this->shipping_address);
        $this->calculateRate();
    }

    public function updatedSelectedCourier()
    {
        $this->calculateRate();
    }

    protected function calculateRate()
    {
        $this->shippingRate = $this->logisticsService->calculateShippingRate(
            $this->shipping_address,
            $this->totalWeight,
            $this->selectedCourier
        );
    }

    public function back_to_info_status_page()
    {
        return to_route('info-status');
    }

    public function payment()
    {
        return to_route('payment', [
            'shipping_method' => $this->selectedCourier,
            'shipping_address' => $this->shipping_address,
            'shipping_price' => $this->shippingRate,
        ]);
    }

    public function render()
    {
        return view('features.payment.shipping', [
            'data_shipping' => ModelsCart::where('user_id', auth()->user()->id)->get(),
        ]);
    }
}
