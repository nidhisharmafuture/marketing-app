@extends('adminmodule::layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Edit Township</h2>

    <form action="{{ route('admin.township.update', $township->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Name</label>
            <input type="text" name="name" value="{{ $township->name }}" class="form-control" required>
        </div>

         <div class="form-group">
            <label>District</label>
            <input type="text" name="district" value="{{ $township->district }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Location</label>
            <input type="text" name="location" value="{{ $township->location }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Project Type</label>
            <input type="text" name="project_type" value="{{ $township->project_type }}" class="form-control" required>
        </div>

        <div class="form-group">
            <label>RERA No (optional)</label>
            <input type="text" name="rera_no" value="{{ $township->rera_no }}" class="form-control">
        </div>

        <button class="btn btn-success mt-3">Update Township</button>
                            <a href="{{ route('admin.township.list') }}" class="btn btn-primary">Back</a>

    </form>
</div>
@endsection

