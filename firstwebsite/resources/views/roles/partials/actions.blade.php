<div class="btn-group" role="group">
    <a href="{{ route('roles.show', $row->id) }}" class="btn btn-sm btn-info">View</a>
    <a href="{{ route('roles.edit', $row->id) }}" class="btn btn-sm btn-warning">Edit</a>
    <form action="{{ route('roles.destroy', $row->id) }}" method="POST" style="display:inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
    </form>
</div>
