<div>
    <flux:heading size="xl">Messages</flux:heading>
    <flux:separator class="my-5" />
    <section class="w-1/2 h-[850px] overflow-y-auto bg-zinc-100 p-10 rounded-md">
        <ul class="h-full">
            @foreach ($notifications as $notification)
            <li class="flex flex-col px-10 py-5 mb-5 bg-zinc-300 rounded-xl">
                <div class="flex justify-between itcems-center">
                    <div>
                        <h3 class="text-2xl font-medium">{{ $notification->data['user']['name'] }}</h3>
                        <h6 class="text-sm mb-3 text-slate-500">{{ $notification->data['user']['email'] }}</h6>
                    </div>
                    <h6 class="text-sm text-slate-500">{{ $notification->created_at->diffForHumans() }}</h6>
                </div>
                <p class="text-justify font-light">{{ $notification->data['message'] }}</p>
            </li>
            @endforeach
        </ul>
    </section>
</div>