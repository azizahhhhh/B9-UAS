@extends('layouts.app')
@section('content')
<form action="{{ route('store-syarat-premium') }}" method="post">
    @csrf
    <div class="py-2">
        <p>Jobdesk</p>
        <input type="hidden" name="body" id="body" value="{{ old('body') }}" id="body">
        <trix-editor input="body" value="{{ old('body', $syarat) }}"></trix-editor>
    </div>
    <button>Submit</button>
</form>
@endsection