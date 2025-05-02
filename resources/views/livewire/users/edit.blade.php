<div>
    <flux:heading size="xl">Users</flux:heading>
    <flux:separator class="my-5" />

    <div class="bg-zinc-100 p-5 rounded w-1/4 flex flex-col gap-y-5">
        <div>
            <h1 class="text-2xl font-medium">{{ $user->name }}</h1>
            <h3 class="text-slate-400 text-sm">{{ $user->email }}</h3>
        </div>
        <flux:checkbox.group wire:model="selectedPermissions" label="Permissions">
            @foreach ($permissions as $permission)
            <flux:checkbox label="{{ $permission->name }}" value="{{ $permission->name }}" />
            @endforeach
        </flux:checkbox.group>
        <flux:button wire:click="save({{ $user->id }})">Save</flux:button>
    </div>
</div>