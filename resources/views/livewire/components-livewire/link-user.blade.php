<flux:navlist.item icon="inbox" badge="{{ $new_users }}" :href="route('messages.index')"
  :current="request()->routeIs('messages.index')" wire:navigate>Pesan
</flux:navlist.item>