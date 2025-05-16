@extends('adminmodule::layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h4>Media List</h4>
        <a href="{{ route('admin.media.create') }}" class="btn btn-primary">Add Media</a>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-bordered" id="media-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    {{-- <th>Admin ID</th> --}}
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($media as $index => $m)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $m->title }}</td>
                        {{-- <td>{{ $category->admin }}</td> --}}
                        <td>
                            <a href="{{ route('admin.media.show', $m->id) }}" class="btn btn-info btn-sm"><i class="mdi mdi-eye"></i></a>
                            <a href="{{ route('admin.media.edit', $m->id) }}" class="btn btn-warning btn-sm"><i class="mdi mdi-pencil"></i></a>
                            <form action="{{ route('admin.media.destroy', $m->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Delete this media?')" class="btn btn-danger btn-sm"><i class="mdi mdi-delete"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection


@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<script>
    $(document).ready(function () {
        @if(session('success'))
            toastr.success("{{ session('success') }}");
        @endif

        @if(session('error'))
            toastr.error("{{ session('error') }}");
        @endif

        @if(session('warning'))
            toastr.warning("{{ session('warning') }}");
        @endif

        @if(session('info'))
            toastr.info("{{ session('info') }}");
        @endif

        @if($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    });
</script>
<script>
    $(document).ready(function () {
        $('#media-table').DataTable({
            responsive: true,
            pageLength: 10,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search media..."
            }
        });
    });
</script>
@endpush