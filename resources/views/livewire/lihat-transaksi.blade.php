<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
               @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                @endif

                <h4 class="mb-4 text-center">DATA TRANSAKSI</h4>

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">No Polisi</th>
                            <th scope="col">Merk</th>
                            <th scope="col">Nama Pemesan</th>
                            <th scope="col">Ponsel</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Tanggal Pesan</th>
                            <th scope="col">Total</th>
                            <th scope="col">Lama</th>
                            <th scope="col">Status</th>
                            <th scope="col">Proses</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transaksi as $data)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $data->mobil->nopolisi ?? 'N/A' }}</td>
                                <td>{{ $data->mobil->merk ?? 'N/A' }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->ponsel }}</td>
                                <td>{{ $data->alamat }}</td>
                                <td>{{ $data->tgl_pesan }}</td>
                                <td>{{ $data->total }}</td>
                                <td>{{ $data->lama }}</td>
                                <td>{{ $data->status }}</td>
                                <td>
                                    @if ($data->status == "WAIT")
                                        <button class="btn btn-sm btn-success" wire:click="proses({{ $data->id }})">PROSES</button>
                                    @elseif ($data->status == "PROSES")
                                        <button class="btn btn-sm btn-success" wire:click="selesai({{ $data->id }})">SELESAI</button>
                                    @elseif ($data->status == "SELESAI")
                                        <button class="btn btn-sm btn-danger" wire:click="hapus({{ $data->id }})">HAPUS</button>
                                    @endif
                                </td>

                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="text-center">Data Transaksi Belum ada!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $transaksi->links() }}
            </div>
        </div>
    </div>
</div>
