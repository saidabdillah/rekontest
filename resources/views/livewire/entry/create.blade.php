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
            <flux:button variant="primary" wire:click="uploadBKUBUD">Upload BKUBUD</flux:button>
        </div>

        <div class="grid gap-4 sm:w-1/2 xl:w-1/3 items-end">
            <flux:input type="file" wire:model="banyakFile" label="SKPD" accept=".xlsx,xls" />
            <flux:button variant="primary" wire:click="uploadSkpd">Upload SKPD</flux:button>
        </div>

        <div class="grid gap-4 sm:w-1/2 xl:w-1/3 items-end">
            <flux:input type="file" wire:model="sub_unit" accept=".xlsx,xls" label="Sub Unit" />
            <flux:button variant="primary" wire:click="uploadSubUnit">Upload Sub Unit</flux:button>
        </div>

        <div class="grid gap-4 sm:w-1/2 xl:w-1/3 items-end">
            <flux:input type="file" wire:model="sub_unit" accept=".xlsx,xls" label="Sub Unit" />
            <flux:button variant="primary" wire:click="uploadSubUnit">Upload Sub Unit</flux:button>
        </div>

        <form>
    </section>
</div>