@extends('adminmodule::layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Township Details</h2>

    <div class="card">
        <div class="card-body">
            <h4>{{ $township->name }}</h4>
            <p><strong>Location:</strong> {{ $township->location }}</p>
            <p><strong>RERA No:</strong> {{ $township->rera_no }}</p>
            <p><strong>Status:</strong> 
                <span class="badge {{ $township->status ? 'bg-success' : 'bg-secondary' }}">
                    {{ $township->status ? 'Active' : 'Inactive' }}
                </span>
            </p>
            <a href="{{ route('admin.township.list') }}" class="btn btn-secondary">Back to list</a>
        </div>
    </div>
</div>
@endsection

