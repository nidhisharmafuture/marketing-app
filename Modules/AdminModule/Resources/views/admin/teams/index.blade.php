@extends('adminmodule::layouts.app')
@section('content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
            <h2>Teams</h2>

    <a href="{{ route('admin.team.create') }}" class="btn btn-primary mb-3">Add New Team</a>

    </div>
    <div class="card-body">

    <div id="teamTableWrapper">
        <table class="table table-bordered" id="team-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($teams as $team)
                    <tr>
                        <td>{{ $team->name }}</td>
                        <td>
                            <button class="btn btn-sm {{ $team->status ? 'btn-success' : 'btn-secondary' }}" 
                                onclick="toggleStatus({{ $team->id }}, this)">
                                {{ $team->status ? 'Active' : 'Inactive' }}
                            </button>
                        </td>
                        <td>
                                                        <a href="{{ route('admin.team.show', $team->id) }}" class="btn btn-info btn-sm"><i class="mdi mdi-eye"></i></a>

                            <a href="{{ route('admin.team.edit', $team->id) }}" class="btn btn-warning btn-sm"><i class="mdi mdi-pencil"></i></a>
                            <form action="{{ route('admin.team.destroy', $team->id) }}" method="POST" style="display:inline">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Delete this team?')"><i class="mdi mdi-delete"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
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
function toggleStatus(id, button) {
    $.ajax({
        url: '/admin/team/publish-status/' + id,
        method: 'GET',
        success: function(response) {
            toastr.success('Status updated');
            if (response.status) {
                $(button).removeClass('btn-secondary').addClass('btn-success').text('Active');
            } else {
                $(button).removeClass('btn-success').addClass('btn-secondary').text('Inactive');
            }
        },
        error: function() {
            toastr.error('Error updating status');
        }
    });
}
</script>

<script>
    $(document).ready(function() {
        $('#team-table').DataTable({
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