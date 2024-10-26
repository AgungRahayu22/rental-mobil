<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                @endif

                <h4 class="mb-4 text-center">DATA LAPORAN TRANSAKSI</h4>

                <div class="row mb-4">
                    <div class="col-md-4">
                        <input type="date" wire:model="tanggal1" class="form-control" placeholder="Tanggal Awal">
                    </div>
                    <div class="col-md-1 d-flex align-items-center justify-content-center">
                        <span>s/d</span>
                    </div>
                    <div class="col-md-4">
                        <input type="date" wire:model="tanggal2" class="form-control" placeholder="Tanggal Akhir">
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-sm btn-primary" wire:click="cari">Filter</button>
                    </div>
                </div>

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">No Polisi</th>
                            <th scope="col">Nama Pemesan</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">Lama</th>
                            <th scope="col">Tanggal Pesan</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transaksi as $data)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $data->mobil->nopolisi ?? 'N/A' }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->alamat }}</td>
                                <td>{{ $data->lama }}</td>
                                <td>{{ $data->tgl_pesan }}</td>
                                <td>@rupiah($data->total)</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Data Laporan Belum ada!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="d-flex justify-content-between align-items-center">
                    {{ $transaksi->links() }}
                    <button class="btn btn-primary" wire:click="exportpdf">Export PDF</button>
                </div>
            </div>
        </div>
    </div>
</div>
