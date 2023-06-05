@extends('layouts.app')

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">
        {{-- {{ dd($getExpiredAkun) }} --}}
        <div class="card shadow mb-4 p-4">
            <h1 class="h-3 mb-2 text-gray-800">Syarat dan Ketentuan Akun Premium</h1>
            <div class="p-4">
                {!! $getSyarat !!}
            </div>
            <a href="{{ route('edit-syarat-premium') }}"><button class="btn btn-success">Edit syarat</button></a>
        </div>
        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Akun Premium</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Akun Premium</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Nama</th>
                            <th>No. Rekening</th>
                            <th>Tanggal Bayar</th>
                            <th>Expired Date</th>
                            <th>Status</th>
                            @role("Admin")
                                <th>Aksi</th>
                            @endrole
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($getAkunPremium as $info)
                                <tr>
                                    <td>{{ $info->user->name }}</td>

                                    @if (! $info->no_rek)
                                        <td>Harap masukkan no. rekening pengguna</td>
                                    @else
                                    <td>{{ $info->no_rek}}</td>
                                    @endif

                                    @if (! $info->tanggal_bayar)
                                        <td>Harap masukkan tanggal pembayaran</td>
                                    @else
                                    <td>{{ $info->tanggal_bayar->format('d/m/Y')}}</td>
                                    @endif
                                    @if (! $info->expired_date)
                                        <td>Harap masukkan tanggal expired</td>
                                    @else
                                    <td>{{ $info->expired_date->format('d/m/Y')}}</td>
                                    @endif
                                    <td class="text-center">
                                        @if ( now() > $info->expired_date)
                                            <span class="text-danger">
                                                Non Active <br>
                                            </span>
                                        @else
                                            <span class="text-success">
                                                Active <br>
                                            </span>
                                        @endif
                                    </td>
                                    @role("Admin")
                                        <td class="d-flex">
                                            <form action="{{ route("edit-akun-premium", $info->id) }}" method="POST">
                                                @csrf
                                                <button class="btn btn-warning mr-2">Edit</button>
                                            </form>
                                            <form method="POST" action="{{ route("delete-akun-premium", $info->id) }}">
                                                @csrf
                                                @method("DELETE")
                                                <button type="submit" class="btn btn-danger ">Hapus</button>
                                            </form>
                                        </td>
                                    @endrole
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <h1 class="h3 mb-2 text-gray-800">List Pendaftar Akun Premium</h1>
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tabel Pendaftar Akun Premium</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Nama</th>
                            <th>Status</th>
                            @role("Admin")
                                <th>Aksi</th>
                            @endrole
                        </tr>
                        </thead>
                        <tbody>
                            @foreach ($getWaitingAkun as $info)
                            @if (! $info->status)
                                <tr>
                                    <td>{{ $info->user->name }}</td>

                                    <td>Menunggu persetujuan</td>
                                    @role("Admin")
                                        <td class="d-flex">
                                            <form action="{{ route("acc-akun-premium") }}" method="POST">
                                                @method('patch')
                                                @csrf
                                                <input type="text" value="{{ $info->user->id }}" name="id" id="id" class="d-none">
                                                <button class="btn btn-warning mr-2">Setujui</button>
                                            </form>
                                            <form method="POST" action="{{ route("reject-akun-premium", $info->id) }}">
                                                @csrf
                                                @method("DELETE")
                                                <button type="submit" class="btn btn-danger ">Tolak</button>
                                            </form>
                                        </td>
                                    @endrole
                                </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2 {{$getExpiredAkun > 0 ? 'bg-gradient-warning' : 'bg-white'}}
                ">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Akun Kadaluwarsa</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$getExpiredAkun}} Akun</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard fa-2x text-gray-300"></i>
                        </div>
                    </div>
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

    @if(session("failed"))
        <script>
            Swal.fire("Ditolak", `{{ session("failed") }}`, "failed");
        </script>
    @endif

    <script>
        // TRIX EDITOR
    document.addEventListener('trix-file-accept', function(e){
        e.preventDefault()
    });
    </script>
@endsection
