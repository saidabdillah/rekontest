<div>
    <flux:heading size="xl">Entry</flux:heading>
    <flux:separator class="my-5" />

    <section class="grid gap-4 mt-10">
        <form wire:submit="uploadRekon" enctype="multipart/form-data">
            <div class="grid gap-4 sm:w-1/2 xl:w-1/3 items-end">
                <flux:input type="file" wire:model="rekon" label="Rekon" />
                <flux:button variant="primary" type="submit">Upload Rekon</flux:button>
            </div>
        </form>
        <form wire:submit="uploadBKUBUD" enctype="multipart/form-data">
            <div class="grid gap-4 sm:w-1/2 xl:w-1/3 items-end">
                <flux:input type="file" wire:model="bkubud" label="BKUBUD" />
                <flux:button variant="primary" type="submit">Upload</flux:button>
            </div>
        </form>
        <form>
            <div class="grid gap-4 sm:w-1/2 xl:w-1/3 items-end">
                <flux:input type="file" wire:model="logo" label="Lorem Ipsum" />
                <flux:button variant="primary">Upload</flux:button>
            </div>
        </form>
        <form>
            <div class="grid gap-4 sm:w-1/2 xl:w-1/3 items-end">
                <flux:input type="file" wire:model="logo" label="Lorem Ipsum" />
                <flux:button variant="primary">Upload</flux:button>
            </div>
        </form>
        <form>
    </section>
</div>