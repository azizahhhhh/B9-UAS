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
                                <th>Nama</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($suppliers as $supplier)
                                    <tr>
                                        <td>{{ $supplier->name }}</td>
                                        <td>
                                            @if (count($supplier->KerjaSama) === 1)
                                                @if ($supplier->KerjaSama->first()->is_accepted == "Menunggu Persetujuan")
                                                    <p class="text-dark">Menunggu persetujuan</p>
                                                @elseif ($supplier->KerjaSama->first()->is_accepted == "Diterima")
                                                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal{{$supplier->kerjaSama->first()->id}}">
                                                        + Buat permintaan
                                                    </button>
                                                    <a href="{{ route("kerja-sama.riwayat.index", $supplier->KerjaSama->first()->id) }}">
                                                        <button class="btn btn-primary">Riwayat</button>
                                                    </a>
                                                    <div class="modal fade" id="exampleModal{{$supplier->kerjaSama->first()->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <form action="{{ route("kerja-sama.storePermintaan", $supplier->KerjaSama->first()->id) }}" method="POST">
                                                                @csrf
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Permintaan</h1>
                                                                        <button type="button" class="btn-close border border-0" data-bs-dismiss="modal" aria-label="Close">X</button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <input type="hidden" value="{{ $supplier->id }}" readonly>
                                                                        <div class="mb-3">
                                                                            <label>Nama barang baku</label>
                                                                            <select class="form-select form-control" aria-label="Default select example" name="barang_baku">
                                                                                @foreach ($bahan_bakus as $bahan_baku)
                                                                                <option value="{{ $bahan_baku->id }}">{{ $bahan_baku->BahanBaku->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        <div class="form-floating">
                                                                            <textarea class="form-control" placeholder="Masukkan permintaan" id="floatingTextarea" name="permintaan"></textarea>
                                                                            <label for="floatingTextarea">Permintaan</label>
                                                                        </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                        <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                                                        <button type="submit" class="btn btn-primary">Minta</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                @elseif($supplier->KerjaSama->first()->is_accepted =="Ditolak")
                                                    <p class="text-danger">Ditolak</p>
                                                @endif
                                            @else
                                                <form action="{{ route("kerja-sama.store") }}" method="POST" id="form-kerja-sama">
                                                    @csrf
                                                    <input type="hidden" name="supplier" value="{{ $supplier->id }}">
                                                    <button type="button" class="btn btn-info text-light" onclick="isAgree()">Ajak</button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endrole

                    @role("Supplier")
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tfoot>
                            <tbody>
                                @foreach ($owners as $owner)
                                    @if ($owner->is_accepted == "Diterima" || $owner->is_accepted == "Menunggu Persetujuan")
                                        <tr>
                                            <td>{{ $owner->PemilikUsaha->name }}</td>
                                            @if ($owner->is_accepted == "Menunggu Persetujuan")
                                                <td>
                                                    <form action="{{ route('kerja-sama.persetujuan.updateKerjaSama', $owner->id) }}" method="post">
                                                        @csrf
                                                        @method('PUT')
                                                        <button type="submit" name="persetujuan" value="Diterima" class="btn btn-success">Setuju</button>
                                                        <button type="submit" name="persetujuan" value="Ditolak" class="btn btn-danger">Tolak</button>
                                                    </form>
                                                </td>
                                            @elseif($owner->is_accepted == "Diterima")
                                                <td>
                                                    <a href="{{ route("kerja-sama.riwayat.index", $owner->id) }}">
                                                        <button class="btn btn-info">Permintaan</button>
                                                    </a>
                                                </td>
                                            @endif
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    @endrole
                </div>
            </div>
        </div>
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
    @elseif(session("success"))
        <script>
            Swal.fire("Sukses", `{{ session("success") }}`, "success");
        </script>
    @endif
    <script>
        function isAgree()
        {
            Swal.fire({
                title: 'Ajakan Kerja Sama',
                text: "Apakah anda yakin ingin bekerja sama?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: 'Tidak',
                }).then((result) => {
                if (result.isConfirmed) {
                    $('#form-kerja-sama').submit();
                }
            });
        }
    </script>
@endsection
