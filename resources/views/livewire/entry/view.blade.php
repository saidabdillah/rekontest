<div class="relative">
    <flux:heading size="xl">Lihat Entry</flux:heading>
    <flux:separator class="my-5" />



    <flux:modal.trigger name="view-entry">
        <flux:button variant="primary">Cari Entry</flux:button>
    </flux:modal.trigger>

    <flux:modal name="view-entry" class="w-sm lg:w-3xl" :dismissible="false">
        <form wire:submit="search">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Cari Entry</flux:heading>
                    <flux:text class="mt-2">Lorem ipsum dolor sit amet.</flux:text>
                </div>

                <flux:input label="Tanggal Transaksi" type="date" wire:model="date" />

                <flux:select wire:model="kode Transaksi" label="Kode" placeholder="Pilih Kode">
                    <flux:select.option>a</flux:select.option>
                    <flux:select.option>b</flux:select.option>
                    <flux:select.option>c</flux:select.option>
                </flux:select>

                <flux:select wire:model="Nomor Bukti" label="Bukti" placeholder="Pilih Bukti">
                    <flux:select.option>a</flux:select.option>
                    <flux:select.option>b</flux:select.option>
                    <flux:select.option>c</flux:select.option>
                </flux:select>


                <div class="flex">
                    <flux:spacer />

                    <flux:button type="submit" variant="primary">Cari</flux:button>
                </div>
            </div>
        </form>
    </flux:modal>

    <section class="mt-10">
        <div class="grid gap-x-4">
            <div class="grid md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-4 mt-3">
                <flux:field>
                    <flux:label>Hal</flux:label>
                    <flux:input disabled wire:model="hal" />
                    <flux:error name="Hal" />
                </flux:field>
                <flux:field>
                    <flux:label>Urut</flux:label>
                    <flux:input disabled wire:model="urut" />
                    <flux:error name="urut" />
                </flux:field>
                <flux:field>
                    <flux:label>Tanggal</flux:label>
                    <flux:input disabled wire:model="tanggal" />
                    <flux:error name="tanggal" />
                </flux:field>
                <flux:field>
                    <flux:label>Kode Transaksi</flux:label>
                    <flux:input disabled wire:model="kodeTransaksi" />
                    <flux:error name="kodeTransaksi" />
                </flux:field>
                <flux:field>
                    <flux:label>Penerimaan</flux:label>
                    <flux:input disabled wire:model="penerimaan" />
                    <flux:error name="penerimaan" />
                </flux:field>
                <flux:field>
                    <flux:label>Pengeluaran</flux:label>
                    <flux:input disabled wire:model="pengeluaran" />
                    <flux:error name="pengeluaran" />
                </flux:field>
                <flux:textarea disabled label="Uraian" wire:model="uraian" rows="auto" />
                <flux:field>
                    <flux:label>Total Kode Transaksi</flux:label>
                    <flux:input disabled wire:model="totalKodeTransaksi" />
                    <flux:error name="totalKodeTransaksi" />
                </flux:field>
            </div>

            <flux:separator class="my-10" />

            <div class="grid md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-4 mt-3">
                <flux:field>
                    <flux:label>Tanggal</flux:label>
                    <flux:input disabled wire:model="tanggal" />
                    <flux:error name="tanggal" />
                </flux:field>
                <flux:field>
                    <flux:label>Nomor Bukti</flux:label>
                    <flux:input disabled wire:model="nomorBukti" />
                    <flux:error name="nomorBukti" />
                </flux:field>
                <flux:field>
                    <flux:label>Penerimaan</flux:label>
                    <flux:input disabled wire:model="penerimaan" />
                    <flux:error name="penerimaan" />
                </flux:field>
                <flux:field>
                    <flux:label>Pengeluaran</flux:label>
                    <flux:input disabled wire:model="pengeluaran" />
                    <flux:error name="pengeluaran" />
                </flux:field>
                <flux:textarea disabled label="Uraian" wire:model="uraian" rows="auto" />
                <flux:field>
                    <flux:label>Total Nomor Bukti</flux:label>
                    <flux:input disabled wire:model=" totalNomorBukti" />
                    <flux:error name="totalNomorBukti" />
                </flux:field>
            </div>
        </div>
    </section>


    <flux:separator class="my-10" />

    <section>
        <flux:heading class="mt-10 mb-3" size="xl">Upload Bukti</flux:heading>

        <form>
            <div class="grid sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-4">
                <flux:input type="file" wire:model="logo" />
                <flux:button variant="primary">Upload</flux:button>
            </div>
        </form>
    </section>

    @if (session('status'))
    <livewire:components-livewire.toast :message="session('status')" />
    @endif

</div>