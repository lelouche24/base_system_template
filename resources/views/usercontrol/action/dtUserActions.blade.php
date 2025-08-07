<div class="btn-group btn-group-sm">

    <a class="btn btn-sm border" href="javascript:void(0)"onclick='access_list(@json($data))' data-toggle="tooltip" data-placement="top" title="User Access">
        <i class="fas fa-paste"></i>
    </a>
    <a class="btn btn-sm border" href="javascript:void(0)" onclick='edit_form(@json($data))' data-toggle="tooltip" data-placement="top" title="Edit">
        <i class="fas fa-pencil-alt"></i>
    </a>
    <a class="btn btn-sm border" href="javascript:void(0)" onclick="delete_record('{{ $data->slug }}','{{route('admin.user.destroy','slug')}}')" data-toggle="tooltip" data-placement="top" title="Delete">
        <i class="fas fa-trash"></i>
    </a>

    <button type="button" class="btn btn-sm border dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="sr-only">Toggle Dropdown</span>
    </button>
    <div class="dropdown-menu" style="font-size: 12px !important;">
        <a class="dropdown-item" href="javascript:void(0)"  onclick="activate('{{ $data->slug }}', '{{ route('admin.user.activate', ['slug' => $data->slug, 'status' => $data->is_activated ? 1 : 0]) }}', {{ $data->is_activated ? 'true' : 'false' }})" >{{$data->is_activated ? 'Deactivate' : 'Activate'}}</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="javascript:void(0)" onclick="change_password('{{ $data->slug }}')" >Reset Password</a>
    </div>
</div>