<?php

namespace App\Http\Livewire;

use App\Models\Cart as ModelsCart;
use Livewire\Component;

class Shipping extends Component
{
    public $shipping_address;
    public $selected_city; // RajaOngkir City ID
    public $cities = [];
    public $shipping_method;
    public $availableCouriers = [];
    public $selectedCourier = 'jne';
    public $shippingRate = 0;
    public $totalWeight = 0;

    protected $logisticsService;
    protected $cartService;
    protected $rajaOngkir;

    public function boot(
        \App\Contracts\Services\LogisticsServiceInterface $logisticsService,
        \App\Services\CartService $cartService,
        \App\Services\RajaOngkirService $rajaOngkir
    ) {
        $this->logisticsService = $logisticsService;
        $this->cartService = $cartService;
        $this->rajaOngkir = $rajaOngkir;
    }

    public function mount()
    {
        $this->shipping_address = request()->shipping_address ?? '';
        $this->totalWeight = $this->cartService->getCartWeight(auth()->id());
        
        // Load cities (cached for 24h)
        $this->cities = \Illuminate\Support\Facades\Cache::remember('rajaongkir_cities', 86400, function() {
            return $this->rajaOngkir->getCities();
        });

        // Default city if possible (e.g. Jakarta corresponds to city_id 151 or similar in RajaOngkir)
        // For simplicity, we let the user select.
        $this->selected_city = 151; // Default to Jakarta City
        
        $this->availableCouriers = $this->logisticsService->getAvailableCouriers((string)$this->selected_city);
        $this->calculateRate();
    }

    public function updatedSelectedCity()
    {
        $this->calculateRate();
    }

    public function getCityOptionsProperty()
    {
        return collect($this->cities)->mapWithKeys(function ($city) {
            return [$city['city_id'] => $city['type'] . ' ' . $city['city_name']];
        })->toArray();
    }

    public function updatedSelectedCourier()
    {
        $this->calculateRate();
    }

    protected function calculateRate()
    {
        if (!$this->selected_city) return;

        $this->shippingRate = $this->logisticsService->calculateShippingRate(
            (string)$this->selected_city,
            $this->totalWeight,
            $this->selectedCourier
        );
    }

    public function payment()
    {
        $this->validate([
            'selected_city' => 'required',
            'shipping_address' => 'required',
        ]);

        $cityName = collect($this->cities)->firstWhere('city_id', $this->selected_city)['city_name'] ?? 'Unknown City';

        return to_route('payment', [
            'shipping_method' => $this->selectedCourier,
            'shipping_address' => $cityName . ', ' . $this->shipping_address,
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
