<div>
    <section class="container mx-auto my-[50px]">
        <h2 class="capitalize text-[38px] text-center font-rufina mb-[29px]">best selling products</h3>
            <div class="grid grid-cols-5 gap-3 px-[110px]">
                @foreach($products as $product)
                @isset($product)
                <div class="product-item relative overflow-hidden cursor-pointer w-[236px] h-[422px]">
                    <div class="h-[288px] w-full bg-[#f6f6f6]">
                        <a href="{!! route('product-detail', $product->product_id) !!}">
                            <img class="hover:scale-110 transition duration-300 ease-in-out"
                                src="{{ asset('storage/'. $product->product_image) }}"
                                alt="{{ $product->product_name }}">
                            <div class="font-open-sans text-[14px] capitalize h-[127px]">
                                @for($i = 0 ; $i < $product->product_rating; $i++ )
                                    <i class="fa-sharp fa-solid fa-star text-[#F4841A] mt-[17px]"></i>
                                    @endfor
                                    <p class="my-[8px]">{{ $product->product_name }}</p>
                                    <p class="font-bold">${{ $product->product_price }}</p>
                            </div>
                        </a>
                    </div>
                </div>
                @else
                <div class="text-sm text-[28px]">No Product Found</div>
                @endisset
                @endforeach
            </div>
    </section>
</div>