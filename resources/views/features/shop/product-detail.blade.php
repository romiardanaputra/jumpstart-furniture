@section('title_web_page', 'Product Detail')
<div>
    <section>
        <div style="background-image: url('/assets/landing-banner-2.png')"
            class="bg-center bg-no-repeat bg-cover bg-fixed h-[300px] w-full">
            <div style="background-color: rgba(0,0,0,0.3)" class="h-[300px] w-full flex justify-center items-center">
                <div class="banner-text text-white opacity-100 text-center">
                    <p class="font-rufina text-[2rem]">Product Detail</p>
                    <p class="font-open-sans text-[15px]">Home | Product Detail</p>
                </div>
            </div>
        </div>
    </section>

    <section class="container mx-auto py-[100px] font-open-sans text-[14px]">
        <div class="flex flex-row space-x-[50px]">
            <div style="background-image:url('{{ asset('storage/'.$product->product_image) }}')"
                class="h-[700px] w-[585px] bg-center bg-no-repeat bg-cover"></div>
            <div class="product-content w-[685px] flex flex-col space-y-[1rem]">
                <h3 class="text-[28px] capitalize">{{ $product->product_name }}</h3>
                <div class="flex flex-row space-x-1">
                    @for($i = 0; $i < $product->product_rating; $i++)
                        <i class="fa-sharp fa-solid fa-star text-[#F4841A]"></i>
                        @endfor
                </div>
                <p class="text-[22px]">${{ $product->product_price }}</p>
                <p class="leading-relaxed text-justify">{{ $product->product_short_description }}</p>
                <p>Type : {{ $product->product_type }}</p>
                <p>Sku : {{ $product->product_sku }}</p>
                <p>Vendor : {{ $product->product_vendor }}</p>
                <p>Availability : {{ $product->product_availability }}</p>
                <p>Tags : {{ $product->product_tags }}</p>
                <p>Color : {{ $product->product_color }}</p>
                <div class="flex flex-row w-full space-x-[2rem]">
                    <button wire:click="store_cart({{ $product->product_id }}, {{ $product->product_price }})" type="submit"
                        class="w-full  py-3 mr-[1rem] mb-2 mt-[25px] text-white bg-[#F4841A] hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium text-sm  hover:scale-110 transition duration-300 ease-in-out uppercase">add
                        to cart
                    </button>

                    <button wire:click="store_cart_and_buy({{ $product->product_id }}, {{ $product->product_price }})" type="submit"
                        class="w-full  py-3 mr-[1rem] mb-2 mt-[25px] text-white bg-[#F4841A] hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium text-sm  hover:scale-110 transition duration-300 ease-in-out uppercase">buy
                        it now
                    </button>
                </div>
                <div id="accordion-flush" data-accordion="collapse"
                    data-active-classes="bg-white dark:bg-gray-900 text-gray-900 dark:text-white"
                    data-inactive-classes="text-gray-500 dark:text-gray-400">
                    <h2 id="accordion-flush-heading-1">
                        <button type="button"
                            class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400"
                            data-accordion-target="#accordion-flush-body-1" aria-expanded="true"
                            aria-controls="accordion-flush-body-1">
                            <span class="uppercase">Shipping & Return</span>
                            <svg data-accordion-icon class="w-6 h-6 rotate-180 shrink-0" fill="currentColor"
                                viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-flush-body-1" class="hidden" aria-labelledby="accordion-flush-heading-1">
                        <div class="py-5 font-light border-b border-gray-200 dark:border-gray-700">
                            <p class="mb-2 text-gray-500 dark:text-gray-400">{{ $product->product_shipping_and_return }}
                            </p>
                        </div>
                    </div>
                    <h2 id="accordion-flush-heading-2">
                        <button type="button"
                            class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400"
                            data-accordion-target="#accordion-flush-body-2" aria-expanded="false"
                            aria-controls="accordion-flush-body-2">
                            <span class="uppercase">Material</span>
                            <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-flush-body-2" class="hidden" aria-labelledby="accordion-flush-heading-2">
                        <div class="py-5 font-light border-b border-gray-200 dark:border-gray-700">
                            <p class="mb-2 text-gray-500 dark:text-gray-400">{{ $product->product_material }}</p>
                        </div>
                    </div>
                    <h2 id="accordion-flush-heading-3">
                        <button type="button"
                            class="flex items-center justify-between w-full py-5 font-medium text-left text-gray-500 border-b border-gray-200 dark:border-gray-700 dark:text-gray-400"
                            data-accordion-target="#accordion-flush-body-3" aria-expanded="false"
                            aria-controls="accordion-flush-body-3">
                            <span class="uppercase">description</span>
                            <svg data-accordion-icon class="w-6 h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </h2>
                    <div id="accordion-flush-body-3" class="hidden" aria-labelledby="accordion-flush-heading-3">
                        <div class="py-5 font-light border-b border-gray-200 dark:border-gray-700">
                            <p class="mb-2 text-gray-500 dark:text-gray-400">{{ $product->product_long_description }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pb-[50px]">
        <x-best-product />
    </section>
</div>