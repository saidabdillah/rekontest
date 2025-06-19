<div class="relative">
    <flux:heading size="xl">Saldo</flux:heading>
    <flux:separator class="my-5" />

    <flux:modal.trigger name="tambah-saldo">
        <flux:button variant="primary">Edit Saldo</flux:button>
    </flux:modal.trigger>

    <flux:modal name="tambah-saldo" class="w-full">
        <form wire:submit="editSaldo" class="space-y-6">
            <div>
                <flux:heading size="lg">Edit Saldo</flux:heading>
            </div>

            <flux:field>
                <flux:label>Giro</flux:label>

                <flux:input wire:model="giro" />

                <flux:error name="giro" />
            </flux:field>

            <flux:field>
                <flux:label>Deposito</flux:label>

                <flux:input wire:model="deposito" />

                <flux:error name="deposito" />
            </flux:field>

            <flux:field>
                <flux:label>JKN</flux:label>

                <flux:input wire:model="jkn" />

                <flux:error name="jkn" />
            </flux:field>

            <flux:field>
                <flux:label>BOK</flux:label>

                <flux:input wire:model="bok" />

                <flux:error name="bok" />
            </flux:field>

            <flux:field>
                <flux:label>BOP</flux:label>

                <flux:input wire:model="bop" />

                <flux:error name="bop" />
            </flux:field>

            <flux:field>
                <flux:label>BLUD</flux:label>

                <flux:input wire:model="blud" />

                <flux:error name="blud" />
            </flux:field>

            <flux:field>
                <flux:label>BOS</flux:label>

                <flux:input wire:model="bos" />

                <flux:error name="bos" />
            </flux:field>

            <flux:field>
                <flux:label>Penerimaan</flux:label>

                <flux:input wire:model="penerimaan" />

                <flux:error name="penerimaan" />
            </flux:field>

            <flux:field>
                <flux:label>Pengeluaran</flux:label>

                <flux:input wire:model="pengeluaran" />

                <flux:error name="pengeluaran" />
            </flux:field>

            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" variant="primary">Simpan</flux:button>
            </div>
        </form>
    </flux:modal>

    <div class="overflow-x-auto">
        <table class="w-full mt-5">
            <thead>
                <tr>
                    <th>Giro</th>
                    <th>Deposito</th>
                    <th>JKN</th>
                    <th>BOK</th>
                    <th>BOP</th>
                    <th>BLUD</th>
                    <th>BOS</th>
                    <th>Penerimaan</th>
                    <th>Pengeluaran</th>
                </tr>
            </thead>
            <tbody>
                {{-- @if($saldo) --}}
                <tr>
                    <td>{{ $saldo->giro }}</td>
                    <td>{{ $saldo->deposito }}</td>
                    <td>{{ $saldo->jkn }}</td>
                    <td>{{ $saldo->bok }}</td>
                    <td>{{ $saldo->bop }}</td>
                    <td>{{ $saldo->blud }}</td>
                    <td>{{ $saldo->bos }}</td>
                    <td>{{ $saldo->penerimaan }}</td>
                    <td>{{ $saldo->pengeluaran }}</td>
                </tr>
                {{-- @else
                <tr>
                    <td colspan="9" class="text-center">Belum ada saldo</td>
                </tr>
                @endif --}}
            </tbody>
        </table>
    </div>
</div>