<td>
    <a href="{{ route('shifts.edit', $row->id) }}" class="btn btn-sm btn-secondary m-1">Edit</a>
    @if (Auth::user()->user_type == 'O' || Auth::user()->user_type == 'EO' && Auth::user()->group_id == 1 ||
    Auth::user()->group_id == 2 )
    <form action="{{ route('shifts.destroy', $row->id) }}" method="POST" style="display: inline-block;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-sm btn-danger m-1"
            onclick="return confirm('Are you sure?')">Delete</button>
    </form>
    @endif
    @if (Auth::user()->user_type == 'SM' && Auth::user()->group_id == 3)
    @if ($row->status)
    <form action="{{ route('shifts.approve', $row->id) }}" method="POST" style="display: inline-block;">
        @csrf
        @method('PUT')
        <button type="submit" class="btn btn-sm btn-success m-1" hidden="hidden"
            onclick="return confirm('Are you sure?')">Approve</button>
    </form>
    @else
    <form action="{{ route('shifts.approve', $row->id) }}" method="POST" style="display: inline-block;">
        @csrf
        @method('PUT')
        <button type="submit" class="btn btn-sm btn-success m-1"
            onclick="return confirm('Are you sure?')">Approve</button>
    </form>
    @endif
    @endif

</td>