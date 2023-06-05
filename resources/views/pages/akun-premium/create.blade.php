@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-5 text-gray-800">Tambah Akun Premium Baru</h1>

        <!-- DataTales Example -->
        <form action="{{ route("store-akun-premium") }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="form-control" id="tanggal_bayar" name="user_id" value=1 readonly>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nama" name="nama">
            </div>
            <div class="mb-3">
                <label for="no_rek" class="form-label">No. Rekening</label>
                <input type="text" class="form-control" id="no_rek" name="no_rek">
            </div>
            <div class="mb-3">
                <label for="tanggal_bayar" class="form-label">Tanggal Bayar</label>
                <input type="date" class="form-control" id="tanggal_bayar" name="tanggal_bayar">
            </div>
            <div class="mb-3">
                <label for="expired_date" class="form-label">Expired Date</label>
                <input type="text" class="form-control" id="expired_date" name="expired_date" value="{{\Carbon\Carbon::now()->addDays(90)->format('d/m/y')}}" readonly>
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
