<?php

namespace App\Http\Livewire;

use App\Models\Cart as ModelsCart;
use App\Models\Checkout as ModelsCheckout;
use Livewire\Component;
use Stripe\Charge;
use Stripe\Customer;
use Stripe\Stripe;

class Payment extends Component
{
    public $shipping_method;

    public $shipping_address;

    public $shipping_price;

    public $payment;

    public $amount;

    public $expiry;

    public $card_number;

    public $card_holder_name;

    public $cvv;

    public function mount()
    {
        $this->shipping_method = request()->shipping_method;
        $this->shipping_address = request()->shipping_address;
        $this->shipping_price();
        $this->payment_calculation();
    }

    public function submitPayment()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $orders = ModelsCart::where('user_id', auth()->user()->id)->get();
        $customer = Customer::create([
            'email' => $orders[0]->user->email,
            'name' => $orders[0]->user->first_name . $orders[0]->user->last_name,
            'phone' => $orders[0]->user->contact,
        ]);

        $charge = Charge::create([
            'amount' => $this->payment * 100,
            'currency' => 'usd',
            'source' => [
                'object' => 'card',
                'number' => $this->card_number,
                'exp_month' => 12,
                'exp_year' => 25,
                'cvc' => $this->cvv,
                'name' => $this->card_holder_name,
            ],
        ]);

        if ($charge->paid) {
            session()->flash('message', 'Payment successful!');
            foreach ($orders as $order) {
                ModelsCheckout::create([
                    'user_id' => auth()->user()->id,
                    'product_id' => $order->product->product_id,
                    'cart_id' => $order->cart_id,
                    'shipping_address' => $this->shipping_address,
                    'shipping_price' => $this->shipping_price,
                    'shipping_method' => $this->shipping_method,
                    'payment_status' => 'paid',
                    'payment_total_per_item' => $this->payment,
                ]);
            }
        } else {
            session()->flash('error', 'Payment failed.');
        }

        return to_route('payment');
    }

    public function shipping_price()
    {
        return $this->shipping_price = ($this->shipping_method == 'exclusive' ? 40 : 20);
    }

    public function payment_calculation()
    {
        $total = ModelsCart::where('user_id', auth()->user()->id)->sum('total_price');
        $this->payment = $total + $this->shipping_price();

        return $this->payment;
    }

    public function back_to_shipping_page()
    {
        return to_route('shipping', $parameter = ['shipping_address' => $this->shipping_address]);
    }

    public function render()
    {
        return view('livewire.payment', [
            'user_info' => ModelsCart::where('user_id', auth()->user()->id)->get(),
        ]);
    }
}
