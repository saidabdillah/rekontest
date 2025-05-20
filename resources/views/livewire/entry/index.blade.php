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
                    <flux:text class="mt-2">Lorem ipsum dolor sit amet.</flux:text>
                </div>

                <flux:input label="Tanggal Transaksi" type="date" wire:model="tanggal" autofocus
                    wire:change="cariTanggal" />

                <flux:select wire:model="kode_transaksi" wire:change="pilihRekon($event.target.value)">
                    <flux:select.option selected value="">Pilih Kode Transaksi</flux:select.option>
                    @foreach ($kodeTransaksi as $kode)
                    <flux:select.option value="{{ $kode->kode_transaksi }}">{{ $kode->id_rekon }}</flux:select.option>
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
                    <flux:input readonly value="{{ $rekon->penerimaan ?? '' }}" />
                </flux:field>
                <flux:field>
                    <flux:label>Pengeluaran</flux:label>
                    <flux:input readonly value="{{ $rekon->pengeluaran ?? '' }}" />
                </flux:field>
                <flux:textarea readonly label="Uraian" rows="auto">{{ $rekon->uraian ?? '' }}
                </flux:textarea>
                <flux:field>
                    <flux:label>Total Kode Transaksi</flux:label>
                    <flux:input readonly value="{{ $totalKodeTransaksi ?? '' }}" />
                </flux:field>
            </div>

            <flux:separator class="mt-10 mb-5" />

            <flux:modal.trigger name="lihat-bkubud" wire:click="cariBkubuds">
                <flux:button variant="primary" class="w-fit">BKU_BUD</flux:button>
            </flux:modal.trigger>

            <flux:modal name="lihat-bkubud" class="w-sm lg:w-3xl">
                <form wire:submit="cariBkubud">
                    <div class="space-y-6">
                        <div>
                            <flux:heading size="lg">Cari BKU_BUD</flux:heading>
                            <flux:text class="mt-2">Lorem ipsum dolor sit amet.</flux:text>
                        </div>
                        <div x-data>
                            <flux:input type="search" autofocus wire:model="query" placeholder="Cari BKUBUD"
                                wire:keydown="cariBkubuds" wire:click="cariBkubuds" autocomplete="false"
                                wire:load="cariBkubuds" />

                            <ul class="mt-2 overflow-y-auto max-h-64">
                                @forelse($bkubuds as $item)
                                <li class="p-3 cursor-pointer mb-2 hover:text-black hover:bg-zinc-100 rounded-lg border mt-3 dark:hover:bg-zinc-100 dark:hover:text-black"
                                    wire:click="pilihBkubud('{{  $item->no_bukti}}')">
                                    {{
                                    $item->no_bukti }}</li>
                                @empty
                                <li class="cursor-pointer border-2 p-3 mt-3 rounded-lg">Tidak ada</li>
                                @endforelse
                            </ul>
                        </div>
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
                    <flux:input readonly value="{{ $bkubud->penerimaan ?? '' }}" />
                </flux:field>
                <flux:field>
                    <flux:label>Pengeluaran</flux:label>
                    <flux:input readonly value="{{ $bkubud->pengeluaran ?? '' }}" />
                </flux:field>
                <flux:field>
                    <flux:label>Total Nomor Bukti</flux:label>
                    <flux:input readonly value="{{ $totalNomorBukti ?? '' }}" />
                </flux:field>
            </div>
        </div>
    </section>

    @canany(['create', 'view'])
    <flux:separator class="mt-10 mb-5" />

    <section>
        <form wire:submit="simpanEntry">
            <div class="grid sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-4">
                <flux:button variant="primary" type="submit">Simpan</flux:button>
            </div>
        </form>
    </section>
    @endcan

</div>