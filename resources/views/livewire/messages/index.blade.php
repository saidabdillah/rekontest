<div>
    <flux:heading size="xl">Pesan</flux:heading>
    <flux:separator class="my-5" />
    <section class="w-full lg:w-1/2 h-[850px] overflow-y-auto bg-zinc-100 dark:bg-zinc-600 p-10 rounded-md">
        <ul class="h-full">
            @forelse ($notifications as $notification)
            <li wire:key="{{ $notification->id }}"
                class="flex flex-col px-10 py-5 mb-5 bg-zinc-300 dark:bg-zinc-800 rounded-xl cursor-pointer">
                <div wire:click="read({{ $notification->data['user']['id'] }})"
                    class="flex justify-between itcems-center">
                    <div>
                        <h3 class="text-2xl font-medium">{{ $notification->data['user']['name'] }}</h3>
                        <h6 class="text-sm mb-3 text-slate-500">{{ $notification->data['user']['email'] }}</h6>
                    </div>
                    <h6 class="text-sm text-slate-500">{{ $notification->created_at->diffForHumans() }}</h6>
                </div>
                <p class="text-justify font-light">{{ $notification->data['message'] }}</p>
            </li>
            @empty
            <li class="flex flex-col px-10 py-5 mb-5 bg-zinc-800 rounded-xl">
                <h3 class="text-2xl text-center text-white dark:text-white">Tidak ada pesan.</h3>
            </li>
            @endforelse
        </ul>
    </section>
</div>