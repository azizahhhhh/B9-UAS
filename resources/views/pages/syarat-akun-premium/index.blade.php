@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <h1 class="text-primary font-weight-bold">Syarat dan Ketentuan Akun Premium</h1>
        {!! $syarat->body !!}
        <div class="row mt-4">
            @if (Auth::user()->is_premium)
            <button type="submit" class="btn btn-secondary mx-2">Akun Sudah Premium</button>
            @else
            <form action="{{ route('syarat-akun-premium.store') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-success mx-2">Kirim request</button>
            </form>
            @endif
            <a target="_blank" href="https://api.whatsapp.com/send?phone=+1234567890"><button class="btn btn-warning">Hubungi Admin</button></a>
        </div>
    </div>
    @if(session("success"))
        <script>
            Swal.fire("Sukses", `{{ session("success") }}`, "success");
        </script>
    @endif

@endsection
