@section('title_web_page', 'Shopping Cart')
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
    <section class="container mx-auto my-[100px]">

        <div class="overflow-x-auto relative sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="py-[30px] px-6">
                            <span class="sr-only">Image</span>
                        </th>
                        <th scope="col" class="py-[30px] px-6">
                            Product
                        </th>
                        <th scope="col" class="py-[30px] px-6">
                            Quantity
                        </th>
                        <th scope="col" class="py-[30px] px-6">
                            Price
                        </th>
                        <th scope="col" class="py-[30px] px-6">
                            Total Price
                        </th>
                        <th scope="col" class="py-[30px] px-6">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($carts as $cart)
                    @if($cart->user->id == auth()->user()->id)
                    <tr
                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                        <td class="p-4 w-32">
                            <img src="{{ asset('storage/'. $cart->product->product_image) }}"
                                alt="{{ $cart->product->product_name }}">
                        </td>
                        <td class="py-4 px-6 font-semibold text-gray-900 dark:text-white">
                            {{ $cart->product->product_name }}
                        </td>
                        <td class="py-4 px-6">
                            <div class="flex items-center space-x-3">
                                <button
                                    wire:click="decrementQuantity({{ $cart->cart_id }}, {{ $cart->product->product_id }})"
                                    class="inline-flex items-center p-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                    type="button">
                                    <span class="sr-only">Quantity button</span>
                                    <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                                <div>
                                    <input type="number" id="first_product"
                                        class="bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block px-2.5 py-1 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                        placeholder="0" readonly required value="{{ $cart->quantity }}">
                                </div>
                                <button
                                    wire:click="incrementQuantity({{ $cart->cart_id }}, {{ $cart->product->product_id }})"
                                    class="inline-flex items-center p-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700"
                                    type="button">
                                    <span class="sr-only">Quantity button</span>
                                    <svg class="w-4 h-4" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </button>
                            </div>
                        </td>
                        <td class="py-4 px-6 font-semibold text-gray-900 dark:text-white">
                            ${{ $cart->product->product_price }}
                        </td>
                        <td class="py-4 px-6 font-semibold text-gray-900 dark:text-white">
                            ${{ $cart->total_price }}
                        </td>
                        <td class="py-4 px-6">
                            <i wire:click="delete_cart({{ $cart->cart_id }})" class="fa-solid fa-trash-can"></i>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <a href="{{ route('dashboard') }}">
            <button type="button"
                class="py-3 px-10 mr-[1rem] mb-2 mt-[25px] text-white bg-[#F4841A] hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium text-sm  hover:scale-110 transition duration-300 ease-in-out uppercase">
                Continue Shopping
            </button>
        </a>

        <div class="additional-shopping flex flex-row justify-between space-y-5 mt-10">
            <div class="special-instruction w-[22rem]">
                <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Order Special
                    Instruction</label>
                <textarea id="message" rows="4"
                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Write your thoughts here..." name="special_instruction" wire:model="special_instruction"></textarea>
            </div>
            <div class="subtotal text-end text-sm">
                <p class="font-bold capitalize">subtotal <span class="pl-5">${{ $subtotal_payment }}</span></p>
                <p class="capitalize pt-6">tax included and shipping calculated at checkout</p>
                <button wire:click="add_special_instruction" type="submit"
                    class="py-3 px-10  mb-2 mt-[25px] text-white bg-[#F4841A] hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium text-sm  hover:scale-110 transition duration-300 ease-in-out uppercase">
                    check out now !
                </button>
            </div>

        </div>
    </section>
</div>