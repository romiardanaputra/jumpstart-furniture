@section('title_web_page', 'Admin Dashboard')
<div>
    <x-banner-parallax />
    <section class="container mx-auto py-[100px] text-sm leading-relaxed">
        <p class="text-[38px] font-rufina text-center pb-10">Control Pannel</p>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 justify-center mb-16">
            {{-- user management card --}}
            <div
                class="hover:scale-105 transition duration-300 ease-in-out p-10 bg-white border border-gray-200 rounded-3xl shadow-sm dark:bg-gray-800 dark:border-gray-700 ">
                <i class="fa-sharp fa-solid fa-users text-[50px] mb-6 text-[#F4841A]"></i>
                <a href="{{ route('manage-user') }}">
                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">User Management
                    </h5>
                </a>
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400 text-xs">Controlling access of the user of all role
                    and have authority to update user and delete user</p>
                <a href="{{ route('manage-user') }}" class="inline-flex items-center text-blue-600 hover:underline">
                    Manage User Now
                    <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z"></path>
                        <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z"></path>
                    </svg>
                </a>
            </div>

            {{--product management card --}}
            <div
                class="hover:scale-105 transition duration-300 ease-in-out p-10 bg-white border border-gray-200 rounded-3xl shadow-sm dark:bg-gray-800 dark:border-gray-700">
                <i class="fa-sharp fa-solid fa-shop text-[50px] mb-6 text-[#F4841A]"></i>
                <a href="{{ route('manage-product') }}">
                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">
                        Product Management
                    </h5>
                </a>
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400 text-xs">
                    Controlling access of the furniture product off all its attribute and have authority to update and
                    delete product
                </p>
                <a href="{{ route('manage-product') }}" class="inline-flex items-center text-blue-600 hover:underline">
                    Manage Product Now
                    <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z"></path>
                        <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z"></path>
                    </svg>
                </a>
            </div>

            <div
                class="p-10 bg-white border border-gray-200 rounded-3xl shadow-sm dark:bg-gray-800 dark:border-gray-700 hover:scale-105 transition duration-300 ease-in-out">
                <i class="fa-solid fa-blog text-[50px] mb-6 text-[#F4841A]"></i>
                <a href="{{ route('manage-blog') }}">
                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">
                        Blog Management
                    </h5>
                </a>
                <p class="mb-3 font-normal text-gray-500 dark:text-gray-400 text-xs">
                    Controlling access of the furniture product news that related of trendy and have authority to update and delete that related to the post blog
                </p>
                <a href="{{ route('manage-blog') }}" class="inline-flex items-center text-blue-600 hover:underline">
                    Manage Blog Now
                    <svg class="w-5 h-5 ml-2" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z"></path>
                        <path d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z"></path>
                    </svg>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <div class="lg:col-span-1">
                @livewire('admin.wishlist-analytics')
            </div>
            <div class="lg:col-span-2">
                <x-blog/>
            </div>
        </div>
    </section>
</div>
    </section>
</div>z