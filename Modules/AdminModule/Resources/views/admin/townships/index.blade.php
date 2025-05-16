@extends('adminmodule::layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">

        <h2>Township Listings</h2>

        <a href="{{ route('admin.township.create') }}" class="btn btn-primary mb-3">Add New Township</a>
    </div>
    <div class="card-body">
        <div id="townshipTableWrapper">
            @include('adminmodule::admin.townships.list', ['townships' => $townships])
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<script>
    $(document).ready(function() {
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
        @if($errors -> any())
        @foreach($errors -> all() as $error)
        toastr.error("{{ $error }}");
        @endforeach
        @endif
    });
</script>
<script>
    $(document).ready(function() {
        // Initial bind
        bindStatusToggle();

        function bindStatusToggle() {
            $('.toggle-status-btn').off('click').on('click', function() {
                let button = $(this);
                let id = button.data('id');
                $.ajax({
                    url: '/admin/township/publish-status/' + id,
                    method: 'GET',
                    success: function(response) {
                        toastr.success('Status updated');
                        // Reload only the township table content
                        $.ajax({
                            url: "{{ route('admin.township.table.ajax') }}", // returns updated table view
                            type: 'GET',
                            success: function(html) {
                                $('#townshipTableWrapper').html(html);
                                // Rebind the events to new buttons
                                bindStatusToggle();
                            },
                            error: function() {
                                toastr.error('Error loading updated table.');
                            }
                        });
                    },
                    error: function() {
                        toastr.error('Something went wrong.');
                    }
                });
            });
        }
    });
</script>

<script>
    $(document).ready(function() {
        $('#township-table').DataTable({
            responsive: true,
            pageLength: 10,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search township..."
            }
        });
    });
</script>
@endpush