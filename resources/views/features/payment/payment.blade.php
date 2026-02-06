@section('title_web_page', 'Payment')
<div class="container mx-auto py-[100px]">
    <section class="flex flex-row w-full space-x-5 space-y-5 text-sm">
        <div class="overflow-x-auto relative">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <tbody>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Contact
                        </th>
                        <td class="py-4 px-6">
                            {{ $user_info[0]->user->contact }}
                        </td>
                    </tr>
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Ship To
                        </th>
                        <td class="py-4 px-6">
                            {{ $shipping_address }}
                        </td>
                    </tr>
                    <tr class="bg-white dark:bg-gray-800">
                        <th scope="row" class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            Method
                        </th>
                        <td class="py-4 px-6">
                            {{ $shipping_method }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="px-6">
                <p class="text-[18px] pt-20">Payment</p>
                <p class="pt-3 pb-6">All transaction are secure and encrypted</p>
                <form wire:submit.prevent="submitPayment" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label for="credit_card" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Credit Card
                        </label>
                        <input wire:model="card_number" placeholder="xxxx xxxx xxxx xxxx" type="text" id="card_number"
                            maxlength="19"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>
                    <div class="mb-6">
                        <label for="card_holder_name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white capitalize">name
                            card</label>
                        <input wire:model="card_holder_name" type="text" id="card_holder_name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required placeholder="John Doe Bin Mahmud">
                    </div>
                    <div class="flex flex-row space-x-5 w-full">
                        <div class="mb-6 w-full">
                            <label for="expiry"
                                class="block mb-6 text-sm font-medium text-gray-900 dark:text-white capitalize">Expiration
                                Date
                            </label>
                            <input wire:model="expiry" maxlength="5" type="text" id="expiry"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required placeholder="MM/YY">
                        </div>
                        <div class="mb-6 w-full">
                            <label for="cvv"
                                class="block mb-6 text-sm font-medium text-gray-900 dark:text-white capitalize">
                                Card Verification Value
                            </label>
                            <input wire:model="cvv" maxlength="4" type="text" id="cvv"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm  focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required placeholder="123x">
                        </div>
                    </div>

                    <div class="flex flex-row space-x-5">
                        <button type="submit"
                            class="text-white bg-[#F4841A] hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium text-sm px-[3rem] py-3 mr-2 mb-2 mt-[80px] hover:scale-110 transition duration-300 ease-in-out uppercase w-full">
                            Finish Payment
                        </button>
                        <button wire:click="backToShippingPage" type="button"
                            class="text-white bg-[#F4841A] hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium text-sm px-[3rem] py-3 mr-2 mb-2 mt-[80px] hover:scale-110 transition duration-300 ease-in-out uppercase w-full">
                            Back
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <x-status-product-pre-pay />
    </section>
    <script>
        // card_number
        let cardNumberInput = document.getElementById("card_number");
        cardNumberInput.addEventListener("input", function() {
            this.value = this.value.replace(/[^\dA-Z]/g, '').replace(/(.{4})/g, '$1 ').trim();
        });

        // expiry date
        let expiryInput = document.getElementById("expiry");
            expiryInput.addEventListener("input", function() {
            this.value = this.value.replace(/[^\d]/g, '').replace(/(.{2})/g, '$1/').trim();
            
            if (this.value.endsWith("/")) {
            this.value = this.value.slice(0, -1);
            }
         });

        expiryInput.addEventListener("blur", function() {
        if (!this.value.match(/^(0[1-9]|1[0-2])\/(2\d)$/)) {
            this.classList.add("is-invalid");
        } else {
            this.classList.remove("is-invalid");
        }
    });
    </script>
</div>