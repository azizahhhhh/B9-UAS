@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-5 text-gray-800">Tambah Bahan Baku</h1>

        <!-- DataTales Example -->
        <form action="{{ route("supplier-bahan-baku.store") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama Bahan Baku</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Gambar</label>
                <img id="image-preview" width="300px" class="mb-2">
                <input class="form-control" type="file" id="image-input" name="image" onchange="previewImage()">
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Harga</label>
                <input type="number" class="form-control" id="price" name="price">
            </div>
            <div class="mb-3">
                <label for="quantity" class="form-label">Kuantiti</label>
                <input type="number" class="form-control" id="quantity" name="quantity">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Deskripsi</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description"></textarea>
            </div>
            <div class="mb-3">
            <label for="available" class="form-label">Status Bahan Baku</label>
            <select class="form-control" aria-label="Default select example" name="available">
                <option value="1">Tersedia</option>
                <option value="0">Tidak Tersedia</option>
            </select>
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
    <script>
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
    </script>
@endsection