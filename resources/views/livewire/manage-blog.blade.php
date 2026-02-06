@section('title_web_page','Manage Blog')
<div>
    <section class="container w-1/2 mx-auto py-[100px]">
        <p class="text-[28px] font-open-sans font-semibold text-gray-500">{{ $title_page }}</p>
        <form wire:submit.prevent="storeOrUpdateBlog">
            {{-- row 1 --}}
            <div class="flex flex-row justify-center space-x-5 py-5">
                <div class="w-full flex flex-row space-x-5">
                    {{-- blog title --}}
                    <div class="w-full">
                        <div class="relative ">
                            <input type="text" id="blog_title"
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent  border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-[#f4841a] peer @error('blog_title') border-red-600 focus:border-red-600 @enderror"
                                placeholder=" " name="blog_title" wire:model="blog_title"
                                value="{{ old('blog_title') ? $blog->blog_title : "" }}" />
                            <label for="blog_title"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-[#f4841a] peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1 @error('blog_title') text-red-600 peer-focus:text-red-600  @enderror">
                                Blog Title
                            </label>
                        </div>
                        @error('blog_title')
                        <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                            <span class="font-medium">Oh, snapp! </span>{{ $message }}
                        </p>
                        @enderror
                    </div>

                    {{-- blog tags --}}
                    <div class="w-full">
                        <div class="relative w-full">
                            <input type="text" id="blog_tags"
                                class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent  border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-[#f4841a] peer @error('blog_tags') border-red-600 focus:border-red-600  @enderror"
                                placeholder=" " name="blog_tags" wire:model="blog_tags"
                                value="{{ old('blog_tags') ? $blog->blog_tags : "" }}" />
                            <label for="blog_tags"
                                class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-[#f4841a] peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1 @error('blog_tags') text-red-600 peer-focus:text-red-600 @enderror">
                                Blog Tag
                            </label>
                        </div>
                        @error('blog_tags')
                        <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                            <span class="font-medium">Oh, snapp! </span>{{ $message }}
                        </p>
                        @enderror
                    </div>

                </div>
            </div>

            {{-- row2 --}}
            {{-- blog long description --}}
            <div class="w-full">
                <div class="relative w-full">
                    <input type="text" id="blog_long_description"
                        class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent  border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-[#f4841a] peer @error('blog_long_description') border-red-600 focus:border-red-600  @enderror"
                        placeholder=" " name="blog_long_description" wire:model="blog_long_description"
                        value="{{ old('blog_long_description') ? $blog->blog_long_description : ""}}" />
                    <label for="blog_long_description"
                        class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-[#f4841a] peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1 @error('blog_long_description') text-red-600 peer-focus:text-red-600 @enderror">
                        Blog Description
                    </label>
                </div>
                @error('blog_long_description')
                <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                    <span class="font-medium">Oh, snapp! </span>{{ $message }}
                </p>
                @enderror
            </div>

            {{-- row8 --}}
            {{-- blog post image --}}
            <div class="flex py-4">
                <div class="flex items-center justify-center w-full @error('blog_image') text-red-600 @enderror">
                    <label for="dropzone-file"
                        class="flex flex-col items-center justify-center w-full h-64 border-2 border-gray-300 border-dashed cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-gray-600 dark:hover:border-gray-500 dark:hover:bg-gray-600 @error('blog_image') border-red-600  @enderror)">
                        Blog Image
                        <div class="flex flex-col items-center justify-center pt-5 pb-6 ">
                            <svg aria-hidden="true"
                                class="w-10 h-10 mb-3 text-gray-400 @error('blog_image') text-red-600 @enderror"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                </path>
                            </svg>
                            <p
                                class="mb-2 text-sm text-gray-500 dark:text-gray-400 @error('blog_image') text-red-600 @enderror">
                                <span class="font-semibold">Click
                                    to upload</span> or drag and drop
                            </p>
                            <p
                                class="text-xs text-gray-500 dark:text-gray-400 @error('blog_image') text-red-600 @enderror">
                                SVG, PNG, JPG or GIF (MAX. 800x400px)
                            </p>
                        </div>
                        <input id="dropzone-file" type="file" class="hidden" name="blog_image" wire:model="blog_image"
                            value="{{ old('blog_image') ? $blog->blog_image : ""}}" />
                    </label>
                </div>
            </div>
            <button type="submit"
                class="text-white bg-[#F4841A] hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium text-sm px-[3rem] py-3 mr-2 mb-2 mt-[40px] hover:scale-110 transition duration-300 ease-in-out uppercase">
                @if($title_page == 'Create')
                Create Blog
                @else
                Update Changes
                @endif
            </button>
            @if($title_page !== 'Create')
            <button wire:click="switchToCreate" type="button"
                class="text-white bg-[#F4841A] hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium text-sm px-[3rem] py-3 mr-2 mb-2 mt-[40px] hover:scale-110 transition duration-300 ease-in-out uppercase">
                Cancel
            </button>
            @endif
        </form>

    </section>

    {{-- list blog --}}
    @if($title_page == 'Create')
    <section class="container mx-auto py-[100px] w-[70%]">
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-white uppercase bg-[#f4841a] dark:bg-gray-700 dark:text-gray-400">
                    <tr class="px-5">
                        <th scope="col" class="py-7 px-10">
                            No
                        </th>
                        <th scope="col" class="py-7 px-10">
                            Blog title
                        </th>
                        <th scope="col" class="py-7 px-10">
                            Blog description
                        </th>
                        <th scope="col" class="py-7 px-10">
                            Blog tags
                        </th>
                        <th scope="col" class="py-7 px-10">
                            Posted By
                        </th>
                        <th scope="col" class="py-7 px-10">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($blogs as $blog)
                    @isset($blog)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="py-6 px-10">
                            {{ $loop->iteration }}
                        </td>
                        <td class="py-6 px-10">
                            {{ $blog->blog_title }}
                        </td>
                        <td class="py-6 px-10">
                            {{ $blog->blog_long_description }}
                        </td>
                        <td class="py-6 px-10">
                            {{ $blog->blog_tags }}
                        </td>
                        <td class="py-6 px-10">
                            {{ $blog->user->first_name }} {{ $blog->user->last_name }}
                        </td>
                        <td class="py-6 px-10 flex">
                            <i wire:click="deleteBlog({{ $blog->blog_id }})"
                                class="fa-solid fa-trash pr-2 cursor-pointer"></i>
                            <i wire:click="editBlog({{ $blog->blog_id }})"
                                class="fa-solid fa-pen-to-square cursor-pointer"></i>
                        </td>
                    </tr>
                    @else
                    <div>no blog Created yet</div>
                    @endisset
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
    @endif
</div>