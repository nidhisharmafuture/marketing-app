@extends('adminmodule::layouts.app')
@section('content')
<div class="container">
    <h2>Create Team</h2>

    <form action="{{ route('admin.team.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label>Team Name</label>
            <input type="text" name="name" class="form-control" required>
            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <button class="btn btn-success">Create</button>
                    <a href="{{ route('admin.team.list') }}" class="btn btn-primary">Back</a>

    </form>
</div>
@endsection


