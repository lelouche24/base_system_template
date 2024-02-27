@push('scripts')
<script>
$(document).ready(function(){
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
        });

var usermanagementTable = $('#usermanagementTable').DataTable({
    processing: true,
    serverSide: true,
    ordering: false,
    pageLength: 20,
    lengthChange: false,
    ajax: "{{ url('admin/usercontrol') }}",
    columns: [
        { data:'username', name:"username"},
        { data:'fullname', name:"fullname"},
        { data:'department', name:"department"},
        { data:'position', name:"position"},
        { data:'user_type', name:"user_type"},
        { data:'status', name:"status"},
        { data:'action', name:"action", searchable: false, orderable: false},
        { data: null, name: null, render: function(data, type, row, meta) {
            // You can customize the content of the last column here
            return ''; // This will render an empty string in the last column
        }},
    ],
    columnDefs: [
        {targets: [5,6], className: 'text-center' },
        {targets: [2,3,4,7], searchable: false, orderable: false},
        {targets: [5], render: function (data, type, row, meta) { if (data == 1) { return `<span class="badge bg-success">Active</span>` } else { return `<span class="badge bg-secondary">Inactive</span>` } } },
        {targets: [4], render: function (data, type, row, meta) { if (data == 'superadmin') { return `<span class="badge bg-primary">Superadmin</span>` } if (data == 'admin') { return `<span class="badge bg-success">Admin</span>` } else { return `<span class="badge bg-secondary">User</span>` } } }
    ],
});

$('#add_edit_userBtn').on('click', function(){
    $('#add_edit_userModal').modal().find('.modal-title').text('ADD USER');
    $('#add_edit_userModal').modal('show');
    $('#error-message-container').prop('hidden', true);
    usermanagementTable.draw();
    $('#admin_id').val('asdasd');
});

$('#add_edit_userModalForm').submit(function(e){
    e.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        type: 'POST',
        url: "{{ url('admin/adduserinfo') }}",
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            console.log(data);

            // Check if the response has a message
            if (data.message) {
                // Display success message
                var Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });

                Toast.fire({
                    icon: 'success',
                    title: 'User Added!'
                });

                // Close the modal and reset the form
                $('#add_edit_userModal').modal('hide');
                $('#add_edit_userModalForm').trigger('reset');

                // Refresh the DataTable (assuming you're using DataTables)
                usermanagementTable.draw();
            }
        },
        error: function(xhr) {
            console.log(xhr);

            // Check if the response has validation errors
            if (xhr.responseJSON && xhr.responseJSON.errors) {
                // Display validation errors
                var errors = xhr.responseJSON.errors;

                // Assuming the server returns an error for the 'admin_username' field
                if (errors.admin_username) {
                    $('#error-message-container').prop('hidden', false);
                } else {
                    // Clear the error container if no specific error for 'admin_username'
                    $('#error-message-container').prop('hidden', true);
                }
            }
        }
    });
});

$('#edit_userModalForm').submit(function(e){
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type:'POST',
        url:"{{ url('admin/updateuserinfo') }}",
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success: (data)=>{
            console.log(data);
            $('#edit_userModal').modal('hide');
            $('#edit_userModalForm').trigger('reset');

            var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
            });

            Toast.fire({
                icon: 'success',
                title: 'Updated!'
            })
            usermanagementTable.draw();
        },
        error: function(data){
            console.log(data);
        }
    });
});

$('#userStatusModalForm').submit(function(e){
    e.preventDefault();
    var formData = new FormData(this);
    $.ajax({
        type:'POST',
        url:"{{ url('admin/edituserStatusinfo') }}",
        data:formData,
        cache:false,
        contentType: false,
        processData: false,
        success: (data)=>{
            console.log(data);
            $('#userStatusModal').modal('hide');
            $('#userStatusModalForm').trigger('reset');

            var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
            });

            Toast.fire({
                icon: 'success',
                title: 'Status Updated!'
            })
            usermanagementTable.draw();
        },
        error: function(data){
            console.log(data);
        }
    });
});

});

// Start of Function Code

function deleteUserFunc(id){
        var id = id;
        Swal.fire({
        title: 'Do you want to save the changes?',
        showDenyButton: true,
        confirmButtonText: 'Yes',
        denyButtonText: 'No',
        }).then((result) => {
        if (result.isConfirmed) {

            $.ajax({
                type: 'POST',
                url: "{{ url('admin/deleteuserinfo') }}",
                data: {
                    id: id,
                    _token: "{{ csrf_token() }}"
                },
                dataType: 'json',
                success: function (res) {
                    $('#usermanagementTable').DataTable().draw();
                }
            });

            Swal.fire('Record Deleted!', '', 'warning')
        } else if (result.isDenied) {
            Swal.fire('Record not Deleted', '', 'info')
        }
        });
}

function editUserFunc(id) {
    $.ajax({
        type: 'POST',
        url: "{{ url('admin/edituserinfo') }}",
        data: { id: id },
        dataType: 'json',
        success: function (res) {
            console.log(res);
            $('#edit_userModal').modal('show');
            $('#edit_userModal').modal().find('.modal-title').text('EDIT USER');
            $('#error-message-container').prop('hidden', true);
            $('#admin_edit_id').val(res.id);
            $('#admin_edit_username').val(res.username);
            $('#admin_edit_firstname').val(res.firstname);
            $('#admin_edit_middlename').val(res.middlename);
            $('#admin_edit_lastname').val(res.lastname);
            $('#admin_edit_usertype').val(res.user_type);
            $('#admin_edit_department').val(res.department);
            $('#admin_edit_position').val(res.position);
        }
    });
}

function statusUserFunc(id){
    $.ajax({
            type:'POST',
            url:"{{ url('admin/edituserinfo') }}",
            data: {id:id},
            dataType: 'json',
            success: function(res){
            console.log(res);
            $('#userStatusModal').modal('show');
            $('#userStatusModal').modal().find('.modal-title').text('USER STATUS/ROLE');
            $('#admin_statusID').val(res.id);
            $('#admin_status').val(res.status);
            $('#admin_roles').val(res.user_roles);
            }
        });
}
</script>
@endpush
