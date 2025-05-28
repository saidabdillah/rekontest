<div>
    <flux:heading size="xl">Detail BKUBUD</flux:heading>
    <flux:separator class="my-5" />
    <table class="w-full">
        <thead>
            <tr>
                <th>No.</th>
                <th>Tanggal</th>
                <th>No Bukti</th>
                <th>Uraian</th>
                <th>Penerimaan</th>
                <th>Pengeluaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bkubud as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->tanggal }}</td>
                <td>{{ $item->no_bukti }}</td>
                <td>{{ $item->uraian }}</td>
                <td>{{ $item->penerimaan }}</td>
                <td>{{ $item->pengeluaran }}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4" class="text-center font-bold">Total</td>
                <td>
                    <div class="flex justify-between w-full">
                        <span class="text-left">Rp.</span>
                        <span class="text-right">{{ number_format( $totalPenerimaan , 3, ',', '.') ?? 0 }}</span>
                    </div>
                </td>
                <td>
                    <div class="flex justify-between w-full">
                        <span class="text-left">Rp.</span>
                        <span class="text-right">{{ number_format( $totalPengeluaran , 3, ',', '.') ?? 0 }}</span>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</div>