@extends('adminmodule::layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
            <h2>Associate Listing</h2>
  
    </div>
      @if(session('success'))
        <script>toastr.success("{{ session('success') }}")</script>
    @endif
    <div class="card-body">
    <table class="table table-bordered" id="associate-table">
        <thead>
            <tr>
                <th>#ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($associates as $associate)
            <tr>
                <td>{{ $associate->id }}</td>
                <td>{{ $associate->name }}</td>
                <td>{{ $associate->email }}</td>
                <td>{{ $associate->phone }}</td>
                <td>
                    <button class="btn status-toggle {{ $associate->status ? 'btn-success' : 'btn-secondary' }}" 
                        data-id="{{ $associate->id }}">
                        {{ $associate->status ? 'Active' : 'Inactive' }}
                    </button>
                </td>
                <td>
                    <a href="{{ route('admin.associate.edit', $associate->id) }}" class="btn btn-warning btn-sm"><i class="mdi mdi-pencil"></i></a>
                    <a href="{{ route('admin.associate.show', $associate->id) }}" class="btn btn-info btn-sm"><i class="mdi mdi-eye"></i></a>
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
        $('#associate-table').DataTable({
            responsive: true,
            pageLength: 10,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search categories..."
            }
        });
    });
</script>
<script>
$('.status-toggle').click(function () {
    let id = $(this).data('id');
    let button = $(this);

    // Detect current status based on button class
    let isActive = button.hasClass('btn-success');
    let confirmText = isActive 
        ? 'Are you sure you want to deactivate this associate?' 
        : 'Are you sure you want to activate this associate?';

    if (!confirm(confirmText)) return;

    $.ajax({
        url: `/admin/associate/status-update/${id}`,
        method: 'GET',
        success: function (res) {
            if (res.status == 1) {
                button.removeClass('btn-secondary').addClass('btn-success').text('Active');
                toastr.success('Associate activated');
            } else {
                button.removeClass('btn-success').addClass('btn-secondary').text('Inactive');
                toastr.info('Associate deactivated');
            }
        },
        error: function () {
            toastr.error('Something went wrong.');
        }
    });
});


</script>
@endpush
