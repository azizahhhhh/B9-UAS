@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Kalkulator Produksi</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Lakukan perhitungan bahan baku untuk membuat eskrim</h6>
            </div>

            <div class="card-body">
                <form action="{{ route('perkalian') }}" method="GET" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="bahan_baku" class="form-label">Bahan Baku : kelapa(buah) / santan(liter)</label>
                        <input type="number" class="form-control" id="bahan_baku" name="bahan_baku">
                    </div>
                    @isset($hasil)
                    <div class="mb-3">
                        <label for="total_eskrim" class="form-label">Es Krim Yang Dihasilkan : pcs</label>
                        <input type="number" class="form-control" id="total_eskrim" name="total_eskrim" value="{{$hasil}}" disabled>
                    </div>
                    @endisset
                    @isset($bahan_baku, $hasil)
                        <div class="alert alert-success" role="alert">
                            <p>Bahan baku yang akan dipakai {{$bahan_baku}} buah/liter, yang dihasilkan adalah {{$hasil}} pcs es krim</p>
                        </div>
                    @endisset
                    <input type="hidden" class="form-control" id="jumlah_eskrim" name="jumlah_eskrim" value="20">
                    <button type="submit" class="btn btn-primary" value="Calculate">Hitung</button>
                </form>
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

@section('custom_scripts')
<script>
    function calculateSum() {
        var num1 = document.getElementById('bahan_baku').value;
        var num2 = document.getElementById('jumlah_eskrim').value;
        var sum = num1 * num2;
        document.getElementById('result').value = sum;
    }
</script>
@endsection
