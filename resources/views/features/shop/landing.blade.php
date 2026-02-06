@section('title_web_page', 'Landing')

    <div>
        {{-- carousel section --}}
        <section>
            <div id="animation-carousel" class="relative" data-carousel="slider">
                <!-- Carousel wrapper -->
                <div class="relative h-72 overflow-hidden rounded-lg md:h-[780px]">
                    <!-- Item 1 -->
                    <div class="hidden duration-300 ease-linear" data-carousel-item>
                        <img src="{{ asset('assets/landing-banner.jpeg') }}"
                            class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                            alt="landing-banner">
                        <div
                            class="absolute block text-slate-800 h-full w-[524px] top-[30%] left-[60%] font-rufina leading-tight">
                            <p class="text-[22px] mb-[20px]">up to 30% discount</p>
                            <p class="text-[66px]">Interrior Minimal Room Style</p>
                            <button type="button"
                                class="px-[3rem] py-3 mr-[1rem] mb-2 mt-[80px] text-white bg-[#F4841A] hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium text-sm  hover:scale-110 transition duration-300 ease-in-out uppercase">Shop
                                Now
                            </button>
                        </div>
                    </div>
                    <!-- Item 2 -->
                    <div class="hidden duration-300 ease-linear" data-carousel-item>
                        <img src="{{ asset('assets/landing-banner-2.png') }}"
                            class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                            alt="landing-banner">
                        <div
                            class="absolute block text-slate-800 h-full w-[524px] top-[30%] left-[60%] font-rufina leading-tight">
                            <p class="text-[22px] capitalize mb-[20px]">up to 40% discount</p>
                            <p class="text-[66px] capitalize">Living Room Loft
                                In Industrial</p>
                            <button type="button"
                                class="px-[3rem] py-3 mr-[1rem] mb-2 mt-[80px] text-white bg-[#F4841A] hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium text-sm  hover:scale-110 transition duration-300 ease-in-out uppercase">Shop
                                Now</button>
                        </div>
                    </div>

                    {{-- item 3 --}}
                    <div class="hidden duration-300 ease-linear" data-carousel-item>
                        <img src="{{ asset('assets/parallax01.jpeg') }}"
                            class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
                            alt="landing-banner">
                        <div
                            class="absolute block text-slate-800 h-full w-[524px] top-[30%] left-[60%] font-rufina leading-tight">
                            <p class="text-[22px] capitalize mb-[20px]">up to 40% discount</p>
                            <p class="text-[66px] capitalize">Living Room Loft
                                In Industrial</p>
                            <button type="button"
                                class="px-[3rem] py-3 mr-[1rem] mb-2 mt-[80px] text-white bg-[#F4841A] hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium text-sm  hover:scale-110 transition duration-300 ease-in-out uppercase">Shop
                                Now</button>
                        </div>
                    </div>
                    <!-- Slider controls -->
                    <button type="button"
                        class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                        data-carousel-prev>
                        <span
                            class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7">
                                </path>
                            </svg>
                            <span class="sr-only">Previous</span>
                        </span>
                    </button>
                    <button type="button"
                        class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
                        data-carousel-next>
                        <span
                            class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                            <span class="sr-only">Next</span>
                        </span>
                    </button>
                </div>
            </div>
        </section>
        {{-- end carousel section --}}

        {{-- image product op --}}
        <section class="my-[100px]">
            <div class="container mx-auto flex flex-row justify-center space-x-[3rem]">
                <div class="relative overflow-hidden h-[310px] cursor-pointer">
                    <div style="background-image: url('assets/op-product-image.png')"
                        class="w-[635px] h-[345px] bg-center bg-no-repeat bg-cover hover:scale-110 transition duration-300 ease-in-out">
                    </div>
                    <div class="w-[281px] h-full absolute block left-1/2 top-1/4">
                        <p class="text-[15px] capitalize font-open-sans pb-5">up to 30% of</p>
                        <p class="text-[34px] capitalize font-rufina">Treakwood Ratan Archnair</p>
                    </div>
                </div>
                <div class="relative overflow-hidden h-[310px] cursor-pointer">
                    <div style="background-image: url('assets/op-product-image-2.png')"
                        class="w-[635px] h-[345px] bg-center bg-no-repeat bg-cover hover:scale-110 transition duration-300 ease-in-out">
                    </div>
                    <div class="w-[281px] h-full absolute block left-1/2 top-1/4">
                        <p class="text-[15px] capitalize font-open-sans pb-5">up to 20% of</p>
                        <p class="text-[34px] capitalize font-rufina">Table with hunch Cabinet</p>
                    </div>
                </div>
            </div>
        </section>
        {{-- end image product --}}

        {{-- Best selling product --}}
        <x-best-product />
        {{--end best product --}}

        {{-- about section --}}
        <x-about />
        {{-- end about section --}}

        {{-- parralax banner --}}
        <section class="h-[718px] w-full mb-[100px]">
            <div style="background-image: url('assets/parallax-img.png')"
                class=" h-[718px] bg-center bg-no-repeat bg-cover bg-fixed flex justify-start items-center">
                <div class="parallax-content w-[1300px] pl-[300px]">
                    <div class="w-[555px] leading-tight">
                        <p class="text-[22px] mb-[20px]">up to 30% discount</p>
                        <p class="text-[60px] font-semibold font-rufina">Empty Living Room
                            & Blue Sofa</p>
                        <button type="button"
                            class="text-white bg-[#F4841A] hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium text-sm px-[3rem] py-3 mr-2 mb-2 mt-[80px] hover:scale-110 transition duration-300 ease-in-out uppercase">Shop
                            Now</button>
                    </div>
                </div>
            </div>
        </section>
        {{-- end parralax banner --}}

        {{-- featured collection start --}}
        <x-featured-collection />
        {{-- featured collection end --}}

        {{-- blog --}}
        <x-blog />
        {{-- end blog --}}
    </div>
