<div class="btn-group btn-group-sm">
    <a class="btn btn-sm border" href="javascript:void(0)" onclick='submenu_list(@json($data))' data-toggle="tooltip" data-placement="top" title="Sub Menu">
        <i class="fas fa-paste"></i>
    </a>
    <a class="btn btn-sm border" href="javascript:void(0)" onclick='edit_form(@json($data))' data-toggle="tooltip" data-placement="top" title="Edit">
        <i class="fas fa-pencil-alt"></i>
    </a>
    <a class="btn btn-sm border" href="javascript:void(0)" onclick="delete_record('{{ $data->slug }}','{{route('admin.menu.destroy','slug')}}',false)" data-toggle="tooltip" data-placement="top" title="Delete">
        <i class="fas fa-trash"></i>
    </a>
</div>