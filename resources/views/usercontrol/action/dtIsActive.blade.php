@if($data->is_activated == 1)
    <span class="badge bg-success" style="width: 75%;">
        ACTIVE
    </span>
@else
    <span class="badge bg-danger" style="width: 75%;">
        DEACTIVATED
    </span>
@endif