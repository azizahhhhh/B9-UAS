@extends('layouts.app')

@section('content')
    <!-- Page Heading -->

    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Supplier</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$getSuppliers}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Owner</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{$getOwners}}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <h1 class="h3 mb-2 text-gray-800">Tabel Data User</h1>
    <p class="mb-4">Di bawah ini adalah tabel untuk melihat semua user yang terdaftar</p>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>NIK</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($getUsers as $info)
                            <tr>
                                <td>{{$info->name}}</td>
                                <td>{{$info->email}}</td>
                                <td>
                                    {{$info->roles->implode('name', ', ')}}
                                </td>
                                <td>{{$info->clientData ? $info->clientData->nik : ''}}</td>
                                <td>{{$info->clientData ? $info->clientData->phone : ''}}</td>
                                <td>{{$info->clientData ? $info->clientData->address : ''}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @section('custom_scripts')
    <script src="{{ asset('js/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{ asset('js/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts -->
        <script src="{{asset('js/demo/datatables-demo.js')}}"></script>
    @endsection
@endsection
