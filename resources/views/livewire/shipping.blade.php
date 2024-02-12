@section('title_web_page', 'Shipping')
<div class="container px-10 mx-auto  py-[100px] ">
    <div class="w-full left-info-status text-sm flex space-x-10 justify-center">
        <section class="w-1/2 flex flex-col space-y-10">
            <p class="text-[28px]">Jumpstart | Furniture Store</p>
            <x-order-status />
            <form wire:submit.prevent="payment">
                <div class="mb-6">
                    <label for="contact" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Contact
                    </label>
                    <input type="text" id="contact"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        value="{{ $data_shipping[0]->user->contact }}" readonly>
                </div>
                <div class="mb-6">
                    <label for="shipping_address"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white capitalize">ship
                        to</label>
                    <input type="text" id="shipping_address"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        wire:model="shipping_address" readonly>
                </div>
                <div class="mb-6 py-6">
                    <label for="shipping_method"
                        class="block mb-6 text-lg font-medium text-gray-900 dark:text-white capitalize">shipping method
                    </label>
                    <input type="text" id="shipping_method"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        wire:model="shipping_method">
                </div>
                <div class="flex flex-row space-x-5">
                    <button type="submit"
                        class="text-white bg-[#F4841A] hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium text-sm px-[3rem] py-3 mr-2 mb-2 mt-[80px] hover:scale-110 transition duration-300 ease-in-out uppercase w-full">
                        Continue
                        Payment
                    </button>
                    <button wire:click="back_to_info_status_page" type="button"
                        class="text-white bg-[#F4841A] hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium text-sm px-[3rem] py-3 mr-2 mb-2 mt-[80px] hover:scale-110 transition duration-300 ease-in-out uppercase w-full">
                        Back
                    </button>
                </div>
            </form>
        </section>
        <x-status-product-pre-pay />
    </div>
</div>