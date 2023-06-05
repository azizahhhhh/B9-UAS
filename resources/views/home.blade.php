@extends('layouts.app')

@section('custom_styles')

@endsection

@section('content')
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @if (auth()->user()->is_premium)
                        <p class="card-text">
                            {{ __('You are logged in as premium user!') }}
                        </p>
                        <p>Premium account will expire on date: {{ $expired_date->format('d/m/Y') }}</p>
                        @else
                        <p class="card-text">
                            {{ __('You are logged in!') }}
                        </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
            <!-- /.row -->

    </div>
    <!-- /.container-fluid -->
@endsection
