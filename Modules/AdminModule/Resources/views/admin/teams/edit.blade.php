@extends('adminmodule::layouts.app')

@section('content')
<div class="container">
    <h2>Edit Team</h2>

    <form action="{{ route('admin.team.update', $team->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="form-group">
            <label>Team Name</label>
            <input type="text" name="name" class="form-control" value="{{ $team->name }}" required>
            @error('name') <div class="text-danger">{{ $message }}</div> @enderror
        </div>
        <button class="btn btn-primary">Update</button>
    <a href="{{ route('admin.team.list') }}" class="btn btn-secondary">Back</a>

    </form>
</div>
@endsection


