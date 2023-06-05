@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Kerja Sama</h1>

        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Kerja Sama</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    @role("Pemilik Usaha")
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            
                            <thead>
                            <tr>
                                <th>Nama Mitra</th>
                                <th>Nama Barang</th>
                                <th>Deskripsi</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($requests_owner as $request)
                                <tr>
                                    @role("Pemilik Usaha")
                                        <td>{{ $request->KerjaSama->Supplier->name }}</td>
                                    @endrole
                                    <td>{{ $request->SupplierBahanBaku->BahanBaku->name }}</td>
                                    <td>{{ $request->request }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endrole
                    @role("Supplier")
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            
                            <thead>
                            <tr>
                                <th>Nama Mitra</th>
                                <th>Nama Barang</th>
                                <th>Deskripsi</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($requests_supplier as $request)
                                <tr>
                                    @role("Supplier")
                                        <td>{{ $request->KerjaSama->PemilikUsaha->name }}</td>
                                    @endrole
                                    <td>{{ $request->SupplierBahanBaku->BahanBaku->name }}</td>
                                    <td>{{ $request->request }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if (! Auth::user()->is_premium && count($requests_owner) > 3)
                        <div class="alert-info">

                            <h3 class="text-danger text-center">Ada permintaan baru!</h3>
                            <p class="text-center">Harap upgrade ke premium agar dapat melihat permintaan!</p>
                        </div>
                        <a href="{{ url('syarat-akun-premium') }}"><button class="btn btn-success">Pindah ke akun premium</button></a>
                        @endif
                    @endrole
                </div>
            </div>
        </div>
    </div>
@endsection
