@section('title_web_page', 'Info Status')
<div class="container px-10 mx-auto py-[100px]">
    <div class="w-full left-info-status text-sm flex space-x-10 justify-center">
        <section class="w-1/2 flex flex-col space-y-10">
            <p class="text-[28px]">Jumpstart | Furniture Store</p>
            <x-order-status />
            <p class="text-[18px]">Contact Information</p>
            <p>{{ $info_status[0]->user->first_name }} {{ $info_status[0]->user->last_name }} ( {{ $info_status[0]->user->email }} )</p>
            <p class="text-[18px] capitalize">shipping Address</p>
            <form class="" wire:submit.prevent="shipping">
                <div class="grid gap-6 md:grid-cols-2">
                    <div class="mb-6">
                        <label for="first_name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">first name</label>
                        <input type="text" id="first_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required value="{{ $info_status[0]->user->first_name }}">
                    </div>
                    <div class="mb-6">
                        <label for="last_name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">last
                            name</label>
                        <input type="text" id="last_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required value="{{ $info_status[0]->user->last_name }}">
                    </div>
                </div>
                <div class="mb-6">
                    <label for="shipping_address"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">shipping_address</label>
                    <input type="text" id="shipping_address"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" wire:model="shipping_address" required>
                </div>
                <div class="flex flex-row space-x-5">
                    <button type="submit"
                        class="text-white bg-[#F4841A] hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium text-sm px-[3rem] py-3 mr-2 mb-2 mt-[80px] hover:scale-110 transition duration-300 ease-in-out uppercase w-full">
                        Continue
                        Shipping
                    </button>
                    <button wire:click="back_to_cart_page" type="button"
                        class="text-white bg-[#F4841A] hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium text-sm px-[3rem] py-3 mr-2 mb-2 mt-[80px] hover:scale-110 transition duration-300 ease-in-out uppercase w-full">
                        Back to Cart
                    </button>
                </div>
            </form>
        </section>
       <x-status-product-pre-pay/>
    </div>
</div>