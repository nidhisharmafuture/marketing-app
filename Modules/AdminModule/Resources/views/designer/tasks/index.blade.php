@extends('adminmodule::layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between">
  <h4 class="mb-4">My Tasks</h4>
  <a href="{{ route('designer.tasks.create') }}" class="btn btn-primary mb-3">Add New Task</a>
      </div>


  @if(session('success'))
    <script>toastr.success("{{ session('success') }}");</script>
  @endif
  <div class="card-body">
        <div id="townshipTableWrapper">
  <table class="table table-bordered" id="task-table">
    <thead>
      <tr>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Publish Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($tasks as $task)
      <tr>
        <td>{{ $task->title }}</td>
        <td>{{ $task->category->title ?? '-' }}</td>
        <td>
          @if($task->status == 1)
            <span class="badge bg-warning">Submitted</span>
          @elseif($task->status == 2)
            <span class="badge bg-success">Approved</span>
          @elseif($task->status == 3)
            <span class="badge bg-danger">Rejected</span>
          @endif
        </td>
        <td>
          <button class="btn btn-sm toggle-publish-status {{ $task->publish_status ? 'btn-success' : 'btn-secondary' }}"
                  data-id="{{ $task->id }}">
            {{ $task->publish_status ? 'Published' : 'Unpublished' }}
          </button>
        </td>
        <td>
          <a href="{{ route('designer.tasks.show', $task->id) }}" class="btn btn-primary btn-sm"><i class="mdi mdi-eye"></i></a>

          <a href="{{ route('designer.tasks.edit', $task->id) }}" class="btn btn-info btn-sm"><i class="mdi mdi-pencil"></i></a>
          <form action="{{ route('designer.tasks.destroy', $task->id) }}" method="POST" class="d-inline delete-form">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger btn-sm delete-btn"><i class="mdi mdi-delete"></i></button>
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
  // Delete confirmation
  $(document).ready(function () {
    $('.delete-btn').on('click', function (e) {
      e.preventDefault();
      let form = $(this).closest('form');

      Swal.fire({
        title: 'Are you sure?',
        text: "This task will be permanently deleted.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          form.submit();
        }
      });
    });
  });

  // Publish status toggle confirmation
  $('.toggle-publish-status').on('click', function() {
      let btn = $(this);
      let taskId = btn.data('id');
      let actionText = btn.hasClass('btn-success') ? 'Unpublish' : 'Publish';
      
      Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to " + actionText + " this task?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Yes, ' + actionText + ' it!'
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: '/designer/tasks/' + taskId + '/status',
            method: 'POST',
            data: { _token: '{{ csrf_token() }}' },
            success: function(response) {
              toastr.success(response.message);
              // Toggle button appearance
              btn.toggleClass('btn-success btn-secondary');
              btn.text(btn.hasClass('btn-success') ? 'Published' : 'Unpublished');
            },
            error: function() {
              toastr.error('An error occurred while updating status.');
            }
          });
        }
      });
  });
</script>

<script>
    $(document).ready(function() {
        $('#task-table').DataTable({
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
