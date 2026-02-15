@section('title_web_page', 'Your Artisan Cart — Furniqo')

<div class="bg-brand-cream min-h-screen font-satoshi py-10 lg:py-16 px-4 sm:px-6 lg:px-8">
    <div class="max-w-screen-xl mx-auto space-y-10">
        
        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 animate-fade-in-up">
            <div class="space-y-3">
                <div class="inline-flex items-center gap-2 px-3 py-1 bg-brand-orange/10 rounded-full border border-brand-orange/20">
                    <span class="w-1.5 h-1.5 rounded-full bg-brand-orange animate-pulse"></span>
                    <span class="text-[10px] font-black uppercase tracking-[0.2em] text-brand-orange">Secure Checkout</span>
                </div>
                <h1 class="text-4xl md:text-5xl font-black text-brand-dark tracking-tighter leading-tight">Your <span class="italic text-brand-orange font-light">Cart.</span></h1>
            </div>
            <a href="{{ route('shop') }}" class="group flex items-center gap-3 text-xs font-black uppercase tracking-widest text-brand-dark hover:text-brand-orange transition-colors">
                <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Continue Browsing
            </a>
        </div>

        @if($carts->count() > 0)
            <div class="grid grid-cols-1 xl:grid-cols-12 gap-10 items-start">
                
                {{-- Left: Cart Items --}}
                <div class="xl:col-span-8 space-y-6">
                    <div class="space-y-4">
                        @foreach ($carts as $cart)
                            @if($cart->user->id == auth()->user()->id)
                                <div class="bg-white rounded-[2rem] p-5 md:p-6 flex flex-col md:flex-row items-center gap-6 border border-brand-peach/30 shadow-sm hover:shadow-xl hover:shadow-brand-orange/5 transition-all group animate-fade-in-up" style="animation-delay: {{ $loop->index * 100 }}ms">
                                    {{-- Image --}}
                                    <div class="w-24 md:w-32 aspect-square rounded-2xl overflow-hidden bg-brand-cream border border-brand-peach/50 flex-shrink-0">
                                        <img src="{{ asset('storage/'. $cart->product->product_image) }}" alt="{{ $cart->product->product_name }}" 
                                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                    </div>

                                    {{-- Content --}}
                                    <div class="flex-1 space-y-3 text-center md:text-left">
                                        <div>
                                            <h3 class="text-xl font-black text-brand-dark tracking-tight line-clamp-1 capitalize">{{ $cart->product->product_name }}</h3>
                                            @if($cart->sku)
                                                <div class="flex flex-wrap items-center justify-center md:justify-start gap-1.5 mt-1.5">
                                                    @foreach($cart->sku->attributeValues as $val)
                                                        <span class="px-2.5 py-0.5 rounded-full bg-brand-cream text-[9px] font-black uppercase tracking-wider text-zinc-500 border border-brand-peach/30">
                                                            {{ $val->attribute->attribute_name }}: {{ $val->attribute_value_name }}
                                                        </span>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </div>

                                        {{-- Quantity Controls --}}
                                        <div class="flex items-center justify-center md:justify-start">
                                            <div class="flex items-center bg-brand-cream/50 border border-brand-peach/30 rounded-xl overflow-hidden p-0.5">
                                                <button wire:click="decrementQuantity({{ $cart->cart_id }}, {{ $cart->product->product_id }})" 
                                                        class="h-8 w-8 flex items-center justify-center rounded-lg hover:bg-white text-zinc-400 hover:text-brand-dark transition-all">
                                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor font-black"><path d="M20 12H4" stroke-width="3"/></svg>
                                                </button>
                                                <span class="w-10 text-center text-sm font-black text-brand-dark tabular-nums">{{ $cart->quantity }}</span>
                                                <button wire:click="incrementQuantity({{ $cart->cart_id }}, {{ $cart->product->product_id }})" 
                                                        class="h-8 w-8 flex items-center justify-center rounded-lg hover:bg-white text-zinc-400 hover:text-brand-dark transition-all">
                                                    <svg class="h-3.5 w-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M12 4v16m8-8H4" stroke-width="3"/></svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Price & Total --}}
                                    <div class="md:text-right space-y-0.5">
                                        <p class="text-[9px] font-black text-brand-orange uppercase tracking-widest">Total Item</p>
                                        <p class="text-2xl font-black text-brand-dark tracking-tighter">Rp {{ number_format($cart->total_price, 0, ',', '.') }}</p>
                                        <p class="text-[10px] text-zinc-400 font-medium italic">Rp {{ number_format($cart->total_price / $cart->quantity, 0, ',', '.') }} / unit</p>
                                    </div>

                                    {{-- Delete --}}
                                    <button wire:click="deleteCart({{ $cart->cart_id }})" class="p-3.5 rounded-xl bg-brand-peach/10 text-zinc-400 hover:bg-red-50 hover:text-red-500 transition-all group/del">
                                        <svg class="h-4.5 w-4.5 group-hover/del:rotate-12 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" stroke-width="2"/></svg>
                                    </button>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    {{-- Bottom Options --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-6">
                        {{-- Special Instructions --}}
                        <div class="space-y-3">
                            <h4 class="text-base font-black text-brand-dark tracking-tight">Special Artisan Notes</h4>
                            <div class="relative group">
                                <textarea wire:model="special_instruction" rows="2" 
                                          placeholder="Any custom requests for your furniture?"
                                          class="w-full bg-white border border-brand-peach/50 rounded-2xl p-4 text-xs focus:ring-4 focus:ring-brand-orange/5 focus:border-brand-orange outline-none transition-all placeholder:text-zinc-300"></textarea>
                            </div>
                        </div>

                        {{-- Promo --}}
                        <div class="space-y-3">
                            <h4 class="text-base font-black text-brand-dark tracking-tight">Voucher Excellence</h4>
                            <div class="flex gap-2">
                                <input type="text" wire:model.defer="coupon_code" 
                                       placeholder="Enter code"
                                       class="flex-1 bg-white border border-brand-peach/50 rounded-xl px-4 py-3 text-xs focus:ring-2 focus:ring-brand-orange outline-none transition-all uppercase font-bold tracking-widest">
                                <button wire:click="applyCoupon" 
                                        class="px-6 py-3 bg-brand-dark text-white font-black rounded-xl hover:bg-brand-orange hover:shadow-lg hover:shadow-brand-orange/20 transition-all active:scale-95 text-[10px] uppercase">
                                    Apply
                                </button>
                            </div>
                            @if($coupon_message)
                                <p class="text-[9px] font-black uppercase tracking-widest {{ $is_coupon_valid ? 'text-green-600' : 'text-red-500' }} animate-fade-in-left">
                                   // {{ $coupon_message }}
                                </p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Right: Order Summary --}}
                <div class="xl:col-span-4 sticky top-6 animate-fade-in-right">
                    <div class="p-8 rounded-[2.5rem] bg-brand-dark text-white relative overflow-hidden shadow-2xl">
                        {{-- Decorative background --}}
                        <div class="absolute top-0 right-0 w-48 h-48 bg-brand-orange/20 rounded-full blur-[60px] -mr-24 -mt-24"></div>
                        <div class="absolute bottom-0 left-0 w-32 h-32 bg-brand-peach/10 rounded-full blur-[40px] -ml-16 -mb-16"></div>

                        <div class="relative z-10 space-y-6">
                            <h4 class="text-2xl font-black tracking-tighter">Order <span class="italic font-light text-brand-orange underline underline-offset-4 decoration-white/20">Summary.</span></h4>
                            
                            <div class="space-y-4 pt-4 border-t border-white/10">
                                <div class="flex items-center justify-between group">
                                    <span class="text-xs font-black text-zinc-500 uppercase tracking-widest group-hover:text-zinc-300 transition-colors">Subtotal</span>
                                    <span class="text-lg font-black tracking-tight tabular-nums group-hover:scale-105 transition-transform">Rp {{ number_format($subtotal_payment, 0, ',', '.') }}</span>
                                </div>
                                
                                <div class="flex items-center justify-between group">
                                    <span class="text-xs font-black text-zinc-500 uppercase tracking-widest group-hover:text-zinc-300 transition-colors">Shipping</span>
                                    <span class="text-[10px] italic text-brand-orange opacity-80 uppercase tracking-tighter">Calculated Next</span>
                                </div>

                                @if($discount_amount > 0)
                                    <div class="flex items-center justify-between py-2 px-3 bg-white/5 rounded-xl border border-white/10 animate-scale-in">
                                        <div class="flex items-center gap-2">
                                            <div class="w-1.5 h-1.5 rounded-full bg-green-500 animate-pulse"></div>
                                            <span class="text-[10px] font-black uppercase tracking-widest text-green-400">Discount</span>
                                        </div>
                                        <span class="text-base font-black text-green-400 tracking-tight">-Rp {{ number_format($discount_amount, 0, ',', '.') }}</span>
                                    </div>
                                @endif

                                <div class="h-px bg-white/10"></div>

                                <div class="flex items-end justify-between">
                                    <span class="text-base font-black tracking-tighter">Total Price</span>
                                    <div class="text-right">
                                        <p class="text-4xl font-black text-brand-orange tracking-tighter tabular-nums drop-shadow-xl">Rp {{ number_format($total_payment, 0, ',', '.') }}</p>
                                        <p class="text-[8px] text-zinc-500 uppercase tracking-widest font-black mt-0.5">VAT Included / No added fees</p>
                                    </div>
                                </div>
                            </div>

                            <div class="pt-6">
                                <a href="{{ route('info-status') }}" class="block text-center w-full py-5 bg-brand-orange text-white font-black text-xs uppercase tracking-[0.3em] rounded-2xl hover:bg-white hover:text-brand-dark shadow-2xl shadow-brand-orange/30 hover:shadow-white/20 transition-all duration-500 hover:-translate-y-1 active:scale-95">
                                    Checkout Now
                                </a>
                                <p class="text-[9px] text-center text-zinc-500 uppercase tracking-[0.15em] font-black mt-4 leading-relaxed">
                                    Secured by Furniqo Cloud Encryption<br>30-Day Happiness Guarantee
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        @else
            {{-- Empty State --}}
            <div class="bg-white rounded-[3rem] p-16 lg:p-24 border border-brand-peach/50 flex flex-col items-center justify-center text-center space-y-8 animate-fade-in-up">
                <div class="relative group">
                    <div class="absolute inset-0 bg-brand-orange/20 rounded-full blur-[100px] scale-150 group-hover:scale-110 transition-transform duration-1000"></div>
                    <div class="relative z-10 w-32 h-32 lg:w-40 lg:h-40 bg-brand-cream flex items-center justify-center rounded-[2.5rem] shadow-sm transform -rotate-6 group-hover:rotate-0 transition-transform duration-700">
                        <svg class="w-16 lg:w-20 h-16 lg:h-20 text-brand-orange/20" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" stroke-width="1"/></svg>
                    </div>
                </div>
                <div class="space-y-4 max-w-lg">
                    <h2 class="text-3xl lg:text-4xl font-black text-brand-dark tracking-tighter leading-none">Your artisanal treasure box is <span class="text-brand-orange italic font-light underline underline-offset-4 decoration-brand-peach/50">waiting.</span></h2>
                    <p class="text-zinc-500 text-sm leading-relaxed">Our curated collections of timeless furniture are just a few clicks away. Let's make your home beautiful together.</p>
                </div>
                <a href="{{ route('shop') }}" class="px-10 py-4 bg-brand-dark text-white font-black text-[10px] uppercase tracking-[0.3em] rounded-full hover:bg-brand-orange hover:shadow-2xl hover:shadow-brand-orange/30 transition-all active:scale-95 duration-500">
                    Discover Now
                </a>
            </div>
        @endif

    </div>
</div>
