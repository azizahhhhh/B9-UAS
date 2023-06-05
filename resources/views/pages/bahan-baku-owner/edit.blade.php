@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-5 text-gray-800">Update Stok Bahan Baku</h1>

        <!-- DataTales Example -->
        <form action="{{ route("pemilik-bahan-baku.update", $pemilik_bahan_baku->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Nama Bahan Baku</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $pemilik_bahan_baku->BahanBaku->name }}">
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Kuantitas</label>
                <input type="text" class="form-control" id="quantity" name="quantity">
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
    {{-- <script>
        // Image Preview
        function previewImage() 
        {
            const image_input = document.querySelector("#image-input");
            const image_preview = document.querySelector("#image-preview");
            
            image_preview.style.display = "block";

            const oFReader = new FileReader();
            oFReader.readAsDataURL(image_input.files[0]);

            oFReader.onload = function(oFREvent) {
                image_preview.src = oFREvent.target.result;
            }
        }
    </script> --}}
@endsection