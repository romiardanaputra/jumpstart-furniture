@section('title_web_page', 'Login')
<div>
    <section class="bg-gray-50 dark:bg-gray-900 ">
        <div class="flex flex-col items-center justify-center px-[2rem] py-[3rem] mx-auto md:h-screen lg:py-0">
            <div
                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md lg:max-w-2xl xl:p-[2rem] dark:bg-gray-800 dark:border-gray-700 md:p-[1rem]">
                <div class="p-6 space-y-[1rem] md:space-y-6 sm:p-8">
                    <div class="flex flex-row items-center">
                        <img src="{{ asset('assets/icons/jumpstart-navbar.png') }}"
                            class="h-[25 px] w-[50px] mr-3 sm:h-[50px]" alt="Jumpstart-logo" />
                        <h1
                            class="text-xl font-rufina leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white ">
                            Sign In To Your Account
                        </h1>
                    </div>
                    <x-jet-validation-errors class="mb-4" />
                    @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form class="space-y-[1rem] md:space-y-[2.4rem]" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="w-full">
                            <label for="email"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                            <input type="email" name="email" id="email"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="name@gmail.com" required :value="old('email')" autofocus>
                        </div>
                        <div class="w-full">
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required>
                        </div>

                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <input id="remember_me" aria-describedby="remember_me" type="checkbox"
                                    class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800"
                                    name="remember">
                            </div>
                            <div class="ml-3 text-sm">
                                <label for="remember_me" class="font-light text-gray-500 dark:text-gray-300">Remember
                                    Me</label>
                            </div>
                        </div>
                        <button type="submit"
                            class="w-full text-white bg-[#F4841A] py-3 hover:scale-105 transition duration-300 ease-in-out hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium text-sm">Sign
                            In</button>
                        @if (Route::has('password.request'))
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Forget Your Password ? <a href="{{ route('password.request') }}"
                                class="font-medium text-primary-600 hover:underline dark:text-primary-500">Click
                                here</a>
                        </p>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>