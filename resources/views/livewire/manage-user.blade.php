@section('title_web_page', 'Manage User')
<div>
    <section class="container w-1/2 mx-auto py-[100px]">
        <p class="text-[28px] font-rufina font-semibold text-gray-500 capitalize">{{ $title_form }}</p>
        <form wire:submit.prevent="store_or_update_user">
            <div class="w-full flex flex-row space-x-5 py-4">
                <div class="w-full">
                    <div class="relative w-full">
                        <input type="text" id="floating_outlined"
                            class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent  border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-[#f4841a] peer @error('first_name') border-red-600 focus:border-red-600 @enderror"
                            placeholder=" " wire:model="first_name" name="first_name"
                            value="{{ old('first_name') ? $user->first_name : "" }}" />
                        <label for="floating_outlined"
                            class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-[#f4841a] peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1 @error('first_name') text-red-600 peer-focus:text-red-600 @enderror">
                            First Name
                        </label>
                    </div>
                    @error('first_name')
                    <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                        <span class="font-medium">Oh, snapp! </span>{{ $message }}
                    </p>
                    @enderror
                </div>

                <div class="w-full">
                    <div class="relative w-full">
                        <input type="text" id="floating_outlined"
                            class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent  border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-[#f4841a] peer @error('last_name') border-red-600 focus:border-red-600 @enderror"
                            placeholder=" " wire:model="last_name" name="last_name"
                            value="{{ old('last_name') ? $user->last_name : "" }}" />
                        <label for="floating_outlined"
                            class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-[#f4841a] peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1 @error('last_name') text-red-600 peer-focus:text-red-600 @enderror">
                            Last Name
                        </label>
                    </div>
                    @error('last_name')
                    <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                        <span class="font-medium">Oh, snapp! </span>{{ $message }}
                    </p>
                    @enderror
                </div>
            </div>

        <div class="py-4 w-full">
            <div class="relative w-full">
                <input type="tel" id="floating_outlined"
                    class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent  border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-[#f4841a] peer @error('contact') border-red-600 focus:border-red-600 @enderror"
                    placeholder=" " wire:model="contact" name="contact"
                    value="{{ old('contact') ? $user->contact : "" }}" pattern="[0-9]{4}-[0-9]{4}-[0-9]{4}" />
                <label for="floating_outlined"
                    class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-[#f4841a] peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1 @error('contact') text-red-600 peer-focus:text-red-600 @enderror">Contact</label>
            </div>
            @error('contact')
            <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                <span class="font-medium">Oh, snapp! </span>{{ $message }}
            </p>
            @enderror
        </div>

        <div class="py-4 w-full">
            <div class="relative w-full">
                <input type="text" id="floating_outlined"
                    class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent  border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-[#f4841a] peer @error('role') border-red-600 focus:border-red-600 @enderror"
                    placeholder=" " wire:model="role" name="role" value="{{ old('role') ? $user->role : ""}}" />
                <label for="floating_outlined"
                    class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-[#f4841a] peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1 @error('role') text-red-600 peer-focus:text-red-600 @enderror">Role</label>
            </div>
            @error('role')
            <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                <span class="font-medium">Oh, snapp! </span>{{ $message }}
            </p>
            @enderror
        </div>
        <div class="py-4 w-full">
            <div class="relative w-full">
                <input type="text" id="floating_outlined"
                    class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent  border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-[#f4841a] peer @error('email') border-red-600 focus:border-red-600 @enderror"
                    placeholder=" " wire:model="email" name="email" value="{{ old('email') ? $user->email : "" }}" />
                <label for="floating_outlined"
                    class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-[#f4841a] peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1 @error('email') text-red-600 peer-focus:text-red-600 @enderror">Email</label>
            </div>
            @error('email')
            <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                <span class="font-medium">Oh, snapp! </span>{{ $message }}
            </p>
            @enderror
        </div>

        @if($title_form === 'Create User')
        <div class="py-4 w-full">
            <div class="relative w-full">
                <input type="password" id="floating_outlined"
                    class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent  border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-[#f4841a] peer @error('password') border-red-600 focus:border-red-600 @enderror"
                    placeholder=" " wire:model="password" name="password"
                    value="{{ old('password') ? $user->password : "" }}" />
                <label for="floating_outlined"
                    class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-[#f4841a] peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1 @error('password') text-red-600 peer-focus:text-red-600 @enderror">Password</label>
            </div>
            @error('password')
            <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                <span class="font-medium">Oh, snapp! </span>{{ $message }}
            </p>
            @enderror
        </div>

        <div class="py-4 w-full">
            <div class="relative w-full">
                <input type="password" id="floating_outlined"
                    class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent  border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-[#f4841a] peer @error('password_confirmation') border-red-600 focus:border-red-600  @enderror"
                    placeholder=" " wire:model="password_confirmation" name="password_confirmation"
                    value="{{ old('password_confirmation') ? $user->password_confirmation : "" }}" />
                <label for="floating_outlined"
                    class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-900 px-2 peer-focus:px-2 peer-focus:text-[#f4841a] peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 left-1 @error('password_confirmation') text-red-600 peer-focus:text-red-600 @enderror">Password
                    Confirmation</label>
            </div>
            @error('password_confirmation')
            <p id="filled_error_help" class="mt-2 text-xs text-red-600 dark:text-red-400">
                <span class="font-medium">Oh, snapp! </span>{{ $message }}
            </p>
            @enderror
        </div>
        @endif
        <button type="submit"
            class="text-white bg-[#F4841A] hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium text-sm px-[3rem] py-3 mr-5 mb-2 mt-[40px] hover:scale-110 transition duration-300 ease-in-out uppercase">
            @if ($title_form == 'Create User')
            Create User
            @else
            Update User
            @endif
        </button>
        @if ($title_form !== 'Create User' )
        <button wire:click="switch_form_to_create" type="button"
            class="text-white bg-[#F4841A] hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium text-sm px-[3rem] py-3 mr-5 mb-2 mt-[40px] hover:scale-110 transition duration-300 ease-in-out uppercase">
            Cancel
        </button>
        @endif
    </form>
    </section>

    {{-- list user --}}

    @if($title_form == 'Create User')
    <section class="container mx-auto py-[100px] w-[70%]">
        <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-white uppercase bg-[#f4841a] dark:bg-gray-700 dark:text-gray-400">
                    <tr class="px-5">
                        <th scope="col" class="py-7 px-10">
                            No
                        </th>
                        <th scope="col" class="py-7 px-10">
                            Username
                        </th>
                        <th scope="col" class="py-7 px-10">
                            Email
                        </th>
                        <th scope="col" class="py-7 px-10">
                            Contact
                        </th>
                        <th scope="col" class="py-7 px-10">
                            Role
                        </th>
                        <th scope="col" class="py-7 px-10">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td class="py-6 px-10">
                            {{ $loop->iteration }}
                        </td>
                        <th scope="row" class="py-6 px-10 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $user->first_name }} {{ $user->last_name }}
                        </th>
                        <td class="py-6 px-10">
                            {{ $user->email }}
                        </td>
                        <td class="py-6 px-10">
                            {{ $user->contact }}
                        </td>
                        <td class="py-6 px-10">
                            {{ $user->role }}
                        </td>
                        <td class="py-6 px-10 flex">
                            <i wire:click="delete_user({{ $user->id }})"
                                class="fa-solid fa-trash pr-2 cursor-pointer"></i>
                            <i wire:click="edit_user({{ $user->id }})"
                                class="fa-solid fa-pen-to-square cursor-pointer"></i>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
    @endif
</div>