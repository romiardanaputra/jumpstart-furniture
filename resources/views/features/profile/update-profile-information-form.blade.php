<x-ui.card title="Profile Information" description="Update your account's profile information and email address.">
    <form wire:submit.prevent="updateProfileInformation" class="space-y-8">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="space-y-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden" wire:model="photo" x-ref="photo" x-on:change="
                    photoName = $refs.photo.files[0].name;
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        photoPreview = e.target.result;
                    };
                    reader.readAsDataURL($refs.photo.files[0]);
                " />

                <label class="text-sm font-medium leading-none">Photo</label>

                <div class="flex items-center space-x-6">
                    <!-- Current Profile Photo -->
                    <div x-show="! photoPreview" class="relative">
                        @if (Auth::user()->profile_photo_path)
                            <img class="h-20 w-20 rounded-full object-cover border-2 border-border" src="/storage/{{Auth::user()->profile_photo_path }}" alt="{{ Auth::user()->first_name }}" />
                        @else
                            <img class="h-20 w-20 rounded-full object-cover border-2 border-border" src="{{Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->first_name }}" />
                        @endif
                    </div>

                    <!-- New Profile Photo Preview -->
                    <div x-show="photoPreview" style="display: none;" class="relative">
                        <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center border-2 border-primary"
                              x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                        </span>
                    </div>

                    <div class="flex flex-col space-y-2">
                        <x-ui.button variant="outline" size="sm" type="button" x-on:click.prevent="$refs.photo.click()">
                            {{ __('Change Photo') }}
                        </x-ui.button>

                        @if ($this->user->profile_photo_path)
                            <button type="button" class="text-xs text-destructive hover:underline text-left" wire:click="deleteProfilePhoto">
                                {{ __('Remove Photo') }}
                            </button>
                        @endif
                    </div>
                </div>

                <x-jet-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-ui.input label="First Name" id="first_name" wire:model.defer="state.first_name" autocomplete="first_name" required />
            <x-ui.input label="Last Name" id="last_name" wire:model.defer="state.last_name" autocomplete="last_name" required />
        </div>

        <div class="space-y-4">
            <x-ui.input label="Email Address" type="email" id="email" wire:model.defer="state.email" required />
            
            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) && !$this->user->hasVerifiedEmail())
                <div class="rounded-md bg-yellow-50 dark:bg-yellow-900/30 p-4 border border-yellow-200 dark:border-yellow-800">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-yellow-700 dark:text-yellow-200">
                                {{ __('Your email address is unverified.') }}
                                <button type="button" class="font-medium underline hover:text-yellow-600" wire:click.prevent="sendEmailVerification">
                                    {{ __('Re-send verification email') }}
                                </button>
                            </p>
                        </div>
                    </div>
                </div>

                @if ($this->verificationLinkSent)
                    <p class="text-sm font-medium text-success mt-2">
                        {{ __('A new verification link has been sent to your email address.') }}
                    </p>
                @endif
            @endif
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-border/50">
            <x-ui.button type="submit" wire:loading.attr="disabled" wire:target="photo">
                {{ __('Save Changes') }}
            </x-ui.button>
            <x-jet-action-message class="text-sm text-muted-foreground" on="saved">
                {{ __('Saved successfully.') }}
            </x-jet-action-message>
        </div>
    </form>
</x-ui.card>
