<?php

namespace App\Http\Livewire;

use App\Models\User as ModelsUsers;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class ManageUser extends Component
{
    public $user_id;

    public $user;

    public $first_name;

    public $last_name;

    public $contact;

    public $email;

    public $role;

    public $password;

    public $password_confirmation;

    public $title_form = 'Create User';

    public function store_or_update_user()
    {
        if ($this->user_id) {
            $this->validate([
                'first_name' => ['required'],
                'last_name' => ['required'],
                'contact' => ['required', 'max:15', 'min:10'],
                'email' => ['required', 'email:rfc,dns'],
                'role' => ['required'],
            ]);
            $user = ModelsUsers::find($this->user_id);
            $user->update([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'contact' => $this->contact,
                'role' => $this->role,
            ]);
        } else {
            $this->validate([
                'first_name' => ['required'],
                'last_name' => ['required'],
                'contact' => ['required', 'unique:users', 'max:15', 'min:10'],
                'email' => ['required', 'unique:users', 'email:rfc,dns'],
                'role' => ['required'],
                'password' => ['required', 'min:6'],
                'password_confirmation' => ['required', 'confirmed'],
            ]);
            ModelsUsers::create([
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
                'contact' => $this->contact,
                'email' => $this->email,
                'role' => $this->role,
                'password' => Hash::make($this->password),
            ]);
        }

        return to_route('manage-user');
    }

    public function edit_user($user_id)
    {
        $this->user_id = $user_id;
        $user = ModelsUsers::find($this->user_id);
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->contact = $user->contact;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->password = $user->password;
        $this->title_form = 'Update User '.$user->first_name.' '.$user->last_name;
    }

    public function switch_form_to_create()
    {
        $this->user_id = '';
        $this->first_name = '';
        $this->last_name = '';
        $this->contact = '';
        $this->email = '';
        $this->role = '';
        $this->password = '';
        $this->title_form = 'Create User';
    }

    public function delete_user($user_id)
    {
        ModelsUsers::where('id', $user_id)->delete();

        return to_route('manage-blog');
    }

    public function render()
    {
        return view('livewire.manage-user', [
            'users' => ModelsUsers::all(),
        ]);
    }
}
