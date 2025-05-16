<table class="table table-bordered" id="township-table">
    <thead>
        <tr>
            <th>Name</th>
            <th>Location</th>
            <th>RERA No</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($townships as $township)
            <tr>
                <td>{{ $township->name }}</td>
                <td>{{ $township->location }}</td>
                <td>{{ $township->rera_no }}</td>
                <td>
                    <button class="btn btn-sm toggle-status-btn {{ $township->status ? 'btn-success' : 'btn-secondary' }}"
                            data-id="{{ $township->id }}">
                        {{ $township->status ? 'Active' : 'Inactive' }}
                    </button>
                </td>
                <td>
                    <a href="{{ route('admin.township.edit', $township->id) }}" class="btn btn-sm btn-warning"><i class="mdi mdi-pencil"></i></a>
                    <a href="{{ route('admin.township.show', $township->id) }}" class="btn btn-sm btn-info"><i class="mdi mdi-eye"></i></a>
                    <form action="{{ route('admin.township.destroy', $township->id) }}" method="POST" style="display:inline-block;">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this item?')"><i class="mdi mdi-delete"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
