@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-5 text-gray-800">Tambah Pemasukan</h1>

        <!-- DataTales Example -->
        <form action="{{ url('supplier-pemasukan/'.$supplier_pemasukan->id) }}" method="POST" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="mb-3">
                <label for="date" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ old('date', $supplier_pemasukan->date) }}">
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Nama Bahan Baku</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $supplier_pemasukan->BahanBaku->name) }}">
            </div>
            <div class="mb-3">
                <label for="selling" class="form-label">Penjualan/kelapa</label>
                <input type="number" class="form-control" id="selling" name="selling" value="{{ old('selling', $supplier_pemasukan->selling) }}">
            </div>
            <div class="mb-3">
                <label for="income" class="form-label">Pemasukan</label>
                <input type="number" class="form-control" id="income" name="income" value="{{ old('income', $supplier_pemasukan->income) }}">
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