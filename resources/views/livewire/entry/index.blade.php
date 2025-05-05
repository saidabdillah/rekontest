<div class="relative">
    <flux:heading size="xl">Lihat Entry</flux:heading>
    <flux:separator class="my-5" />

    <flux:modal.trigger name="view-entry-1">
        <flux:button variant="primary">Cari Table 1</flux:button>
    </flux:modal.trigger>

    <flux:modal name="view-entry-1" class="w-sm lg:w-3xl" :dismissible="false">
        <form wire:submit="cariEntry">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Cari Entry</flux:heading>
                    <flux:text class="mt-2">Lorem ipsum dolor sit amet.</flux:text>
                </div>

                <flux:input label="Tanggal Transaksi" type="date" wire:model="date" wire:change="cariTanggal" />

                <flux:select wire:model="kode_transaksi" label="Kode Transaksi" placholder="Pilih Kode Transaksi">
                    <flux:select.option>Pilih Kode Transaksi</flux:select.option>
                    @if(isset($rekon))
                    @foreach ($rekon as $value)
                    <flux:select.option>{{ $value->kode_transaksi . '-' . $value->tanggal . '-' . $value->penerimaan}}
                    </flux:select.option>
                    @endforeach
                    @endif
                </flux:select>
                <div class="flex">
                    <flux:spacer />

                    <flux:button type="submit" variant="primary">Cari</flux:button>
                </div>
            </div>
        </form>
    </flux:modal>
    <flux:modal name="view-entry-2" class="w-sm lg:w-3xl" :dismissible="false">
        <form wire:submit="cariEntry2">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Cari Entry</flux:heading>
                    <flux:text class="mt-2">Lorem ipsum dolor sit amet.</flux:text>
                </div>
                <flux:select wire:model="nomorBuktiSelect" label="Nomor Bukti" placholder="Pilih Nomor Bukti">
                    <flux:select.option>Pilih Nomor Bukti</flux:select.option>
                    @foreach ($nomorBukti as $bukti)
                    <flux:select.option>{{ $bukti }}</flux:select.option>
                    @endforeach
                </flux:select>
                <div class="flex">
                    <flux:spacer />
                    <flux:button type="submit" variant="primary">Cari</flux:button>
                </div>
            </div>
        </form>
    </flux:modal>

    <section>
        <div class="grid gap-x-4">
            @if($rekon)
            <div class="mt-10 grid md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-4">
                <flux:field>
                    <flux:label>Hal</flux:label>
                    <flux:input disabled value="{{ $rekon->hal }}" />
                </flux:field>
                <flux:field>
                    <flux:label>Urut</flux:label>
                    <flux:input disabled value="{{ $rekon->urut }}" />
                </flux:field>
                <flux:field>
                    <flux:label>Tanggal</flux:label>
                    <flux:input disabled value="{{ $rekon->tanggal }}" />
                </flux:field>
                <flux:field>
                    <flux:label>Kode Transaksi</flux:label>
                    <flux:input disabled value="{{ $rekon->kode_transaksi }}" />
                </flux:field>
                <flux:field>
                    <flux:label>Penerimaan</flux:label>
                    <flux:input disabled value="{{ $rekon->penerimaan }}" />
                </flux:field>
                <flux:field>
                    <flux:label>Pengeluaran</flux:label>
                    <flux:input disabled value="{{ $rekon->pengeluaran }}" />
                </flux:field>
                <flux:textarea disabled label="Uraian" rows="auto">{{ $rekon->uraian }}
                </flux:textarea>
                <flux:field>
                    <flux:label>Total Kode Transaksi</flux:label>
                    <flux:input disabled value="{{ $totalKodeTransaksi }}" />
                </flux:field>
            </div>
            <flux:separator class="my-10" />
            <flux:modal.trigger name="view-entry-2">
                <flux:button variant="primary" class="w-fit">Cari Table 2</flux:button>
            </flux:modal.trigger>
            @endif
            @if($table2)
            <div class="mt-8 grid md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-4">
                <flux:field>
                    <flux:label>Tanggal</flux:label>
                    <flux:input disabled value="{{ $table2->tanggal }}" />
                </flux:field>
                <flux:field>
                    <flux:label>Nomor Bukti</flux:label>
                    <flux:input disabled value="{{ $table2->nomor_bukti }}" />
                </flux:field>
                <flux:field>
                    <flux:label>Penerimaan</flux:label>
                    <flux:input disabled value="{{ $table2->penerimaan }}" />
                </flux:field>
                <flux:field>
                    <flux:label>Pengeluaran</flux:label>
                    <flux:input disabled value="{{ $table2->pengeluaran }}" />
                </flux:field>
                <flux:textarea disabled label="Uraian" rows="auto">{{ $table2->uraian }}
                </flux:textarea>
                <flux:field>
                    <flux:label>Total Nomor Bukti</flux:label>
                    <flux:input disabled value="{{ $totalNomorBukti }}" />
                </flux:field>
            </div>
            @endif
        </div>
    </section>

    @can('create')
    @if($rekon && $table2 && !$isActiveUpload)
    <section>
        <flux:heading class="mt-10 mb-3" size="xl">Upload Bukti</flux:heading>
        <form wire:submit="">
            <div class="grid sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-4">
                <flux:input type="file" wire:model="logo" />
                <flux:button variant="primary" type="submit">Simpan</flux:button>
            </div>
        </form>
    </section>
    @endif
    @endcan

</div>