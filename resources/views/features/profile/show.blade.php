@section('title_web_page', 'Profile Settings')

<div class="max-w-screen-xl mx-auto py-12 px-4 sm:px-6 lg:px-8 space-y-12">
    <div>
        <h1 class="text-3xl font-bold text-foreground">Account Settings</h1>
        <p class="text-muted-foreground mt-2">Manage your account information, security settings, and active sessions.</p>
    </div>

    <div class="space-y-12">
        @if (Laravel\Fortify\Features::canUpdateProfileInformation())
            @livewire('profile.update-profile-information-form')
        @endif

        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
            @livewire('profile.update-password-form')
        @endif

        @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
            @livewire('profile.two-factor-authentication-form')
        @endif

        @livewire('profile.logout-other-browser-sessions-form')

        @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
            @livewire('profile.delete-user-form')
        @endif
    </div>
</div>

