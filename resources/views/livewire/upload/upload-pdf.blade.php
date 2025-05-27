<div>
    <flux:heading size="xl">Upload PDF</flux:heading>
    <flux:separator class="my-5" />

    <div class="w-fit mb-5">
        <form class="flex gap-x-5">
            <flux:input icon="magnifying-glass" type="search" wire:input.debounce.150ms="cariData" wire:model="cari"
                placeholder="Cari..." />
        </form>
    </div>

    <div class="overflow-x-scroll w-full">
        <table class="w-[2000px]">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal Kode Transaksi</th>
                    <th>Tanggal Nomor Bukti</th>
                    <th>ID Rekon</th>
                    <th>Kode Transaksi</th>
                    <th>Nomor Bukti</th>
                    <th>Total Rekon</th>
                    <th>Total Bukti</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tb_data as $data)
                <tr>
                    <td>
                        {{ $loop->iteration + ($tb_data->currentPage() - 1) * $tb_data->perPage() }}
                    </td>
                    <td>{{ $data->tanggal_kode_transaksi }}</td>
                    <td>{{ $data->tanggal_nomor_bukti }}</td>
                    <td>{{ $data->id_rekon }}</td>
                    <td>{{ $data->kode_transaksi }}</td>
                    <td>{{ $data->nomor_bukti }}</td>
                    <td>{{ $data->total_rekon }}</td>
                    <td>{{ $data->total_bukti }}</td>
                    @if ($data->file_path)
                    <td class="text-center">
                        <flux:button target="_blank" href="{{ Storage::url($data->file_path) }}">Download</flux:button>
                    </td>
                    @else
                    <td class="text-center">
                        <flux:modal.trigger :name="'uploadPdf-' . $data->id">
                            <flux:button variant="primary" class="cursor-pointer">Upload Pdf</flux:button>
                        </flux:modal.trigger>
                    </td>
                    @endif
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="text-center">Tidak Ada</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($cari == '')
    <div class="mt-10">
        {{ $tb_data->links() }}
    </div>
    @endif


    @foreach ($tb_data as $data)
    <flux:modal :name="'uploadPdf-' . $data->id" class="md:w-96">
        <form class="space-y-6" wire:submit="uploadPdf({{ $data->id }})">
            <div>
                <flux:heading size="lg">Upload PDF</flux:heading>
                <flux:text class="mt-2">Lorem ipsum dolor sit amet.</flux:text>
            </div>

            <flux:input type="file" wire:model="filePdf" accept=".pdf" />
            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary" class="cursor-pointer">Upload</flux:button>
            </div>
        </form>
    </flux:modal>
    @endforeach
</div>