<?php

namespace App\Http\Livewire;

use App\Contracts\Services\UserServiceInterface;
use Livewire\Component;

class ManageUser extends Component
{
    protected UserServiceInterface $userService;

    public ?int $user_id = null;

    public string $first_name = '';

    public string $last_name = '';

    public string $contact = '';

    public string $email = '';

    public string $role = '';

    public string $password = '';

    public string $password_confirmation = '';

    public string $title_form = 'Create User';

    /**
     * Boot lifecycle hook for dependency injection
     */
    public function boot(UserServiceInterface $userService): void
    {
        $this->userService = $userService;
    }

    /**
     * Store or update user
     */
    public function storeOrUpdateUser(): mixed
    {
        if ($this->user_id) {
            // Update existing user
            $this->validate([
                'first_name' => ['required', 'string', 'max:100'],
                'last_name' => ['required', 'string', 'max:100'],
                'contact' => ['required', 'max:15', 'min:10'],
                'email' => ['required', 'email:rfc,dns'],
                'role' => ['required', 'in:admin,customer,guest'],
            ]);

            $this->userService->updateUser($this->user_id, [
                'first_name' => $this->sanitizeInput($this->first_name),
                'last_name' => $this->sanitizeInput($this->last_name),
                'contact' => $this->sanitizeInput($this->contact),
                'email' => strtolower(trim($this->email)),
                'role' => $this->role,
            ]);

            session()->flash('message', 'User updated successfully!');
        } else {
            // Create new user
            $this->validate([
                'first_name' => ['required', 'string', 'max:100'],
                'last_name' => ['required', 'string', 'max:100'],
                'contact' => ['required', 'unique:users', 'max:15', 'min:10'],
                'email' => ['required', 'unique:users', 'email:rfc,dns'],
                'role' => ['required', 'in:admin,customer,guest'],
                'password' => ['required', 'min:6'],
                'password_confirmation' => ['required', 'same:password'],
            ]);

            $this->userService->createUser([
                'first_name' => $this->sanitizeInput($this->first_name),
                'last_name' => $this->sanitizeInput($this->last_name),
                'contact' => $this->sanitizeInput($this->contact),
                'email' => strtolower(trim($this->email)),
                'role' => $this->role,
                'password' => $this->password,
            ]);

            session()->flash('message', 'User created successfully!');
        }

        return to_route('manage-user');
    }

    /**
     * Edit user - populate form with existing data
     */
    public function editUser(int $userId): void
    {
        $this->user_id = $userId;
        $user = $this->userService->getUser($userId);

        if ($user) {
            $this->first_name = $user->first_name;
            $this->last_name = $user->last_name;
            $this->contact = $user->contact;
            $this->email = $user->email;
            $this->role = $user->role ?? '';
            $this->title_form = 'Update User ' . $user->first_name . ' ' . $user->last_name;
        }
    }

    /**
     * Reset form to create mode
     */
    public function switchFormToCreate(): void
    {
        $this->reset([
            'user_id',
            'first_name',
            'last_name',
            'contact',
            'email',
            'role',
            'password',
            'password_confirmation',
        ]);
        $this->title_form = 'Create User';
    }

    /**
     * Delete a user
     */
    public function deleteUser(int $userId): mixed
    {
        $this->userService->deleteUser($userId);
        session()->flash('message', 'User deleted successfully!');

        return to_route('manage-user');
    }

    /**
     * Sanitize input string
     */
    protected function sanitizeInput(string $value): string
    {
        return strip_tags(trim($value));
    }

    /**
     * Render the component
     */
    public function render()
    {
        return view('livewire.manage-user', [
            'users' => $this->userService->getAllUsers(),
        ]);
    }
}
