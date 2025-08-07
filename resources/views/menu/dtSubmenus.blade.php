<ul class="pl-3 m-0">
    @forelse($data->submenu as $submenu)
        <li>{{ $submenu->name }}</li>
    @empty
        <li class="text-muted">No submenus available.</li>
    @endforelse
</ul>