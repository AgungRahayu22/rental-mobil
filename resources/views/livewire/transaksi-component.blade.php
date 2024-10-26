<div class="container-fluid pt-4 px-4">
    <div class="row g-3"> <!-- Mengurangi jarak antar row -->
        <div class="col-sm-12 col-xl-12">
            <div class="bg-light rounded h-100 p-4">
                @if (session()->has('success'))
                    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger" role="alert">{{ session('error') }}</div>
                @endif

                <h4 class="mb-4 text-center" >DATA MOBIL</h4>
                <div class="row row-cols-1 row-cols-md-3 g-3"> <!-- Ganti layout row untuk membuat grid card -->
                    @foreach ($mobil as $data)
                        <div class="col">
                            <div class="card h-100 shadow-sm border-0" style="border-radius: 8px;">
                                <img src="{{ asset('storage/mobil/'.$data->foto) }}"
                                     class="card-img-top mx-auto mt-2"
                                     style="height: 200px; width: 200px; object-fit: cover; border-radius: 8px;"
                                     alt="{{ $data->merk }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $data->merk }}</h5>
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">No Polisi : {{ $data->nopolisi }}</li>
                                    <li class="list-group-item">Harga : {{ $data->harga }}</li>
                                    <li class="list-group-item">Kapasitas : {{ $data->kapasitas }}</li>
                                </ul>
                                <div class="card-footer text-center">
                                    <button wire:click="create({{ $data->id }}, {{ $data->harga }})"
                                            class="btn btn-sm btn-success">Pilih Mobil</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{ $mobil->links() }}
            </div>
        </div>
    </div>

    @if ($addPage == true)
        @include('transaksi.create')
    @endif
</div>
