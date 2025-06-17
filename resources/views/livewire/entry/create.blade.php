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
            <flux:input type="file" wire:model="tb_data" accept=".xlsx,xls" label="Data" />
            <flux:button variant="primary" wire:click="uploadTbData">Upload Data</flux:button>
        </div>

        <div class="grid gap-4 sm:w-1/2 xl:w-1/3 items-end">
            <flux:input type="file" wire:model="tb_saldo_awal" accept=".xlsx,xls" label="Saldo Awal" />
            <flux:button variant="primary" wire:click="uploadTbSaldoAwal">Upload Saldo Awal</flux:button>
        </div>

        <div class="grid gap-4 sm:w-1/2 xl:w-1/3 items-end">
            <flux:input type="file" wire:model="skpd" label="SKPD" accept=".xlsx,xls" />
            <flux:button variant="primary" wire:click="uploadSkpd">Upload SKPD</flux:button>
        </div>

        <div class="grid gap-4 sm:w-1/2 xl:w-1/3 items-end">
            <flux:input type="file" wire:model="sub_unit" accept=".xlsx,xls" label="Sub Unit" />
            <flux:button variant="primary" wire:click="uploadSubUnit">Upload Sub Unit</flux:button>
        </div>

        <div class="grid gap-4 sm:w-1/2 xl:w-1/3 items-end">
            <flux:input type="file" wire:model="reg_sp2d" accept=".xlsx,xls" label="REG SP2D" />
            <flux:button variant="primary" wire:click="uploadRegSp2d">Upload REG SP2D</flux:button>
        </div>

        <div class="grid gap-4 sm:w-1/2 xl:w-1/3 items-end">
            <flux:input type="file" wire:model="reg_spb" accept=".xlsx,xls" label="REG SPB" />
            <flux:button variant="primary" wire:click="uploadRegSpb">Upload REG SPB</flux:button>
        </div>

        <form>
    </section>
</div>