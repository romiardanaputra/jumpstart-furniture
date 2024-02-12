@section('title_web_page', 'Reset Password')
<x-guest-layout>
    <div class="-pt-[8rem] w-full">
        <x-jet-authentication-card >
            <x-slot name="logo">
            </x-slot>
            <div class="p-5 ">
                <div class="flex flex-row items-center py-[2rem]">
                    <img src="{{ asset('assets/icons/jumpstart-navbar.png') }}"
                        class="h-[25 px] w-[50px] mr-3 sm:h-[50px]" alt="Jumpstart-logo" />
                    <h1
                        class="text-xl font-rufina leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white ">
                        Reset Your Password
                    </h1>
                </div>
                <x-jet-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('password.update') }}">
                    @csrf

                    <input type="hidden" name="token" value="{{ $request->route('token') }}">

                    <div class="w-full pb-[1.5rem]">
                        <label for="email"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" name="email" id="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="name@gmail.com" required :value="old('email')" autofocus>
                    </div>
                    <div class="w-full pb-[1rem]">
                        <label for="password"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                        <input type="password" name="password" id="password" placeholder="••••••••"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required>
                    </div>

                    <div class="w-full pb-[1rem]">
                        <label for="password_confirmation"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm
                            password</label>
                        <input type="password_confirmation" name="password_confirmation" id="password_confirmation"
                            placeholder="••••••••"
                            class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            required :value="old('password_confirmat')">
                    </div>

                    <div class="flex items-center justify-end mt-4 pb-[3rem]">
                        <button type="submit"
                            class="w-full text-white bg-[#F4841A] py-3 hover:scale-105 transition duration-300 ease-in-out hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium text-sm">
                            Reset Password
                        </button>
                    </div>
                </form>
            </div>

        </x-jet-authentication-card>
    </div>
</x-guest-layout>