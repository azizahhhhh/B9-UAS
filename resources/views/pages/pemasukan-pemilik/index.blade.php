@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Pemasukan Pemilik Usaha</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Pemasukan Pemilik Usaha</h6>
            </div>
            @role("Pemilik Usaha")
            <div class="card-header py-3">
                <a href="{{ route("pemilik-pemasukan.create") }}"><button class="btn btn-success">+ Tambah Data Pemasukan</button></a>
            </div>
            @endrole
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Penjualan/cup</th>
                            <th>Pemasukan</th>
                            @role("Pemilik Usaha")
                                <th>Aksi</th>
                            @endrole
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($pemilik_pemasukans as $pemilik_pemasukan)
                                <tr>
                                    <td>{{ $pemilik_pemasukan->date }}</td></td>
                                    <td>{{ $pemilik_pemasukan->selling }}</td>
                                    <td>@currency($pemilik_pemasukan->income)</td>
                                    @role("Pemilik Usaha")
                                        <td class="d-flex">
                                            <a href="{{ route("pemilik-pemasukan.edit", $pemilik_pemasukan->id) }}">
                                                <button class="btn btn-warning">Edit</button>
                                            </a>
                                            {{-- <form method="POST" action="{{ route("supplier-pemasukan.destroy", $supplier_pemasukan->id) }}">
                                                @csrf
                                                @method("DELETE")
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form> --}}
                                        </td>
                                    @endrole
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->
    @if(session("success"))
        <script>
            Swal.fire("Sukses", `{{ session("success") }}`, "success");
        </script>
    @endif

@endsection
