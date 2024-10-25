<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Transaksi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
        body {
            background-color: #ffffff;
            padding: 40px 0;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #343a40;
        }
        .table-container {
            max-width: 1000px;
            margin: 0 auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
        }
        .table thead th {
            background-color: #343a40;
            color: #fff;
            text-align: center;
            padding: 15px;
        }
        .table tbody td {
            text-align: center;
            padding: 12px;
            vertical-align: middle;
        }
        .table tbody tr:hover {
            background-color: #f1f3f5;
        }
        .table td, .table th {
            border: 1px solid #dee2e6;
        }
    </style>
</head>
<body>

    <div class="container table-container">
        <h1>Laporan Transaksi</h1>
        <table class="table table-bordered">
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
                        <td>{{ $data->mobil->nopolisi }}</td>
                        <td>{{ $data->nama }}</td>
                        <td>{{ $data->alamat }}</td>
                        <td>{{ $data->lama }}</td>
                        <td>{{ $data->tgl_pesan }}</td>
                        <td>{{ $data->total }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Data Laporan Belum Ada!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>
</html>
