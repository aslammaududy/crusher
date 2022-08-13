<?php

namespace App\Http\Livewire\Account;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class AccountSetting extends Component
{
    public $users = [];
    public $editedIndex = -1;

    protected $rules = [
        'user.name' => 'required',
        'user.email' => 'required',
        'user.password' => 'required',
        'user.role' => 'required',
    ];

    public function render()
    {
        $this->users = User::all()->toArray();
        return view('Account.account-setting', ["users" => $this->users]);
    }

    public function edit($editedIndex)
    {
        $this->editedIndex = $editedIndex;
    }

    public function cancelEdit()
    {
        $this->editedIndex = -1;
    }

    public function update($userIndex)
    {
        $user = $this->users[$userIndex] ?? null;

        if (array_key_exists(key: "password", array: $user)) {
            $user["password"] = Hash::make($user["password"]);
        }

        User::find(id: $user["id"])->update($user);

        $this->editedIndex = -1;

        session()->flash("success", "User edited successfully!");
    }
}
