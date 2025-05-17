@extends('adminmodule::layouts.app')


@section('content')
<div class="container-fluid">
    <h4 class="mb-4">Dashboard</h4>

    {{-- Summary Cards --}}
   <div class="row">

    {{-- Total Tasks --}}
    <div class="col-md-3 stretch-card grid-margin">
        <div class="card bg-gradient-primary card-img-holder text-white">
            <div class="card-body">
                <img src="{{ asset('superadmin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">
                    Total Tasks <i class="mdi mdi-format-list-bulleted mdi-24px float-end"></i>
                </h4>
                <h2 class="mb-5">{{ $totalTasks }}</h2>
                <h6 class="card-text">All tasks assigned or created.</h6>
            </div>
        </div>
    </div>

    {{-- Submitted Tasks --}}
    <div class="col-md-3 stretch-card grid-margin">
        <div class="card bg-gradient-warning card-img-holder text-white">
            <div class="card-body">
                <img src="{{ asset('superadmin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">
                    Submitted Tasks <i class="mdi mdi-upload mdi-24px float-end"></i>
                </h4>
                <h2 class="mb-5">{{ $submittedTasks }}</h2>
                <h6 class="card-text">Pending approval or publishing.</h6>
            </div>
        </div>
    </div>

    {{-- Published Tasks --}}
    <div class="col-md-3 stretch-card grid-margin">
        <div class="card bg-gradient-success card-img-holder text-white">
            <div class="card-body">
                <img src="{{ asset('superadmin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">
                    Published Tasks <i class="mdi mdi-eye-check mdi-24px float-end"></i>
                </h4>
                <h2 class="mb-5">{{ $publishTasks }}</h2>
                <h6 class="card-text">Visible to the public.</h6>
            </div>
        </div>
    </div>

    {{-- Unpublished Tasks --}}
    <div class="col-md-3 stretch-card grid-margin">
        <div class="card bg-gradient-danger card-img-holder text-white">
            <div class="card-body">
                <img src="{{ asset('superadmin/assets/images/dashboard/circle.svg') }}" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">
                    Unpublished Tasks <i class="mdi mdi-eye-off mdi-24px float-end"></i>
                </h4>
                <h2 class="mb-5">{{ $unpublishTasks }}</h2>
                <h6 class="card-text">Hidden or yet to be published.</h6>
            </div>
        </div>
    </div>

</div>


    {{-- Recent Tasks Table --}}
    <div class="card mt-4">
        <div class="card-header">
            Recent Tasks
            <a href="{{ route('designer.tasks.create') }}" class="btn btn-sm btn-primary float-end">
                <i class="mdi mdi-plus-circle"></i> New Task
            </a>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentTasks as $task)
                    <tr>
                        <td>{{ $task->title }}</td>
                        <td>
                            @if($task->status == 1)
                                <span class="badge bg-warning">Submitted</span>
                            @elseif($task->status == 2)
                                <span class="badge bg-success">Approved</span>
                            @else
                                <span class="badge bg-danger">Rejected</span>
                            @endif
                        </td>
                        <td>{{ $task->created_at->diffForHumans() }}</td>
                        <td>
                            <a href="{{ route('designer.tasks.show', $task->id) }}" class="btn btn-sm btn-primary">
                                <i class="mdi mdi-eye"></i>
                            </a>
                            <a href="{{ route('designer.tasks.edit', $task->id) }}" class="btn btn-sm btn-info">
                                <i class="mdi mdi-pencil"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">No tasks found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
