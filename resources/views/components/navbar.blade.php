
<div class="pt-[1rem]">
    <nav class="bg-white border-gray-200 dark:bg-gray-900 py-[1rem] font-open-sans">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-2xl px-4 md:px-6 py-2.5">
            <a href="{{ route('landing') }}" class="flex items-center">
                <img src="{{ asset('assets/icons/jumpstart-navbar.png') }}" class="h-[25 px] w-[50px] mr-3 sm:h-[50px]" alt="Jumpstart-logo" />
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">JumpStart</span>
            </a>
            <div class="flex items-center space-x-[.7rem]">
                <a href="{!! route('register') !!}">
                    <button type="button"
                        class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium text-sm px-5 py-3 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700 hover:scale-110 transition duration-100 ease-in-out uppercase text-[14px]">Join
                        With Us</button>
                </a>
                <a href="{!! route('login') !!}">
                    <button type="button"
                        class="text-white bg-[#F4841A] hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium text-sm px-5 py-3 mr-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 hover:scale-110 transition duration-300 ease-in-out uppercase text-[14px]">Sign
                        In</button>
                </a>
            </div>
        </div>
    </nav>
    <nav class="bg-[#F4F4F5] dark:bg-gray-700 py-[1rem]">
        <div class="max-w-screen-2xl px-4 py-3 mx-auto md:px-6">
            <div class="flex items-center justify-center">
                <ul class="flex flex-row mt-0 text-sm font-medium uppercase">
                    <li>
                        <a href="{!! route('landing') !!}"
                            class=" p-[1rem] px-[2rem] dark:text-white  {{ Request::is('/') ? 'bg-[#F4841A] text-white' : 'hover:bg-gray-800 hover:text-white transition duration-300 ease-in-out' }}"
                            aria-current="page">Home</a>
                    </li>
                    <li>
                        <a href="{!! route('about') !!}"
                            class="p-[1rem] px-[2rem] dark:text-white {{ Request::is('about') ? 'bg-[#F4841A] text-white' : 'hover:bg-gray-800 hover:text-white transition duration-300 ease-in-out' }}">About
                            Us</a>
                    </li>
                    <li>
                        <a href="{!! route('contact')!!}"
                            class="p-[1rem] px-[2rem] dark:text-white {{ Request::is('contact') ? 'bg-[#F4841A] text-white' : 'hover:bg-gray-800 hover:text-white transition duration-300 ease-in-out' }}">Contact
                            Us</a>
                    </li>
                    <li>
                        <a href="{!! route('term') !!}"
                            class="p-[1rem] px-[2rem] dark:text-white {{ Request::is('term') ? 'bg-[#F4841A] text-white' : 'hover:bg-gray-800 hover:text-white transition duration-300 ease-in-out' }}">Term
                            and Condition</a>
                    </li>
                    <li>
                        <a href="{{ route('blog') }}"
                            class="p-[1rem] px-[2rem] dark:text-white {{ Request::is('blog') ? 'bg-[#F4841A] text-white' : 'hover:bg-gray-800 hover:text-white transition duration-300 ease-in-out' }}">News</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>