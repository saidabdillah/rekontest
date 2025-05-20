<div>
    <flux:heading size="xl">Pengguna</flux:heading>
    <flux:separator class="my-5" />

    <div class="w-fit mb-5">
        <form class="flex gap-x-5">
            <flux:input icon="magnifying-glass" type="search" wire:input.debounce.150ms="cariUser" wire:model="user"
                wire:keydown.debounce.300ms="cariUser" placeholder="Cari..." />
        </form>
    </div>

    <section class="w-full overflow-x-auto">
        <table class="w-[1000px]">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                <tr>
                    <td>{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    @if (is_null($user->email_verified_at))
                    <td class="text-center">
                        <flux:modal.trigger name="verifikasi-user-{{$user->id}}">
                            <flux:button class="cursor-pointer">Belum Diverifikasi</flux:button>
                        </flux:modal.trigger>
                    </td>
                    @else
                    <td class="text-center">
                        <flux:badge color="blue">Terverifikasi</flux:badge>
                    </td>
                    @endif
                    <td class="text-center">
                        <flux:button href="{{ route('user.edit', $user) }}" wire:navigate>Edit
                        </flux:button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </section>

    {{-- Pagination --}}
    <div class="mt-10 w-full lg:w-96">
        {{ $users->links() }}
    </div>



    @foreach ($users as $user)
    <flux:modal name="verifikasi-user-{{$user->id}}" class="min-w-[26rem] text-left">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Apakah Anda Yakin Ingin Memverifikasi </br> {{ $user->name
                    }} ?
                </flux:heading>
                {{-- <flux:text class="mt-2">
                    <p>Lorem ipsum dolor sit amet.</p>
                    <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit.</p>
                </flux:text> --}}
            </div>
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Kembali</flux:button>
                </flux:modal.close>
                <flux:button variant="filled" wire:click="verifyUser({{ $user->id }})">
                    Verifikasi</flux:button>
            </div>
        </div>
    </flux:modal>
    @endforeach
</div>