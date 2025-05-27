<div>
    <div class="my-5 flex gap-x-2 items-center w-[200px]">
        <flux:input wire:model="tanggal_akhir" type="date" />
        <flux:button wire:click="cariTanggal">Cari Tanggal Transaksi</flux:button>
    </div>
    <div class="gap-x-3 grid xl:grid-cols-2 2xl:grid-cols-3 w-full">
        <div>
            <h4 class="text-center font-bold uppercase mb-3 h-10 flex justify-center items-center border">Pendapatan
                Silpa
            </h4>
            <table class="w-full">
                <tr>
                    <td>1L. Pendapatan</td>
                    <td class="text-right">Rp.{{ $CHP_1_L }}</td>
                </tr>
                <tr>
                    <td>2L. Belanja Dan Transfer</td>
                    <td class="text-right">Rp.{{ $CHP_2_L }}</td>
                </tr>
                <tr>
                    <th class="text-left">3L. Selisih</th>
                    <th class="text-right">Rp.{{ $CHP_3_L }}</th>
                </tr>
            </table>
            <table class="w-full mt-3">
                <tr>
                    <td>4L. Pemby Penerimaan</td>
                    <td class="text-right">Rp.{{ $CHP_4_L }}</td>
                </tr>
                <tr>
                    <td>5L. Pemby Pengeluaran</td>
                    <td class="text-right">Rp.{{ $CHP_5_L }}</td>
                </tr>
                <tr>
                    <th class="text-left">6L. Selisih Pembiayaan</th>
                    <th class="text-right">Rp.{{ $CHP_6_L }}</th>
                </tr>
            </table>
            <table class="w-full mt-3">
                <tr>
                    <th class="text-left">7L. Silpa</th>
                    <th class="text-right">Rp.{{ $CHP_7_L }}</th>
                </tr>
            </table>
            <h4 class="text-center font-bold uppercase h-10 flex justify-center items-center border mt-3">Keterangan
            </h4>
            <table class="w-full mt-3">
                <tr>
                    <th colspan="2" class="uppercase">Rincian Silpa</th>
                </tr>
                <tr>
                    <td>1S. Giro Kas Daerah</td>
                    <td class="text-right">Rp.{{ $CHP_1_S }}</td>
                </tr>
                <tr>
                    <td>2S. Deposito Kas Daerah</td>
                    <td class="text-right">Rp.{{ $CHP_2_S }}</td>
                </tr>
                <tr>
                    <td>3S. JKN</td>
                    <td class="text-right">Rp.{{ $CHP_3_S }}</td>
                </tr>
                <tr>
                    <td>4S. BLUD</td>
                    <td class="text-right">Rp.{{ $CHP_4_S }}</td>
                </tr>
                <tr>
                    <td>5S. Penerimaan</td>
                    <td class="text-right">Rp.{{ $CHP_5_S }}</td>
                </tr>
                <tr>
                    <td>6S. Pengeluaran</td>
                    <td class="text-right">Rp.{{ $CHP_6_S }}</td>
                </tr>
                <tr>
                    <td>7S. BOS</td>
                    <td class="text-right">Rp.{{ $CHP_7_S }}</td>
                </tr>
                <tr>
                    <td>8S. BOP</td>
                    <td class="text-right">Rp.{{ $CHP_8_S }}</td>
                </tr>
                <tr>
                    <td>9S. BOK</td>
                    <td class="text-right">Rp.{{ $CHP_9_S }}</td>
                </tr>
                <tr>
                    <th class="text-left">10S. Total (1 s/d 9)</th>
                    <td class="text-right">Rp.{{ $CHP_10_S }}</td>
                </tr>
            </table>
            <table class="w-full mt-3">
                <tr>
                    <td>11.S Selisih (Silpa - 10)</td>
                    <td class="text-right">Rp.{{ $CHP_11_S }}</td>
                </tr>
                <tr>
                    <td>12.S Kurang Bayar</td>
                    <td class="text-right">Rp.{{ $CHP_12_S }}</td>
                </tr>
                <tr>
                    <td>13.S SP2D Belum Cair</td>
                    <td class="text-right">Rp.{{ $CHP_13_S }}</td>
                </tr>
                <tr>
                    <td>14.S Penerimaan Belum Entry</td>
                    <td class="text-right">Rp.{{ $CHP_14_S }}</td>
                </tr>
                <tr>
                    <td>15.S Pengembalian sisa UP/TU</td>
                    <td class="text-right">Rp.{{ $CHP_15_S }}</td>
                </tr>
                <tr>
                    <td>16.S Koreksi Mutasi</td>
                    <td class="text-right">Rp.{{ $CHP_16_S }}</td>
                </tr>
                <tr>
                    <th class="text-left">17.S Selisih (11 s/d 16)</th>
                    <th class="text-right">Rp.{{ $CHP_17_S }}</th>
                </tr>
            </table>

        </div>
        <div>
            <h4 class="text-center font-bold uppercase mb-3 h-10 flex justify-center items-center border">Pendapatan
            </h4>
            <table class="w-full">
                <tr>
                    <th class="text-left">1P. Mutasi Kredit</th>
                    <th class="text-right">Rp.{{ $CHP_1_P }}</th>
                </tr>
                <tr>
                    <td>2P. Kas Bend Pene Belum Setor</td>
                    <td class="text-right">Rp.{{ $CHP_2_P }}</td>
                </tr>
                <tr>
                    <td>3P. Kelebihan Entry</td>
                    <td class="text-right">Rp.{{ $CHP_3_P }}</td>
                </tr>
                <tr>
                    <th class="text-left">4P. Penambahan (2 + 3)</th>
                    <th class="text-right">Rp.{{ $CHP_4_P }}</th>
                </tr>
            </table>

            <table class="w-full mt-3">
                <tr>
                    <td>
                        5P. Belum Entry
                    </td>
                    <td class="text-right">Rp.{{ $CHP_5_P }}</td>
                </tr>
                <tr>
                    <td>6P. Koreksi Mutasi</td>
                    <td class="text-right">Rp.{{ $CHP_6_P }}
                    </td>
                </tr>
                <tr>
                    <td>7P. Kormut Tahun Lalu</td>
                    <td class="text-right">Rp.{{ $CHP_7_P }}</td>
                </tr>
                <tr>
                    <td>8P. Deposito</td>
                    <td class="text-right">Rp.{{ $CHP_8_P }}</td>
                </tr>
                <tr>
                    <td>9P. Pengembalian UP Tahun Lalu</td>
                    <td class="text-right">.{{ $CHP_9_P }}</td>
                </tr>
                <tr>
                    <td>10P. Pengembalian UP/TU Tahun Ini</td>
                    <td class="text-right">Rp.{{ $CHP_10_P }}</td>
                </tr>
                <tr>
                    <td>11P. Pengembalian Belanja</td>
                    <td class="text-right">Rp.{{ $CHP_11_P }}</td>
                </tr>
                <tr>
                    <td>12P. Pembiayaan</td>
                    <td class="text-right">Rp.{{ $CHP_12_P }}</td>
                </tr>
                <tr>
                    <td>13P. Setoran BOS</td>
                    <td class="text-right">Rp.{{ $CHP_13_P }}</td>
                </tr>
                <tr>
                    <th class="text-left">14P. Pengurang (5P s/d 13P)</th>
                    <th class="text-right">Rp.{{ $CHP_14_P }}</th>
                </tr>
            </table>

            <table class="w-full mt-3">
                <tr>
                    <td>15P. Pendpatan (1 + 4 - 14)</td>
                    <td class="text-right">Rp.{{ $CHP_15_P }}</td>
                </tr>
                <tr>
                    <td>16P. Pendapatan JKN</td>
                    <td class="text-right">Rp.{{ $CHP_16_P }}
                    </td>
                </tr>
                <tr>
                    <td>17P. Pendapatan BLUD</td>
                    <td class="text-right">Rp.{{ $CHP_17_P }}</td>
                </tr>
                <tr>
                    <td>18P. Pendapatan BOS</td>
                    <td class="text-right">Rp.{{ $CHP_18_P }}</td>
                </tr>
                <tr>
                    <td>19P. Pendapatan Dana Desa</td>
                    <td class="text-right">Rp.{{ $CHP_19_P }}</td>
                </tr>
                <tr>
                    <td>20P. Pendapatan Dana BOK</td>
                    <td class="text-right">Rp.{{ $CHP_20_P }}</td>
                </tr>
                <tr>
                    <td>21P. Pendapatan Dana BOP</td>
                    <td class="text-right">Rp.{{ $CHP_21_P }}</td>
                </tr>
                <tr>
                    <th class="text-left">22P. Total Pendapatan (15P s/d 21P)</th>
                    <th class="text-right">Rp.{{ $CHP_22_P }}</th>
                </tr>
            </table>

            <table class="w-full mt-3">
                <tr>
                    <td>23P. LRA (1L)</td>
                    <td class="text-right">Rp.{{ $CHP_23_P }}</td>
                </tr>
            </table>

            <table class="w-full mt-3">
                <tr>
                    <th class="text-left">24P. Selisih (22 - 23)</th>
                    <th class="text-right">Rp.{{ $CHP_24_P }}</th>
                </tr>
            </table>

            <h4 class="text-center font-bold uppercase h-10 flex justify-center items-center border mt-3">Keterangan
            </h4>
        </div>
        <div>
            <h4 class="text-center font-bold uppercase mb-3 h-10 flex justify-center items-center border">Belanja</h4>
            <table class="w-full">
                <tr>
                    <th class="text-left">1B. Mutasi Debit</th>
                    <th class="text-right">Rp.{{ $CHP_1_B }}</th>
                </tr>
                <tr>
                    <td>2B. SP2D Belum Cair</td>
                    <td class="text-right">Rp.{{$CHP_2_B }}</td>
                </tr>
                <tr>
                    <td>3B. Belum bayar</td>
                    <td class="text-right">Rp.{{$CHP_3_B }}</td>
                </tr>
                <tr>
                    <th class="text-left">4B. Penambahan (2 + 3)</th>
                    <th class="text-right">Rp.{{ $CHP_4_B }}</th>
                </tr>
            </table>

            <table class="w-full mt-3">
                <tr>
                    <td>5B. Deposito</td>
                    <td class="text-right">Rp.{{ $CHP_5_B }}</td>
                </tr>
                <tr>
                    <td>6B. Pengembalian Belanja</td>
                    <td class="text-right">Rp.{{ $CHP_6_B }}</td>
                </tr>
                <tr>
                    <td>7B. UP dan TU</td>
                    <td class="text-right">Rp.{{ $CHP_7_B }}</td>
                </tr>
                <tr>
                    <td>8B. Koreksi Mutasi</td>
                    <td class="text-right">Rp.{{ $CHP_8_B }}</td>
                </tr>
                <tr>
                    <td>9B. Belum Entry</td>
                    <td class="text-right">Rp.{{ $CHP_9_B }}</td>
                </tr>
                <tr>
                    <td>10B. Pembiayaan</td>
                    <td class="text-right">Rp.{{ $CHP_10_B }}</td>
                </tr>
                <tr>
                    <td>11B. Pengembalian Sisa UP/TU</td>
                    <td class="text-right">Rp.{{ $CHP_11_B }}</td>
                </tr>
                <tr>
                    <th class="text-left">12B. Pengurang (5B s/d 11B)</th>
                    <th class="text-right">Rp.{{ $CHP_12_B }}</th>
                </tr>
            </table>

            <table class="w-full mt-3">
                <tr>
                    <th class="text-left">13B. Belanja</th>
                    <th class="text-right">Rp.{{ $CHP_13_B }}</th>
                </tr>
                <tr>
                    <td>14B. Belanja JKN</td>
                    <td class="text-right">Rp.{{ $CHP_14_B }}</td>
                </tr>
                <tr>
                    <td>15B. Belanja BLUD</td>
                    <td class="text-right">Rp.{{ $CHP_15_B }}</td>
                </tr>
                <tr>
                    <td>16B. Belanja BOS</td>
                    <td class="text-right">Rp.{{ $CHP_16_B }}</td>
                </tr>
                <tr>
                    <td>17B. Belanja Dana Desa</td>
                    <td class="text-right">Rp.{{ $CHP_17_B }}</td>
                </tr>
                <tr>
                    <td>18B. Belanja Dana BOK</td>
                    <td class="text-right">Rp.{{ $CHP_18_B }}</td>
                </tr>
                <tr>
                    <td>19B. Belanja Dana BOP</td>
                    <td class="text-right">Rp.{{ $CHP_19_B }}</td>
                </tr>
                <tr>
                    <th class="text-left">20B. Total Belanja</th>
                    <th class="text-right">Rp.{{ $CHP_20_B }}</th>
                </tr>
            </table>

            <table class="w-full mt-3">
                <tr>
                    <td>21B. LRA (2L)</td>
                    <td class="text-right">Rp.{{ $CHP_21_B }}</td>
                </tr>
            </table>

            <table class="w-full mt-3">
                <tr>
                    <th class="text-left">22B. Selisih</th>
                    <th class="text-right">Rp.{{ $CHP_22_B }}</th>
                </tr>
            </table>

            <h4 class="text-center font-bold uppercase h-10 flex justify-center items-center border mt-3">Keterangan
            </h4>
        </div>
    </div>
</div>