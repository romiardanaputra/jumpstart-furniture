@section('title_web_page','Manage Product')
<div>
    <section class="container w-1/2 mx-auto py-[100px]">
        <p class="text-[28px] font-open-sans font-semibold text-gray-500 capitalize">{{ $title_form }}</p>
        <form wire:submit.prevent="storeOrUpdateProduct">
            {{-- row 1 --}}
            <div class="flex flex-row justify-center space-x-5 py-5">
                <div class="w-full flex flex-row space-x-5">
                    {{-- product name --}}
                    <div class="w-full">
                        <div class="relative">
                            <input type="text" id="product_name"
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent  border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-[#f4841a] peer @error('product_name') border-red-600 focus:border-red-600 @enderror"
                                placeholder=" " name="product_name" wire:model="product_name"
                                value="{{ old('product_name') ? $product->product_name : "" }}" />
                            <label for="product_name"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-[#f4841a] peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1 @error('product_name') text-red-600 peer-focus:text-red-600  @enderror">
                                Product Name
                            </label>
                        </div>
                        @error('product_name')
                        <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                            <span class="font-medium">Oh, snapp! </span>{{ $message }}
                        </p>
                        @enderror
                    </div>

                    {{-- product type --}}
                    <div class="w-full">
                        <div class="relative w-full">
                            <input type="text" id="product_type"
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent  border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-[#f4841a] peer @error('product_type') border-red-600 focus:border-red-600  @enderror"
                                placeholder=" " name="product_type" wire:model="product_type"
                                value="{{ old('product_type') ? $product->product_type : "" }}" />
                            <label for="product_type"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-[#f4841a] peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1 @error('product_type') text-red-600 peer-focus:text-red-600 @enderror">
                                Type
                            </label>
                        </div>
                        @error('product_type')
                        <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                            <span class="font-medium">Oh, snapp! </span>{{ $message }}
                        </p>
                        @enderror
                    </div>

                </div>
            </div>
            {{-- row 2 --}}
            <div class="w-full flex space-x-5">
                {{-- prodcuct sku --}}
                <div class="w-full py-4">
                    <div class=" w-full">
                        <div class="relative w-full">
                            <input type="text" id="product_sku"
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent  border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-[#f4841a] peer @error('product_sku') border-red-600 focus:border-red-600  @enderror"
                                placeholder=" " wire:model="product_sku" name="product_sku"
                                value="{{ old('product_sku') ? $product->product_sku : "" }}" />
                            <label for="product_sku"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-[#f4841a] peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1 @error('product_sku') text-red-600 peer-focus:text-red-600 @enderror">Sku</label>
                        </div>
                    </div>
                    @error('product_sku')
                    <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                        <span class="font-medium">Oh, snapp! </span>{{ $message }}
                    </p>
                    @enderror
                </div>

                {{-- product vendor --}}
                <div class="py-4 w-full">
                    <div class=" w-full">
                        <div class="relative w-full">
                            <input type="text" id="product_vendor"
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent  border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-[#f4841a] peer @error('product_vendor') border-red-600 focus:border-red-600  @enderror"
                                placeholder=" " name="product_vendor" wire:model="product_vendor"
                                value="{{ old('prodcut_vendor') ? $product->product_vendor : "" }}" />
                            <label for="product_vendor"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-[#f4841a] peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1 @error('product_vendor') text-red-600 peer-focus:text-red-600 @enderror">Vendor</label>
                        </div>
                    </div>
                    @error('product_vendor')
                    <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                        <span class="font-medium">Oh, snapp! </span>{{ $message }}
                    </p>
                    @enderror
                </div>

                {{-- product availability --}}
                <div class="w-full py-4">
                    <div class="w-full">
                        <div class="relative w-full">
                            <input type="text" id="product_availability"
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent  border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-[#f4841a] peer @error('product_availability') border-red-600 focus:border-red-600  @enderror"
                                placeholder=" " name="product_availability" wire:model="product_availability"
                                value="{{ old('prodcut_availability') ? $product->product_availability : "" }}" />
                            <label for="product_availability"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-[#f4841a] peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1 @error('product_availability') text-red-600 peer-focus:text-red-600 @enderror">Availability</label>
                        </div>
                    </div>
                    @error('product_availability')
                    <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                        <span class="font-medium">Oh, snapp! </span>{{ $message }}
                    </p>
                    @enderror
                </div>

                {{-- product rating --}}
                <div class="py-4 w-full">
                    <div class="w-full">
                        <div class="relative w-full">
                            <input type="text" id="product_rating"
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent  border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-[#f4841a] peer @error('product_availability') border-red-600 focus:border-red-600  @enderror"
                                placeholder=" " name="product_rating" wire:model="product_rating"
                                value="{{ old('product_rating') ? $product->product_rating : "" }}" />
                            <label for="product_rating"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-[#f4841a] peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1 @error('product_availability') text-red-600 peer-focus:text-red-600 @enderror">Rating</label>
                        </div>
                    </div>
                    @error('product_availability')
                    <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                        <span class="font-medium">Oh, snapp! </span>{{ $message }}
                    </p>
                    @enderror
                </div>

            </div>

            {{-- row 3 --}}
            <div class="flex space-x-5">
                <div class="w-full py-4">
                    <div class="w-full">
                        <div class="relative w-full">
                            <input type="text" id="product_tags"
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent  border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-[#f4841a] peer @error('product_tags') border-red-600 focus:border-red-600  @enderror"
                                placeholder=" " name="product_tags" wire:model="product_tags"
                                value="{{ old('product_tags') ? $product->product_tags : "" }}" />
                            <label for="product_tags"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-[#f4841a] peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1 @error('product_tags') text-red-600 peer-focus:text-red-600 @enderror">Tags</label>
                        </div>
                    </div>
                    @error('product_tags')
                    <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                        <span class="font-medium">Oh, snapp! </span>{{ $message }}
                    </p>
                    @enderror
                </div>

                <div class="w-full py-4">
                    <div class="w-full">
                        <div class="relative w-full">
                            <input type="text" id="product_short_description"
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent  border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-[#f4841a] peer @error('product_short_description') border-red-600 focus:border-red-600  @enderror"
                                placeholder=" " name="product_short_description" wire:model="product_short_description"
                                value="{{ old('product_short_description') ? $product->product_short_description : "" }}" />
                            <label for="product_short_description"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-[#f4841a] peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1 @error('product_short_description') text-red-600 peer-focus:text-red-600 @enderror">Short
                                Description</label>
                        </div>
                    </div>
                    @error('product_short_description')
                    <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                        <span class="font-medium">Oh, snapp! </span>{{ $message }}
                    </p>
                    @enderror
                </div>

            </div>

            {{-- row 4 --}}
            <div class="flex space-x-5">
                <div class="w-full py-4">
                    <div class="w-full">
                        <div class="relative w-full">
                            <input type="text" id="product_material"
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent  border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-[#f4841a] peer  @error('product_material') border-red-600 focus:border-red-600  @enderror"
                                placeholder=" " name="product_material" wire:model="product_material"
                                value="{{ old('product_material') ? $product->product_material : "" }}" />
                            <label for="product_material"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-[#f4841a] peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1 @error('product_material') text-red-600 peer-focus:text-red-600 @enderror">Material</label>
                        </div>
                        @error('product_material')
                        <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                            <span class="font-medium">Oh, snapp! </span>{{ $message }}
                        </p>
                        @enderror
                    </div>
                </div>

                <div class="py-4 w-full">
                    <div class="relative w-full">
                        <input type="text" id="product_shipping_and_return"
                            class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent  border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-[#f4841a] peer @error('product_shipping_and_return') border-red-600 focus:border-red-600  @enderror"
                            placeholder=" " name="product_shipping_and_return" wire:model="product_shipping_and_return"
                            value="{{ old('product_shipping_and_return') ? $product->product_shipping_and_return : "" }}" />
                        <label for="product_shipping_and_return"
                            class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-[#f4841a] peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1 @error('product_shipping_and_return') text-red-600 peer-focus:text-red-600 @enderror">Shipping
                            and return
                            Product</label>
                    </div>
                    @error('product_shipping_and_return')
                    <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                        <span class="font-medium">Oh, snapp! </span>{{ $message }}
                    </p>
                    @enderror
                </div>
            </div>

            {{-- row5 --}}
            <div class="flex space-x-5 ">
                <div class="py-4 w-full">
                    <div class="relative w-full">
                        <input type="text" id="product_color"
                            class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent  border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-[#f4841a] peer @error('product_color') border-red-600 focus:border-red-600  @enderror"
                            placeholder=" " name="product_color" wire:model="product_color"
                            value="{{ old('product_color') ? $product->product_color : "" }}" />
                        <label for="product_color"
                            class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-[#f4841a] peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1 @error('product_color') text-red-600 peer-focus:text-red-600 @enderror">Color</label>
                    </div>
                    @error('product_color')
                    <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                        <span class="font-medium">Oh, snapp! </span>{{ $message }}
                    </p>
                    @enderror
                </div>
                {{-- discount product --}}
                <div class="py-4 w-1/2">
                    <div class="relative w-full">
                        <input type="text" id="product_discount"
                            class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent  border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-[#f4841a] peer @error('product_discount') border-red-600 focus:border-red-600  @enderror"
                            placeholder=" " name="product_discount" wire:model="product_discount"
                            value="{{ old('product_discount') ? $product->product_discount : "" }}" />
                        <label for="product_discount"
                            class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-[#f4841a] peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1 @error('product_discount') text-red-600 peer-focus:text-red-600 @enderror">Discount
                            Product</label>
                    </div>
                    @error('product_discount')
                    <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                        <span class="font-medium">Oh, snapp! </span>{{ $message }}
                    </p>
                    @enderror
                </div>
                <div class="py-4 w-1/2">
                    <div class="relative w-full">
                        <input type="text" id="product_discount"
                            class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent  border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-[#f4841a] peer @error('product_price') border-red-600 focus:border-red-600  @enderror"
                            placeholder=" " name="product_price" wire:model="product_price"
                            value="{{ old('product_price') ? $product->product_price : "" }}" />
                        <label for="product_price"
                            class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-[#f4841a] peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1 @error('product_price') text-red-600 peer-focus:text-red-600 @enderror">
                            Price Product
                        </label>
                    </div>
                    @error('product_price')
                    <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                        <span class="font-medium">Oh, snapp! </span>{{ $message }}
                    </p>
                    @enderror
                </div>
            </div>


            {{-- row7 --}}
            <div class="flex">
                {{-- product_long_description --}}
                <div class="py-4 w-full">
                    <p id="product_long_description" class="mt-1 mb-2 text-xs text-gray-500 dark:text-gray-400">More
                        complex description / additional details in the product</p>
                    <div class="relative w-full">
                        <input type="text" id="product_long_description"
                            class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent  border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-[#f4841a] peer @error('product_long_description') border-red-600 focus:border-red-600  @enderror"
                            placeholder=" " name="product_long_description" wire:model="product_long_description"
                            value="{{ old('product_long_description') ? $product->product_long_description : "" }}" />
                        <label for="product_long_description"
                            class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-[#f4841a] peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1 @error('product_long_description') text-red-600 peer-focus:text-red-600 @enderror">
                            Long Description
                        </label>
                    </div>
                    @error('product_long_description')
                    <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                        <span class="font-medium">Oh, snapp! </span>{{ $message }}
                    </p>
                    @enderror
                </div>
            </div>

            {{-- row8 --}}
            <div class="flex py-4">
                {{-- product image upload --}}
                <div class="flex items-center justify-center w-full @error('product_image') text-red-600 @enderror">
                    <label for="dropzone-file"
                        class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600 @error('product_image') border-red-600  @enderror)">
                        Product Image
                        <div class="flex flex-col items-center justify-center pt-5 pb-6 ">
                            <svg aria-hidden="true"
                                class="w-10 h-10 mb-3 text-gray-400 @error('product_image') text-red-600 @enderror"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                </path>
                            </svg>
                            <p
                                class="mb-2 text-sm text-gray-500 dark:text-gray-400 @error('product_image') text-red-600 @enderror">
                                <span class="font-semibold">Click
                                    to upload</span> or drag and drop
                            </p>
                            <p
                                class="text-xs text-gray-500 dark:text-gray-400 @error('product_image') text-red-600 @enderror">
                                SVG, PNG, JPG or GIF (MAX. 800x400px)
                            </p>
                        </div>
                        <input id="dropzone-file" type="file" class="hidden" name="product_image"
                            wire:model="product_image" />
                    </label>
                </div>
            </div>
            <button type="submit"
                class="text-white bg-[#F4841A] hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium text-sm px-[3rem] py-3 mr-2 mb-2 mt-[40px] hover:scale-110 transition duration-300 ease-in-out uppercase">
                @if ($title_form === 'Create Product')
                Create Product
                @else
                Update Product
                @endif
            </button>
            @if ($title_form !== 'Create Product')
            <button wire:click="switchFormToCreate" type="button"
                class="text-white bg-[#F4841A] hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium text-sm px-[3rem] py-3 mr-5 mb-2 mt-[40px] hover:scale-110 transition duration-300 ease-in-out uppercase">
                Cancel
            </button>
            @endif
        </form>
    </section>

    {{-- list user --}}
    @if($title_form == 'Create Product')
    <section class="container mx-auto py-[100px] w-[70%]">
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-white uppercase bg-[#f4841a] dark:bg-gray-700 dark:text-gray-400">
                    <tr class="px-5">
                        <th scope="col" class="py-7 px-10">
                            No
                        </th>
                        <th scope="col" class="py-7 px-10">
                            Product Name
                        </th>
                        <th scope="col" class="py-7 px-10">
                            Product Vendor
                        </th>
                        <th scope="col" class="py-7 px-10">
                            Product Price
                        </th>
                        <th scope="col" class="py-7 px-10">
                            Product Availability
                        </th>
                        <th scope="col" class="py-7 px-10">
                            Inserted By
                        </th>
                        <th scope="col" class="py-7 px-10">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    @if($product == null)
                    <div>no product Created yet</div>
                    @else
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="py-6 px-10">
                            {{ $loop->iteration }}
                        </td>
                        <th scope="row" class="py-6 px-10 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $product->product_name }}
                        </th>
                        <td class="py-6 px-10">
                            {{ $product->product_vendor }}
                        </td>
                        <td class="py-6 px-10">
                            {{ $product->product_price }}
                        </td>
                        <td class="py-6 px-10">
                            {{ $product->product_availability }}
                        </td>
                        <td class="py-6 px-10">
                            {{ $product->user->first_name }} {{ $product->user->last_name }}
                        </td>
                        <td class="py-6 px-10">
                            <i wire:click="deleteProduct({{ $product->product_id }})"
                                class="fa-solid fa-trash pr-4 cursor-pointer"></i>
                            <i wire:click="editProduct({{ $product->product_id }})"
                                class="fa-solid fa-pen-to-square cursor-pointer"></i>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
    @endif
</div>