@extends('adminmodule::layouts.app')

@section('content')
<div class="card">
    <div class="card-header">
        <h4>Designer Details</h4>
    </div>
    <div class="card-body">
        <p><strong>Name:</strong> {{ $designer->name }}</p>
        <p><strong>Email:</strong> {{ $designer->email }}</p>
        <p><strong>Contact:</strong> {{ $designer->phone ?? 'N/A' }}</p>
        <p><strong>UID:</strong> {{ $designer->uid }}</p>
        <p><strong>Role:</strong> 
            @if($designer->role == 2)
                Designer
            @elseif($designer->role == 1)
                Admin
            @else
                Associate
            @endif
        </p>
        <a href="{{ route('admin.designer.list') }}" class="btn btn-primary">Back to List</a>
    </div>
</div>
@endsection
