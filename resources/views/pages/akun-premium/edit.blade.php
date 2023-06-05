@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-5 text-gray-800">Update Tabel Akun Premium Baru</h1>
        <form action="{{ url("akun-premium/update/$getPremium->id") }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')
            <input type="hidden" name="user_id" value="{{old('user_id',$getPremium->user_id)}}">
            <div class="mb-3">
                <label for="no_rek" class="form-label">No. Rekening</label>
                <input type="text" class="form-control" id="no_rek" name="no_rek" value="{{ old('no_rek', $getPremium->no_rek) }}" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_bayar" class="form-label">Tanggal Bayar</label>
                <input type="date" class="form-control" id="tanggal_bayar" name="tanggal_bayar" value="{{old('tanggal_bayar',$getPremium->tanggal_bayar)}}">
            </div>
            <div class="mb-3">
                <label for="expired_date" class="form-label">Expired Date</label>
                <input type="date" class="form-control" id="expired_date" name="expired_date" value="{{ old('expired_date', $getPremium->expired_date) }}">
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
