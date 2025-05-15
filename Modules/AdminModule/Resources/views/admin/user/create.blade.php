@extends('adminmodule::layouts.app')

@section('content')
<div class="container">
    <h2>Create Designer</h2>
    <form method="POST" action="{{ route('admin.designer.store') }}">
        @csrf

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" required />
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required />
        </div>

        <div class="mb-3">
            <label>Contact</label>
            <input type="text" name="contact" class="form-control" />
        </div>

        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required />
        </div>

        <div class="mb-3">
            <label>Confirm Password</label>
            <input type="password" name="password_confirmation" class="form-control" required />
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
