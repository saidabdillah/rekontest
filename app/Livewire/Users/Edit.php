<?php

namespace App\Livewire\Users;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Edit extends Component
{
    public $user;
    public $role;
    public $permissions;
    public $selectedPermissions = [];

    public function mount(User $user)
    {
        $this->user = $user;
        $this->permissions = Permission::all();
        $this->role = $this->user->getRoleNames();
        $this->selectedPermissions = $this->user->getDirectPermissions()->pluck('name');
    }

    public function render()
    {
        return view('livewire.users.edit');
    }

    public function save(User $user)
    {
        $this->validate([
            'selectedPermissions' => 'required|array|min:1',
        ], [
            'selectedPermissions.required' => 'Permission tidak boleh kosong.',
            'selectedPermissions.array' => 'Permission harus berupa array.',
            'selectedPermissions.min' => 'Pilih minimal satu permission.',
        ]);

        $user->syncPermissions($this->selectedPermissions);
        return redirect()->route('users.index')->with([
            'type' => 'success',
            'status' => 'Data berhasil disimpan.'
        ]);
    }
}
