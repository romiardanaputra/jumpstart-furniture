<div class="pt-[1rem]">
    <nav class="bg-white border-gray-200 dark:bg-gray-900 py-[1rem] font-open-sans">
        <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-2xl px-4 md:px-6 py-2.5">
            <a href="{{ route('landing') }}" class="flex items-center">
                <img src="{{ asset('assets/icons/jumpstart-navbar.png') }}" class="h-[25 px] w-[50px] mr-3 sm:h-[50px]"
                    alt="Jumpstart-logo" />
                <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">JumpStart</span>
            </a>
            <div class="flex items-center space-x-[.7rem]">
                <!-- Settings Dropdown -->
                <div class="ml-3 relative">
                    <x-jet-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <div class="flex items-center space-x-5">
                                <p class="leading-relaxed capitalize cursor-pointer"><b>Hi, </b>{{
                                    auth()->user()->first_name }} {{ auth()->user()->last_name }}</p>
                                <button
                                    class="flex justify-center items-center text-sm border-2 border-transparent rounded-full focus:outline-none focus:border-gray-300 transition">
                                    @if (Auth::user()->profile_photo_path)
                                    <img class="h-[60px] w-[60px] rounded-full object-cover"
                                        src="/storage/{{Auth::user()->profile_photo_path }}"
                                        alt="{{ Auth::user()->first_name }}" />
                                    @else
                                    <img class="h-[60px] w-[60px] rounded-full object-cover"
                                        src="{{Auth::user()->profile_photo_url }}"
                                        alt="{{ Auth::user()->first_name }}" />
                                    @endif
                                </button>
                            </div>

                            @else
                            <span class="inline-flex rounded-md">
                                <button type="button"
                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition">
                                    {{ Auth::user()->first_name }} {{ auth()->user()->last_name }}

                                    <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </span>
                            @endif
                        </x-slot>

                        <x-slot name="content">
                            <!-- Account Management -->
                            <div class="block px-4 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>

                            <x-jet-dropdown-link href="{{ route('profile.show') }}">
                                {{ __('Profile') }}
                            </x-jet-dropdown-link>

                            @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                            <x-jet-dropdown-link href="{{ route('api-tokens.index') }}">
                                {{ __('API Tokens') }}
                            </x-jet-dropdown-link>
                            @endif

                            <div class="border-t border-gray-100"></div>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <x-jet-dropdown-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                                    {{ __('Log Out') }}
                                </x-jet-dropdown-link>
                            </form>

                        </x-slot>
                    </x-jet-dropdown>
                </div>
                {{-- icon cart --}}
                <i class="fa-sharp fa-solid fa-cart-shopping ml-1 cursor-pointer"
                    data-drawer-target="drawer-right-example" data-drawer-show="drawer-right-example"
                    data-drawer-placement="right" aria-controls="drawer-right-example">
                </i>
            </div>

            <!-- drawer component -->
            <div id="drawer-right-example"
                class="fixed z-40 h-screen p-4 overflow-y-auto bg-white w-96 dark:bg-gray-800" tabindex="-1"
                aria-labelledby="drawer-right-label">
                <h5 id="drawer-right-label"
                    class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400">
                    <i class="fa-sharp fa-solid fa-cart-shopping mr-1"></i>
                    Your Shopping Cart
                </h5>
                <button type="button" data-drawer-dismiss="drawer-right-example" aria-controls="drawer-right-example"
                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 right-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span class="sr-only">Close menu</span>
                </button>
                <!-- items -->
                <div class="w-full pt-5 flex flex-row space-x-10 justify-center items-center">
                    @foreach($items as $item)
                    <img src="{{ asset('assets/watch.png') }}" alt="watch" class="h-[84px] w-[70px]">
                    <div class="flex flex-col space-y-1">
                        <p class="text-sm">Luxuryy Watch From Gucci</p>
                        <p class="text-sm">1 x $340.20</p>
                        <p class="text-sm text-gray-400">Color : green lime</p>
                    </div>
                    <i class="fa-solid fa-trash-can"></i>
                    @endforeach
                </div>
                <!-- Button checkout and view cart -->
                <div class="h-[85%] flex flex-col justify-end">
                    <div class="w-full">
                        <form class="w-full px-2" action="{{ route('shopping-cart') }}">
                            <button type="submit"
                                class="w-full py-3 mr-[1rem] mb-2 mt-1 text-white bg-[#F4841A] hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium text-sm  hover:scale-110 transition duration-300 ease-in-out uppercase">
                                View Cart
                            </button>
                        </form>
                        <form class="w-full px-2" action="{{ route('info-status') }}" method="get">
                            @csrf
                            <button type="submit"
                                class="w-full py-3 mr-[1rem] mb-2 mt-1 text-white bg-[#F4841A] hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium text-sm  hover:scale-110 transition duration-300 ease-in-out uppercase">
                                Check Out
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <nav class="bg-[#F4F4F5] dark:bg-gray-700 py-[1rem]">
        <div class="max-w-screen-2xl px-4 py-3 mx-auto md:px-6">
            <div class="flex items-center justify-center">
                <ul class="flex flex-row mt-0 text-sm font-medium uppercase">
                    <li>
                        <a href="{!! route('dashboard') !!}"
                            class=" p-[1rem] px-[2rem] dark:text-white  {{ Request::is('dashboard') ? 'bg-[#F4841A] text-white' : 'hover:bg-gray-800 hover:text-white transition duration-300 ease-in-out' }}"
                            aria-current="page">Home</a>
                    </li>

                    <li>
                        <a href="{!! route('contact')!!}"
                            class="p-[1rem] px-[2rem] dark:text-white {{ Request::is('contact') ? 'bg-[#F4841A] text-white' : 'hover:bg-gray-800 hover:text-white transition duration-300 ease-in-out' }}">Contact
                            Us</a>
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