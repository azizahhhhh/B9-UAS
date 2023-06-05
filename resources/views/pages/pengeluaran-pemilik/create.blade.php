@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-5 text-gray-800">Tambah Pengeluaran</h1>

        <!-- DataTales Example -->
        <form action="{{ route("pemilik-pengeluaran.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="date" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="date" name="date">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Nama Bahan Baku</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="kebutuhan" class="form-label">Kebutuhan</label>
                <input type="number" class="form-control" id="kebutuhan" name="kebutuhan">
            </div>
            <div class="mb-3">
                <label for="pengeluaran" class="form-label">Pengeluaran</label>
                <input type="number" class="form-control" id="pengeluaran" name="pengeluaran">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
    <!-- /.container-fluid -->
    @if (session("error"))
        <script>
            Swal.fire("Gagal", `{{ session("error") }}`, "error");
        </script>
    @elseif($errors->any())
        <script>
            Swal.fire("Gagal", `@foreach ($errors->all() as $error)
                {{ $error }}
            @endforeach`, "error");
        </script>
    @endif
@endsection