@extends('layouts.app')
@section('content')
<div>
    <form action="{{ route('update-syarat-premium') }}" method="post">
        @method('put')
        @csrf
        <div class="py-2">
            <p>Jobdesk</p>
            <input type="hidden" name="body" id="body" value="{{ old('body') }}" id="body">
            <trix-editor input="body"></trix-editor>
        </div>
        <button class="btn btn-primary">Submit</button>
    </form>

</div>

    @if(session("success"))
        <script>
            Swal.fire("Sukses", `{{ session("success") }}`, "success");
        </script>
    @endif
    <script>
        const syarat = @php echo json_encode($syarat); @endphp;
        document.addEventListener("trix-initialize", function(event) {
            const stored = syarat;
            event.target.editor.loadHTML(stored);
        });
    </script>
@endsection
