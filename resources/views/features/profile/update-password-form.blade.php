<x-ui.card title="Security" description="Ensure your account is using a long, random password to stay secure.">
    <form wire:submit.prevent="updatePassword" class="space-y-6">
        <x-ui.input label="Current Password" type="password" id="current_password" wire:model.defer="state.current_password" autocomplete="current-password" required />
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <x-ui.input label="New Password" type="password" id="password" wire:model.defer="state.password" autocomplete="new-password" required />
            <x-ui.input label="Confirm New Password" type="password" id="password_confirmation" wire:model.defer="state.password_confirmation" autocomplete="new-password" required />
        </div>

        <div class="flex items-center gap-4 pt-4 border-t border-border/50">
            <x-ui.button type="submit">
                {{ __('Update Password') }}
            </x-ui.button>
            <x-jet-action-message class="text-sm text-muted-foreground" on="saved">
                {{ __('Password updated.') }}
            </x-jet-action-message>
        </div>
    </form>
</x-ui.card>

