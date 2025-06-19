<div class="relative">
    <flux:heading size="xl">Lihat Entry</flux:heading>
    <flux:separator class="my-5" />

    <flux:modal.trigger name="lihat-rekon">
        <flux:button variant="primary">Rekon</flux:button>
    </flux:modal.trigger>

    <flux:modal name="lihat-rekon" class="w-sm lg:w-3xl">
        <form wire:submit="cariRekon">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Cari Entry</flux:heading>
                </div>

                <flux:input label="Tanggal Transaksi" type="date" wire:model="tanggal" autofocus
                    wire:change="cariTanggal" />

                <flux:select wire:model="kode_transaksi">
                    <flux:select.option selected value="">Pilih Kode Transaksi</flux:select.option>
                    @foreach ($kodeTransaksi as $kode)
                    <flux:select.option value="{{ $kode->kode_transaksi }}">{{ $kode->id_rekon }}</flux:select.option>
                    @endforeach
                </flux:select>
                <flux:error name="kode_transaksi" />


                <div class="flex">
                    <flux:spacer />
                    <flux:button type="submit" variant="primary">Cari</flux:button>
                </div>
            </div>
        </form>
    </flux:modal>

    <section>
        <div class="grid gap-x-4">
            <div class="mt-10 grid md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-4">
                <flux:field>
                    <flux:label>Hal</flux:label>
                    <flux:input readonly value="{{ $rekon->hal ?? '' }}" />
                </flux:field>
                <flux:field>
                    <flux:label>Urut</flux:label>
                    <flux:input readonly value="{{ $rekon->urut ?? '' }}" />
                </flux:field>
                <flux:field>
                    <flux:label>Tanggal</flux:label>
                    <flux:input readonly value="{{ $rekon->tanggal ?? '' }}" />
                </flux:field>
                <flux:field>
                    <flux:label>Kode Transaksi</flux:label>
                    <flux:input readonly value="{{ $rekon->kode_transaksi ?? '' }}" />
                </flux:field>
                <flux:field>
                    <flux:label>Penerimaan</flux:label>
                    <flux:input readonly
                        value="{{ $rekon?->penerimaan ? Number::currency($rekon->penerimaan, 'IDR', 'id') : '' }}" />
                </flux:field>
                <flux:field>
                    <flux:label>Pengeluaran</flux:label>
                    <flux:input readonly
                        value="{{ $rekon?->pengeluaran ? Number::currency($rekon->pengeluaran, 'IDR', 'id') : '' }}" />
                </flux:field>
                <flux:textarea readonly label="Uraian" rows="auto">{{ $rekon->uraian ?? '' }}
                </flux:textarea>
                <flux:field>
                    <flux:label>Total Kode Transaksi</flux:label>
                    <flux:input readonly
                        value="{{ $totalKodeTransaksi ? Number::currency($totalKodeTransaksi, 'IDR', 'id') : '' }}" />
                </flux:field>
            </div>

            <flux:separator class="mt-10 mb-5" />

            <flux:modal.trigger name="lihat-bkubud" wire:click="cariBkubuds">
                <flux:button variant="primary" class="w-fit">BKUBUD</flux:button>
            </flux:modal.trigger>

            <flux:modal name="lihat-bkubud" class="w-sm lg:w-6xl">
                <form wire:submit="cariBkubud">
                    <div class="space-y-6">
                        <div>
                            <flux:heading size="lg">Cari BKUBUD</flux:heading>
                        </div>

                        <flux:input autofocus wire:model="query" wire:input.debounce.150ms="cariBkubuds"
                            placeholder="Cari BKUBUD">
                            <x-slot name="iconTrailing">
                                <flux:button size="sm" variant="subtle" icon="x-mark" class="-mr-1"
                                    wire:click="deleteQuery" />
                            </x-slot>
                        </flux:input>
                        <flux:error name="query" />

                        <ul class="-mt-5 overflow-y-auto max-h-64">
                            @forelse($bkubuds as $item)
                            <li class="p-3 cursor-pointer overflow-x-hidden mb-2 hover:text-black hover:bg-zinc-100 rounded-lg border mt-3 dark:hover:bg-zinc-100 dark:hover:text-black"
                                wire:click="pilihBkubud('{{  $item->no_bukti}}')">
                                {{ $item->tanggal }} # {{ $item->no_bukti }} # {{ $item->penerimaan }} # {{
                                $item->pengeluaran }}</li>
                            @empty
                            <li class="cursor-pointer border-2 p-3 mt-3 rounded-lg">Tidak ada</li>
                            @endforelse
                        </ul>
                        <div class="flex">
                            <flux:spacer />
                            <flux:button type="submit" variant="primary">Cari</flux:button>
                        </div>
                    </div>
                </form>
            </flux:modal>

            <div class="mt-10 grid md:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-4">
                <flux:field>
                    <flux:label>Tanggal</flux:label>
                    <flux:input readonly value="{{ $bkubud->tanggal ?? '' }}" />
                </flux:field>
                <flux:field>
                    <flux:label>Nomor Bukti</flux:label>
                    <flux:input readonly value="{{ $bkubud->no_bukti ?? '' }}" />
                </flux:field>
                <flux:textarea readonly label="Uraian" rows="auto">{{ $bkubud->uraian ?? '' }}
                </flux:textarea>
                <flux:field>
                    <flux:label>Penerimaan</flux:label>
                    <flux:input readonly
                        value="{{ $bkubud?->penerimaan ? Number::currency($bkubud->penerimaan ,'IDR', 'id') : '' }}" />
                </flux:field>
                <flux:field>
                    <flux:label>Pengeluaran</flux:label>
                    <flux:input readonly
                        value="{{ $bkubud?->pengeluaran ? Number::currency($bkubud->pengeluaran ,'IDR', 'id') : '' }}" />
                </flux:field>
                <flux:field>
                    <flux:label>Total Nomor Bukti</flux:label>
                    <flux:input readonly
                        value="{{ $totalNomorBukti >= 0 && isset($totalNomorBukti) ? Number::currency($totalNomorBukti, 'IDR', 'id') : '' }}" />
                </flux:field>
            </div>
        </div>
    </section>

    <flux:separator class="mt-10 mb-5" />

    <section>
        <form wire:submit="simpanEntry">
            <div class="grid sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-4">
                <flux:button variant="primary" type="submit">Simpan</flux:button>
            </div>
        </form>
    </section>

</div>