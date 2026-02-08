<div class="max-w-screen-xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold text-foreground">Shopping Cart</h1>
        <a href="{{ route('dashboard') }}" class="text-sm font-medium text-muted-foreground hover:text-foreground transition-colors flex items-center">
            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Continue Shopping
        </a>
    </div>

    @if($carts->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">
            {{-- Cart Items Table --}}
            <div class="lg:col-span-2 space-y-4">
                <x-ui.card>
                    <div class="relative overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-muted/50 text-muted-foreground uppercase text-xs font-semibold border-b border-border">
                                <tr>
                                    <th class="px-6 py-4">Product</th>
                                    <th class="px-6 py-4 text-center">Quantity</th>
                                    <th class="px-6 py-4 text-right">Price</th>
                                    <th class="px-6 py-4 text-right">Total</th>
                                    <th class="px-6 py-4 text-right"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-border">
                                @foreach ($carts as $cart)
                                    @if($cart->user->id == auth()->user()->id)
                                        <tr class="hover:bg-muted/30 transition-colors">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center space-x-4">
                                                    <img src="{{ asset('storage/'. $cart->product->product_image) }}" alt="{{ $cart->product->product_name }}" 
                                                         class="h-16 w-16 rounded-md object-cover bg-muted/50">
                                                    <div>
                                                        <div class="font-medium text-foreground">{{ $cart->product->product_name }}</div>
                                                        @if($cart->sku)
                                                            <div class="flex items-center gap-2 mt-1">
                                                                @foreach($cart->sku->attributeValues as $val)
                                                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-medium bg-zinc-100 dark:bg-zinc-800 text-zinc-600 dark:text-zinc-400 border border-zinc-200 dark:border-zinc-700">
                                                                        {{ $val->attribute->attribute_name }}: {{ $val->attribute_value_name }}
                                                                    </span>
                                                                @endforeach
                                                            </div>
                                                            <div class="text-[10px] text-zinc-400 mt-1 font-mono uppercase">{{ $cart->sku->sku_code }}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <div class="flex items-center justify-center space-x-2">
                                                    <button wire:click="decrementQuantity({{ $cart->cart_id }}, {{ $cart->product->product_id }})" 
                                                            class="h-8 w-8 flex items-center justify-center rounded-md border border-input hover:bg-accent transition-colors">
                                                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M20 12H4" stroke-width="2"/></svg>
                                                    </button>
                                                    <span class="w-8 text-center font-medium">{{ $cart->quantity }}</span>
                                                    <button wire:click="incrementQuantity({{ $cart->cart_id }}, {{ $cart->product->product_id }})" 
                                                            class="h-8 w-8 flex items-center justify-center rounded-md border border-input hover:bg-accent transition-colors">
                                                        <svg class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 4v16m8-8H4" stroke-width="2"/></svg>
                                                    </button>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-right text-muted-foreground font-medium">
                                                Rp {{ number_format($cart->total_price / $cart->quantity, 0, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4 text-right text-foreground font-bold">
                                                Rp {{ number_format($cart->total_price, 0, ',', '.') }}
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <button wire:click="deleteCart({{ $cart->cart_id }})" class="p-2 rounded-md hover:bg-destructive/10 text-muted-foreground hover:text-destructive transition-colors">
                                                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-width="2"/></svg>
                                                </button>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </x-ui.card>

                {{-- Special Instruction --}}
                <div class="space-y-2">
                    <label for="message" class="text-sm font-medium text-foreground">Order Special Instructions</label>
                    <textarea id="message" rows="3" wire:model="special_instruction"
                              placeholder="Any specific requests for delivery or packaging?"
                              class="flex min-h-[80px] w-full rounded-md border border-input bg-background px-3 py-2 text-sm ring-offset-background placeholder:text-muted-foreground focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50"></textarea>
                </div>

                {{-- Coupon Code --}}
                <div class="p-6 bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-800 rounded-2xl mt-6">
                    <label for="coupon_code" class="text-xs font-black uppercase tracking-widest text-[#F4841A] mb-3 block">Promotion Code</label>
                    <div class="flex gap-2">
                        <div class="relative flex-1">
                            <input type="text" id="coupon_code" wire:model.defer="coupon_code" 
                                placeholder="Enter coupon code"
                                class="w-full bg-white dark:bg-zinc-950 border border-zinc-200 dark:border-zinc-800 rounded-xl px-4 py-3 text-sm focus:ring-2 focus:ring-[#F4841A] focus:border-transparent outline-none transition-all">
                            @if($coupon_message)
                                <div class="absolute -bottom-6 left-0 text-[10px] font-bold {{ $is_coupon_valid ? 'text-green-500' : 'text-red-500' }}">
                                    {{ $coupon_message }}
                                </div>
                            @endif
                        </div>
                        <button wire:click="applyCoupon" 
                            class="px-6 py-3 bg-zinc-900 dark:bg-white text-white dark:text-zinc-900 font-bold rounded-xl hover:scale-105 active:scale-95 transition-all shadow-lg text-sm">
                            Apply
                        </button>
                    </div>
                </div>
            </div>

            {{-- Order Summary --}}
            <div class="lg:col-span-1">
                <x-ui.card title="Order Summary">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between text-muted-foreground">
                            <span>Subtotal</span>
                            <span class="text-foreground font-medium">Rp {{ number_format($subtotal_payment, 0, ',', '.') }}</span>
                        </div>
                        
                        @if($discount_amount > 0)
                            <div class="flex items-center justify-between text-green-600 dark:text-green-400 font-medium">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 11h.01M7 15h.01M13 7h.01M13 11h.01M13 15h.01M17 7h.01M17 11h.01M17 15h.01"/></svg>
                                    <span>Discount</span>
                                </div>
                                <span>-Rp {{ number_format($discount_amount, 0, ',', '.') }}</span>
                            </div>
                        @endif

                        <div class="flex items-center justify-between text-muted-foreground">
                            <span>Shipping</span>
                            <span class="text-xs italic">Calculated at checkout</span>
                        </div>
                        <div class="flex items-center justify-between text-muted-foreground">
                            <span>Tax</span>
                            <span class="text-xs italic">Included</span>
                        </div>
                        <div class="border-t border-border pt-4 mt-4">
                            <div class="flex items-center justify-between text-lg font-bold">
                                <span>Total</span>
                                <span class="text-[#F4841A]">Rp {{ number_format($total_payment, 0, ',', '.') }}</span>
                            </div>
                        </div>
                        <x-ui.button href="{{ route('info-status') }}" class="w-full h-12 text-base mt-4">
                            Checkout Now
                        </x-ui.button>
                        <p class="text-[10px] text-center text-muted-foreground uppercase tracking-widest pt-2">
                            Secure payment processing
                        </p>
                    </div>
                </x-ui.card>
            </div>
        </div>
    @else
        <x-ui.card class="py-16">
            <div class="flex flex-col items-center justify-center space-y-4">
                <div class="h-16 w-16 rounded-full bg-muted flex items-center justify-center">
                    <svg class="h-8 w-8 text-muted-foreground" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" stroke-width="2"/></svg>
                </div>
                <div class="text-center">
                    <h2 class="text-xl font-semibold">Your cart is empty</h2>
                    <p class="text-muted-foreground max-w-xs mx-auto mt-2">Looks like you haven't added anything to your cart yet. Discover our collection and find something beautiful for your home.</p>
                </div>
                <x-ui.button variant="outline" href="{{ route('dashboard') }}" class="mt-4">
                    Browser Collection
                </x-ui.button>
            </div>
        </x-ui.card>
    @endif
</div>
