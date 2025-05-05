<div class="relative">
    <flux:heading size="xl">Lihat Entry</flux:heading>
    <flux:separator class="my-5" />

    <flux:modal.trigger name="lihat-rekon">
        <flux:button variant="primary">Rekon</flux:button>
    </flux:modal.trigger>

    <flux:modal name="lihat-rekon" class="w-sm lg:w-3xl" :dismissible="false">
        <form wire:submit="cariRekon">
            <div class="space-y-6">
                <div>
                    <flux:heading size="lg">Cari Entry</flux:heading>
                    <flux:text class="mt-2">Lorem ipsum dolor sit amet.</flux:text>
                </div>

                <flux:input label="Tanggal Transaksi" type="date" wire:model="tanggal" wire:change="cariTanggal" />

                <flux:select wire:model="kode_transaksi" label="Kode Transaksi" placholder="Pilih Kode Transaksi">
                    <flux:select.option>Pilih Kode Transaksi</flux:select.option>
                    @forelse ($kodeTransaksi as $kode)
                    <flux:select.option>{{ $kode }}</flux:select.option>
                    @empty
                    <flux:select.option>Tidak Ada</flux:select.option>
                    @endforelse
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
                    <flux:input disabled value="{{ $rekon->hal ?? '' }}" />
                </flux:field>
                <flux:field>
                    <flux:label>Urut</flux:label>
                    <flux:input disabled value="{{ $rekon->urut ?? '' }}" />
                </flux:field>
                <flux:field>
                    <flux:label>Tanggal</flux:label>
                    <flux:input disabled value="{{ $rekon->tanggal ?? '' }}" />
                </flux:field>
                <flux:field>
                    <flux:label>Kode Transaksi</flux:label>
                    <flux:input disabled value="{{ $rekon->kode_transaksi ?? '' }}" />
                </flux:field>
                <flux:field>
                    <flux:label>Penerimaan</flux:label>
                    <flux:input disabled value="{{ $rekon->penerimaan ?? '' }}" />
                </flux:field>
                <flux:field>
                    <flux:label>Pengeluaran</flux:label>
                    <flux:input disabled value="{{ $rekon->pengeluaran ?? '' }}" />
                </flux:field>
                <flux:textarea disabled label="Uraian" rows="auto">{{ $rekon->uraian ?? '' }}
                </flux:textarea>
                <flux:field>
                    <flux:label>Total Kode Transaksi</flux:label>
                    <flux:input disabled value="{{ $totalKodeTransaksi ?? 0 }}" />
                </flux:field>
            </div>

            <flux:separator class="mt-10 mb-5" />

            <flux:modal.trigger name="lihat-bkubud">
                <flux:button variant="primary" class="w-fit">BKU_BUD</flux:button>
            </flux:modal.trigger>

            <flux:modal name="lihat-bkubud" class="w-sm lg:w-3xl" :dismissible="false">
                <form wire:submit="cariBkubud">
                    <div class="space-y-6">
                        <div>
                            <flux:heading size="lg">Cari BKU_BUD</flux:heading>
                            <flux:text class="mt-2">Lorem ipsum dolor sit amet.</flux:text>
                        </div>

                        <div x-data="{ isOpen: false }" class="relative">
                            <input type="search" id="searchInput" x-on:input="isOpen = true"
                                class="block w-full p-2 border border-gray-300 rounded-md" placeholder="Search...">
                            <div x-show="isOpen" id="suggestions"
                                class="absolute mt-2 bg-white border border-gray-300 rounded-md shadow-md w-full">
                                said ganteng
                            </div>
                        </div>

                        <flux:select wire:model="nomor_bukti" label="Nomor Bukti" placholder="Pilih Nomor Bukti">
                            <flux:select.option>Pilih Nomor Bukti</flux:select.option>
                            @forelse ($nomorBukti as $bukti)
                            <flux:select.option>{{ $bukti }}</flux:select.option>
                            @empty
                            <flux:select.option>Tidak Ada</flux:select.option>
                            @endforelse
                        </flux:select>
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
                    <flux:input disabled value="{{ $bkubud->tanggal ?? '' }}" />
                </flux:field>
                <flux:field>
                    <flux:label>Nomor Bukti</flux:label>
                    <flux:input disabled value="{{ $bkubud->no_bukti ?? '' }}" />
                </flux:field>
                <flux:textarea disabled label="Uraian" rows="auto">{{ $bkubud->uraian ?? '' }}
                </flux:textarea>
                <flux:field>
                    <flux:label>Penerimaan</flux:label>
                    <flux:input disabled value="{{ $bkubud->penerimaan ?? '' }}" />
                </flux:field>
                <flux:field>
                    <flux:label>Pengeluaran</flux:label>
                    <flux:input disabled value="{{ $bkubud->pengeluaran ?? '' }}" />
                </flux:field>
                <flux:field>
                    <flux:label>Total Nomor Bukti</flux:label>
                    <flux:input disabled value="{{ $totalNomorBukti ?? 0 }}" />
                </flux:field>
            </div>
        </div>
    </section>

    @can('create')
    <section>
        <flux:heading class="mt-10 mb-3" size="xl">Upload Bukti</flux:heading>
        <form wire:submit="">
            <div class="grid sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-4 gap-4">
                <flux:input type="file" wire:model="logo" />
                <flux:button variant="primary" type="submit">Simpan</flux:button>
            </div>
        </form>
    </section>
    @endcan

</div>