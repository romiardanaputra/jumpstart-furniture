<div class="w-1/2 flex flex-col space-y-10 px-10">
    <section class="w-full">
        @foreach($items as $item)
        @if($item->user_id == auth()->user()->id)
        <div class=" w-full checkout-card flex flex-row space-x-8 items-center ">
            <div class="h-24 w-44 flex items-center">
                <img src="{{ asset('storage/'. $item->product->product_image) }}"
                    alt="{{ $item->product->product_name }}" class="">
            </div>
            <div class="checkout-card-content w-full">
                <p class="capitalize">{{ $item->product->product_name }}</p>
                <p class="capitalize">{{ $item->product->product_color }}</p>
                <p class="">${{ $item->product->product_price }} x {{ $item->quantity }}</p>

            </div>
            <div class="pl-[64px] w-full flex justify-end">
                <p class="">${{ $item->total_price }}</p>
            </div>
        </div>
        @endif
        @endforeach
        <hr class="my-8 h-px bg-gray-200 border-1 dark:bg-gray-700">
        <div class="w-full flex flex-row justify-between">
            <p wire:click="sub_total" class="cursor-pointer">Subtotal</p>
            <p>${{ $total }}</p>
        </div>
        <div class="w-full flex flex-row justify-between">
            <p>Shipping</p>
            @if (Request::is('payment'))
            <p class="font-semibold"> ${{ $shipping_price }}</p>
            @else
            <p>Calculated In Next Step</p>
            @endif
        </div>
        <hr class="my-8 h-px bg-gray-200 border-1 dark:bg-gray-700">
        <div class="w-full flex flex-row justify-between">
            <p class="font-bold">Total</p>
            @if (Request::is('payment'))
            <p class="text-[28px] font-bold">USD ${{ $payment }}</p>
            @else
            <p class="text-[28px] font-bold">USD ${{ $total }}</p>
            @endif
        </div>
    </section>
</div>