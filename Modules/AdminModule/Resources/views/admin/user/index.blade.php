@extends('adminmodule::layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="mb-0">Designer Listing</h2>
        <a href="{{route('admin.designer.create')}}" class="btn btn-primary">Add Designer</a>
    </div>

    <div class="table-responsive">
        <table id="designer-table" class="table table-striped">
    <thead>
        <tr>
            <th>Name</th>
            <th>Contact</th>
            <th>Email</th>
                        <th>Status</th>

            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($designers as $designer)
        <tr>
            <td>{{ $designer->name }}</td>
            <td>{{ $designer->phone ?? 'N/A' }}</td>
            <td>{{ $designer->email }}</td>
            <td>
                    <button class="btn status-toggle {{ $designer->status ? 'btn-success' : 'btn-secondary' }}" 
                        data-id="{{ $designer->id }}">
                        {{ $designer->status ? 'Active' : 'Inactive' }}
                    </button>
                </td>
            <td>
                <a href="{{ route('admin.designer.edit', $designer->id) }}" class="btn btn-sm btn-warning">
                    <i class="mdi mdi-pencil"></i>
                </a>
                <a href="{{ route('admin.designer.show', $designer->id) }}" class="btn btn-sm btn-info">
                    <i class="mdi mdi-eye"></i>
                </a>
                <form action="{{ route('admin.designer.destroy', $designer->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                        <i class="mdi mdi-delete"></i>
                    </button>
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
$('.status-toggle').click(function () {
    let id = $(this).data('id');
    let button = $(this);

    // Detect current status based on button class
    let isActive = button.hasClass('btn-success');
    let confirmText = isActive 
        ? 'Are you sure you want to deactivate this designer?' 
        : 'Are you sure you want to activate this designer?';

    if (!confirm(confirmText)) return;

    $.ajax({
        url: `/admin/designer/status-update/${id}`,
        method: 'GET',
        success: function (res) {
            if (res.status == 1) {
                button.removeClass('btn-secondary').addClass('btn-success').text('Active');
                toastr.success('Designer activated');
            } else {
                button.removeClass('btn-success').addClass('btn-secondary').text('Inactive');
                toastr.info('Designer deactivated');
            }
        },
        error: function () {
            toastr.error('Something went wrong.');
        }
    });
});


</script>
<script>
    $(document).ready(function () {
        $('#designer-table').DataTable({
            responsive: true,
            pageLength: 10,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search designers..."
            }
        });
    });
</script>
@endpush

