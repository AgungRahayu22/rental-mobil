<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                @endif

                <h4 class="mb-4 text-center">DATA MOBIL</h4>

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">No Polisi</th>
                            <th scope="col">Merk</th>
                            <th scope="col">Jenis</th>
                            <th scope="col">Harga</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Proses</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mobil as $data)
                            <tr>
                                <th scope="row">{{ $loop->iteration }}</th>
                                <td>{{ $data->nopolisi }}</td>
                                <td>{{ $data->merk }}</td>
                                <td>{{ $data->jenis }}</td>
                                <td>@rupiah($data->harga)</td>
                                <td>
                                    @if(!empty($data->foto) && file_exists(public_path('storage/mobil/'.$data->foto)))
                                        <img src="{{ asset('storage/mobil/'.$data->foto) }}" style="width: 150px" alt="{{ $data->merk }}">
                                    @else
                                        <span>Foto tidak tersedia</span>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-info" wire:click="edit({{ $data->id }})">Edit</button>
                                    <button class="btn btn-danger" wire:click="destroy({{ $data->id }})">Delete</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Data Mobil Belum ada!</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{ $mobil->links() }}

                <div class="text-end">
                    <button wire:click="create()" class="btn btn-primary">Tambah</button>
                </div>
            </div>
        </div>
    </div>

    @if ($addPage)
        @include('mobil.create')
    @endif

    @if ($editPage)
        @include('mobil.edit')
    @endif
</div>
