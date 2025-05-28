<div>
    <flux:heading size="xl">Rekap BKUBUD</flux:heading>
    <flux:separator class="my-5" />

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Penerimaan</th>
                <th>Pengeluaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($kalender as $index => $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item['tanggal'] . '-' . $item['bulan'] . '-'. $item['tahun'] }}</td>
                <td>Rp.{{ DB::table('bkubud')
                    ->selectRaw('IFNULL(SUM(penerimaan), 0) AS penerimaan')
                    ->where('tanggal', $item['tahun'] . '-' . $item['bulan'] . '-' . $item['tanggal'])
                    ->get()[0]->penerimaan }}
                </td>
                <td>Rp.{{ DB::table('bkubud')
                    ->selectRaw('IFNULL(SUM(pengeluaran), 0) AS pengeluaran')
                    ->where('tanggal', $item['tahun'] . '-' . $item['bulan'] . '-' . $item['tanggal'])
                    ->get()[0]->pengeluaran }}
                </td>
                <td>
                    <flux:button
                        href="{{ route('bkubud.detail', ['tanggal' => $item['tahun'] . '-' . $item['bulan'] . '-' . $item['tanggal']]) }}">
                        Detail BKUBUD
                    </flux:button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>