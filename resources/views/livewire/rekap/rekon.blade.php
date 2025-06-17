<div class="p-4">
    <div class="flex flex-col sm:flex-row justify-between items-center mb-4 gap-2">
        <button wire:click="previousMonth"
            class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition w-full sm:w-auto dark:bg-gray-700 dark:hover:bg-gray-600">
            Bulan Sebelumnya
        </button>

        <h2 class="text-lg font-semibold text-center w-full sm:w-auto dark:text-white">
            {{ \Carbon\Carbon::create($currentYear, $currentMonth, 1)->locale('id')->translatedFormat('F Y') }}
        </h2>

        <button wire:click="nextMonth"
            class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400 transition w-full sm:w-auto dark:bg-gray-700 dark:hover:bg-gray-600">
            Bulan Berikutnya
        </button>
    </div>

    <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-7 gap-2">
        @foreach ($kalender as $hari)
        @php
        $dataList = $rekonData[$hari['tanggal_penuh']] ?? collect([]);
        $totalPenerimaan = $dataList->sum('penerimaan');
        $totalPengeluaran = $dataList->sum('pengeluaran');
        @endphp

        <div wire:click="showDetail('{{ $hari['tanggal_penuh'] }}')"
            class="border rounded-lg p-2 text-center cursor-pointer hover:bg-blue-100 
                       {{ $detailTanggal == $hari['tanggal_penuh'] ? 'bg-blue-200' : '' }} transition dark:border-gray-600 dark:hover:bg-gray-700">
            <div class="font-bold text-lg dark:text-white">{{ $hari['tanggal'] }}</div>

            @if ($dataList->count() > 0)
            <div class="text-xs text-green-600 font-semibold mt-1 dark:text-green-400">
                Total Penerimaan = {{ Number::currency($totalPenerimaan, 'IDR', 'id') }}
            </div>
            <div class="text-xs text-red-600 font-semibold dark:text-red-400">
                Total Pengeluaran = {{ Number::currency($totalPengeluaran, 'IDR', 'id') }}
            </div>
            @else
            <div class="text-xs text-gray-400 mt-2 dark:text-gray-500">Tidak ada data</div>
            @endif
        </div>
        @endforeach
    </div>

    {{-- Detail Data Tanggal --}}
    @if ($detailTanggal)
    <div class="mt-6 p-4 border bg-gray-50 rounded shadow dark:bg-gray-700 dark:border-gray-600">
        <h3 class="font-semibold text-center mb-3 dark:text-white">Detail Rekon untuk tanggal: {{ $detailTanggal }}</h3>
        <div class="overflow-x-auto">
            <table class="w-full text-sm table-auto border-collapse">
                <thead class="bg-gray-200 dark:bg-gray-600">
                    <tr>
                        <th class="p-2 border dark:border-gray-600 dark:text-white">ID Rekon</th>
                        <th class="p-2 border dark:border-gray-600 dark:text-white">Tanggal</th>
                        <th class="p-2 border dark:border-gray-600 dark:text-white">Kode Transaksi</th>
                        <th class="p-2 border dark:border-gray-600 dark:text-white">Uraian</th>
                        <th class="p-2 border dark:border-gray-600 dark:text-white">Penerimaan</th>
                        <th class="p-2 border dark:border-gray-600 dark:text-white">Pengeluaran</th>
                    </tr>
                </thead>
                <tbody class="dark:bg-gray-800">
                    @forelse ($detailData as $data)
                    <tr class="text-center dark:text-white">
                        <td class="p-2 border dark:border-gray-600">{{ $data->id_rekon }}</td>
                        <td class="p-2 border dark:border-gray-600">{{ $data->tanggal }}</td>
                        <td class="p-2 border dark:border-gray-600">{{ $data->kode_transaksi }}</td>
                        <td class="p-2 border dark:border-gray-600">{{ $data->uraian }}</td>
                        <td class="p-2 border text-green-600 dark:border-gray-600 dark:text-green-400">
                            {{ Number::currency($data->penerimaan, 'IDR', 'id') }}
                        </td>
                        <td class="p-2 border text-red-600 dark:border-gray-600 dark:text-red-400">
                            {{ Number::currency($data->pengeluaran, 'IDR', 'id') }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-gray-500 p-4 dark:text-gray-400">
                            Tidak ada data untuk tanggal ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @endif
</div>