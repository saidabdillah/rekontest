<div>
    <flux:heading size="xl">Entry</flux:heading>
    <flux:separator class="my-5" />

    <section class="grid gap-4 mt-10">
        <form wire:submit="simpanFileExcel1" enctype="multipart/form-data">
            <div class="grid gap-4 sm:w-1/2 xl:w-1/3 items-end">
                <flux:input type="file" wire:model="excelFile1" label="Tabel 1" />
                <flux:button variant="primary" type="submit">Upload</flux:button>
            </div>
        </form>
        <form wire:submit="simpanFileExcel2" enctype="multipart/form-data">
            <div class="grid gap-4 sm:w-1/2 xl:w-1/3 items-end">
                <flux:input type="file" wire:model="excelFile2" label="Tabel 2" />
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