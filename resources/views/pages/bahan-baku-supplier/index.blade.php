@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Bahan Baku Supplier</h1>
        {{-- @dd(config('app.url')) --}}
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Bahan Baku Supplier</h6>
            </div>
            @role("Supplier")
            <div class="card-header py-3">
                <a href="{{ route("supplier-bahan-baku.create") }}"><button class="btn btn-success">+ Tambah Data Bahan Baku</button></a>
            </div>
            @endrole
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Gambar</th>
                            <th>Harga</th>
                            <th>Kuantiti</th>
                            <th>Deskripsi</th>
                            <th>Status</th>
                            @role("Supplier")
                                <th>Aksi</th>
                            @endrole
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($bahan_bakus as $bahan_baku)
                                <tr>
                                    <td>{{ $bahan_baku->BahanBaku->name }}</td>
                                    <td>
                                        <img src="{{ $bahan_baku->getFirstMediaUrl('gambar-bahan-baku') }}" width="100px">
                                    </td>
                                    <td>@currency($bahan_baku->price)</td>
                                    <td>{{ $bahan_baku->quantity }}</td>
                                    <td>{{ $bahan_baku->description }}</td>
                                    @if ($bahan_baku->available == '1')
                                        <td>Tersedia</td>
                                    @else
                                        <td>Tidak tersedia</td>
                                    @endif
                                    @role("Supplier")
                                    <td>
                                        <div class="d-flex">
                                            <a href="{{ route("supplier-bahan-baku.edit", $bahan_baku->id) }}">
                                                <button class="btn btn-warning mr-2">Edit</button>
                                            </a>
                                            <form method="POST" action="{{ route("supplier-bahan-baku.destroy", $bahan_baku->id) }}">
                                                @csrf
                                                @method("DELETE")
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        </div>
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
