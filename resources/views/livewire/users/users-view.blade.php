<div>

    <flux:heading size="xl">Pengguna</flux:heading>
    <flux:separator class="my-5" />

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Email</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $index => $user)
            <tr>
                <td>{{ $index + 1 }}.</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                @if (is_null($user->email_verified_at))
                <td>
                    <flux:modal.trigger name="verifikasi-user-{{$user->id}}">
                        <flux:button>Belum Diverifikasi</flux:button>
                    </flux:modal.trigger>
                    <flux:modal name="verifikasi-user-{{$user->id}}" class="min-w-[26rem]">
                        <div class="space-y-6">
                            <div>
                                <flux:heading size="lg">Apakah Anda Yakin Ingin Memverifikasi </br> {{ $user->name
                                    }} ?
                                </flux:heading>
                                <flux:text class="mt-2">
                                    <p>You're about to delete this project.</p>
                                    <p>This action cannot be reversed.</p>
                                </flux:text>
                            </div>
                            <div class="flex gap-2">
                                <flux:spacer />
                                <flux:modal.close>
                                    <flux:button variant="ghost">Cancel</flux:button>
                                </flux:modal.close>
                                <flux:button type="submit" variant="filled" wire:click="verifyUser({{ $user->id }})">
                                    Aktifkan</flux:button>
                            </div>
                        </div>
                    </flux:modal>
                </td>
                @else
                <td>
                    <flux:badge color="blue">Terverifikasi</flux:badge>
                </td>
                @endif
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="w-1/3 mt-10">
        {{ $users->links() }}
    </div>


    @if (session('status'))
    <livewire:components-livewire.toast :message="session('status')" />
    @endif
</div>