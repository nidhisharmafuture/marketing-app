@extends('adminmodule::layouts.app')

@section('content')
<div class="container">
    <h2>Edit Designer</h2>
    <form method="POST" action="{{ route('admin.designer.update', $designer->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" value="{{ $designer->name }}" class="form-control" required />
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" value="{{ $designer->email }}" class="form-control" required />
        </div>

        <div class="mb-3">
            <label>Contact</label>
            <input type="text" name="contact" value="{{ $designer->phone }}" class="form-control" />
        </div>

        <div class="mb-3">
            <label>New Password (leave blank to keep current)</label>
            <input type="password" name="password" class="form-control" />
        </div>

        <div class="mb-3">
            <label>Confirm New Password</label>
            <input type="password" name="password_confirmation" class="form-control" />
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
                                    <a href="{{ route('admin.designer.list') }}" class="btn btn-secondary">Back</a>

    </form>
</div>
@endsection
