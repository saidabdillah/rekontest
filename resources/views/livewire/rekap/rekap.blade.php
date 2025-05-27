<div>
    <flux:heading size="xl">Rekap</flux:heading>
    <flux:separator class="my-5" />

    <div class="overflow-x-scroll w-full">
        <table class="w-[2000px] 2xl:w-full">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Sub Unit</th>
                    <th>Nama SKPD</th>
                    <th>Total Anggaran</th>
                    <th>Realisasi</th>
                    <th>Sisa Anggaran</th>
                    <th>Persentase</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}.</td>
                    <td>{{ $item->kd_sub_unit }}</td>
                    <td>{{ $item->nm_sub_unit }}</td>
                    <td class="px-2">
                        <div class="flex justify-between w-full">
                            <span class="text-left">Rp.</span>
                            <span class="text-right">{{ number_format($item->total_anggaran, 2, ',', '.') ?? 0 }}</span>
                        </div>
                    </td>
                    <td class="px-2">
                        <div class="flex justify-between w-full">
                            <span class="text-left">Rp.</span>
                            <span class="text-right">{{ number_format($item->realisasi, 2, ',', '.') ?? 0 }}</span>
                        </div>
                    </td>
                    <td class="px-2">
                        <div class="flex justify-between w-full">
                            <span class="text-left">Rp.</span>
                            <span class="text-right">{{ number_format($item->selisih, 2, ',', '.') ?? 0 }}</span>
                        </div>
                    </td>
                    <td class="text-right">
                        {{ number_format($item->persentase, 2, ',', '.') . '%' ?? 0 }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak Ada</td>
                </tr>
                @endforelse
                <tr>
                    <th colspan="3">Total</th>
                    <th>
                        <div class="flex justify-between w-full">
                            <span class="text-left">Rp.</span>
                            <span class="text-right">{{ number_format($total_anggaran, 2, ',', '.') ?? 0 }}</span>
                        </div>
                    </th>
                    <th>
                        <div class="flex justify-between w-full">
                            <span class="text-left">Rp.</span>
                            <span class="text-right">{{ number_format( $realisasi , 2, ',', '.') ?? 0 }}</span>
                        </div>
                    </th>
                    <th>
                        <div class="flex justify-between w-full">
                            <span class="text-left">Rp.</span>
                            <span class="text-right">{{ number_format( $selisih , 2, ',', '.') ?? 0 }}</span>
                        </div>
                    </th>
                    <th class="text-right">
                        {{ $persentase . '%' ?? 0 }}
                    </th>
                </tr>
            </tbody>
        </table>
    </div>
</div>