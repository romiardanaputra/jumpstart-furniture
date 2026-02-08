<div class="max-w-screen-xl mx-auto py-12 px-4 sm:px-6 lg:px-8 space-y-12">
    {{-- Form Section --}}
    <x-ui.card title="{{ $title_form }}" description="Manage system access by adding new users or updating existing staff roles and contact details.">
        <form wire:submit.prevent="storeOrUpdateUser" class="space-y-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <x-ui.input label="First Name" wire:model="first_name" name="first_name" placeholder="John" required />
                <x-ui.input label="Last Name" wire:model="last_name" name="last_name" placeholder="Doe" required />
                <x-ui.input label="Email Address" type="email" wire:model="email" name="email" placeholder="john.doe@example.com" required />
                <x-ui.input label="Contact Number" wire:model="contact" name="contact" placeholder="0812-3456-7890" />
                <x-ui.input label="Role" wire:model="role" name="role" placeholder="e.g. Admin, Editor" required />
            </div>

            @if($title_form === 'Create User')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-border/50">
                    <x-ui.input label="Password" type="password" wire:model="password" name="password" placeholder="••••••••" required />
                    <x-ui.input label="Confirm Password" type="password" wire:model="password_confirmation" name="password_confirmation" placeholder="••••••••" required />
                </div>
            @endif

            <div class="flex items-center gap-4 pt-4">
                <x-ui.button type="submit">
                    {{ $title_form === 'Create User' ? 'Create User' : 'Update User' }}
                </x-ui.button>
                @if ($title_form !== 'Create User')
                    <x-ui.button wire:click="switchFormToCreate" type="button" variant="outline">Cancel</x-ui.button>
                @endif
            </div>
        </form>
    </x-ui.card>

    {{-- User List Section --}}
    @if($title_form == 'Create User')
        <x-ui.card title="System Users" description="A comprehensive list of all accounts with access to the management suite.">
            <div class="relative overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="bg-muted/50 text-muted-foreground uppercase text-xs font-semibold border-b border-border">
                        <tr>
                            <th class="px-6 py-4">User</th>
                            <th class="px-6 py-4">Contact</th>
                            <th class="px-6 py-4">Role</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-border">
                        @forelse($users as $user)
                            <tr class="hover:bg-muted/30 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-medium text-foreground">{{ $user->first_name }} {{ $user->last_name }}</div>
                                    <div class="text-xs text-muted-foreground">{{ $user->email }}</div>
                                </td>
                                <td class="px-6 py-4 text-muted-foreground">
                                    {{ $user->contact }}
                                </td>
                                <td class="px-6 py-4">
                                    <x-ui.badge variant="{{ strtolower($user->role) === 'admin' ? 'primary' : 'secondary' }}">
                                        {{ $user->role }}
                                    </x-ui.badge>
                                </td>
                                <td class="px-6 py-4 text-right space-x-2">
                                    <button wire:click="editUser({{ $user->id }})" class="p-2 rounded-md hover:bg-accent transition-colors">
                                        <svg class="h-4 w-4 text-muted-foreground hover:text-foreground" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </button>
                                    <button wire:click="deleteUser({{ $user->id }})" class="p-2 rounded-md hover:bg-destructive/10 transition-colors group">
                                        <svg class="h-4 w-4 text-muted-foreground group-hover:text-destructive" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-muted-foreground">No users found in the system.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </x-ui.card>
    @endif
</div>
