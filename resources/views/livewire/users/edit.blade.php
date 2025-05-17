<div>
    <flux:heading size="xl">Users</flux:heading>
    <flux:separator class="my-5" />

    <div
        class="bg-zinc-100 dark:bg-zinc-800 dark:border-2 p-5 rounded-2xl w-10/12 sm:w-1/2 xl:w-1/3 2xl::w-1/4 flex flex-col gap-y-5">
        <div>
            <h1 class="text-2xl font-medium">{{ $user->name }}</h1>
            <h3 class="text-slate-400 text-sm">{{ $user->email }}</h3>
        </div>
        <flux:checkbox.group wire:model="selectedPermissions" label="Permissions">
            @foreach ($permissions as $permission)
            <flux:checkbox label="{{ $permission->name }}" value="{{ $permission->name }}" />
            @endforeach
        </flux:checkbox.group>
        <flux:button wire:click="save({{ $user->id }})">Simpan</flux:button>
    </div>
</div>