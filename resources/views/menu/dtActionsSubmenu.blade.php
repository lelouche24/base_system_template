<a class="btn btn-sm border" href="javascript:void(0)"
   onclick='submenu_form(@json($data), "{{ route('admin.submenu.update', $data->slug) }}", null)'
   data-toggle="tooltip" data-placement="top" title="Edit">
    <i class="fas fa-pencil-alt"></i>
</a>
<a class="btn btn-sm border" href="javascript:void(0)" onclick="delete_record('{{ $data->slug }}','{{route('admin.submenu.destroy','slug')}}',true)" data-toggle="tooltip" data-placement="top" title="Delete">
    <i class="fas fa-trash"></i>
</a>
