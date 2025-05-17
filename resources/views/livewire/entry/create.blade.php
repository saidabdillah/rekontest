<div>
    <flux:heading size="xl">Entry</flux:heading>
    <flux:separator class="my-5" />

    <section class="grid gap-4 mt-10">
        <div class="grid gap-4 sm:w-1/2 xl:w-1/3 items-end">
            <flux:input type="file" wire:model="rekon" accept=".xlsx,xls" label="Rekon" />
            <flux:button variant="primary" wire:click="uploadRekon">Upload Rekon</flux:button>
        </div>
        <div class="grid gap-4 sm:w-1/2 xl:w-1/3 items-end">
            <flux:input type="file" wire:model="bkubud" accept=".xlsx,xls" label="BKUBUD" />
            <flux:button variant="primary" wire:click="uploadBKUBUD">Upload</flux:button>
        </div>
        <div class="grid gap-4 sm:w-1/2 xl:w-1/3 items-end">
            <flux:input type="file" wire:model="banyakFile" label="SKPD" accept=".xlsx,xls" multiple />
            <flux:button variant="primary" wire:click="test">Upload</flux:button>
        </div>
        {{-- <form>
            <div class="grid gap-4 sm:w-1/2 xl:w-1/3 items-end">
                <flux:input type="file" wire:model="logo" label="Lorem Ipsum" />
                <flux:button variant="primary">Upload</flux:button>
            </div>
        </form> --}}
        <form>
    </section>
</div>

@script
<script>
    $wire.on('notif', (e) => {
        Swal.fire({
            title: e.title,
            text: e.message,
            icon: e.type,
            timer: 2000
        })
});
</script>
@endscript