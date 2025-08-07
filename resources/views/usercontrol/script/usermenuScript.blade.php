@push('scripts')
<script>
$(document).ready(function(){
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
        });

// -------------------------

let active = '';

userTbl = $("#TBL_USER").DataTable({
    processing: true,
    serverSide: true,
    searching: false,
    lengthChange: false,
    ajax : "{{route('admin.user.index')}}",
    columns: [
        { data: 'username', orderable: false},
        { data: 'fullname', orderable: false},
        { data: 'is_activated', orde: false},
        { data: 'last_activity'},
        { data: 'action', orderable: false},
    ],
    // language: {
    //     processing: tableLoader()
    // },
    columnDefs:[
        {
        targets: ['_all'],
        createdCell: function (td, cellData, rowData, row, col) {
                $(td).addClass('text-center align-middle');

            }
        },
    ],
    order:[[3, 'desc']],
    responsive: false,initComplete: function( settings, json ) {
        $('#'+settings.sTableId+'_filter input').unbind();
        $('#'+settings.sTableId+'_filter input').bind('keyup', function (e) {
            if (e.keyCode == 13) {
                userTbl.search(this.value).draw();
            }
        });
    },
    drawCallback: function(settings){
        if(active != ''){
            $("#"+settings.sTableId+" #"+active).addClass('table-success');
        }
    }
});


// -------------------------
// Add User Button

const createForm = @json(view('usercontrol.modal.create')->render());

$('#btn_add').on('click', function() {
    Swal.fire({
        title: 'User Form',
        html: createForm,
        width: '600px',
        customClass: {
            title: 'swal-title-sm',
            actions: 'swal-actions-right',
            confirmButton: 'btn-sm',
            cancelButton: 'btn-sm',
            popup: 'p-3'
        },
        showCancelButton: true,
        confirmButtonText: 'Save',
        confirmButtonColor: '#007bffeb',
        focusConfirm: false,
        preConfirm: () => {
            const lname = $('#lname').val().trim();
            const fname = $('#fname').val().trim();
            const minitial = $('#minitial').val().trim();
            const username = $('#username').val().trim();
            const password = $('#password').val().trim();
            const password_confirmation = $('#password_confirmation').val().trim();

            if (!lname || !fname || !username || !password || !password_confirmation) {
                Swal.showValidationMessage('Please fill in all required fields.');
                return false;
            }

            if (password !== password_confirmation) {
                Swal.showValidationMessage('Passwords do not match.');
                return false;
            }

            return {
                lname: lname,
                fname: fname,
                minitial: minitial,
                username: username,
                password: password,
                password_confirmation: password_confirmation
            };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const data = result.value;

            $.ajax({
                url: "{{ route('admin.user.store') }}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: data,
                success: function(res) {
                    if (res == 1) {
                        toastr.success('Record created successfully.');
                        setTimeout(function() {
                            $('#TBL_USER').DataTable().draw(false);
                        }, 500);
                    }
                },
                error: function(res) {
                    let msg = res.responseJSON?.message || 'Submission failed.';
                    Swal.fire('Error', msg, 'error');
                }
            });
        }
    });
});


});



// -------------------------
// Edit User Button

function edit_form(data) {

    const editForm = @json(view('usercontrol.modal.edit')->render());

    Swal.fire({
        title: 'Edit Form',
        html: editForm,
        width: '600px',
        customClass: {
            title: 'swal-title-sm',
            actions: 'swal-actions-right',
            confirmButton: 'btn-sm',
            cancelButton: 'btn-sm',
            popup: 'p-3'
        },
        showCancelButton: true,
        confirmButtonText: 'Update',
        confirmButtonColor: '#007bffeb',
        focusConfirm: false,
        didOpen: () => {
            document.getElementById('lname').value = data.lname;
            document.getElementById('fname').value = data.fname;
            document.getElementById('minitial').value = data.minitial;
            document.getElementById('username').value = data.username;
        },
        preConfirm: () => {
                const lname = $('#lname').val().trim();
                const fname = $('#fname').val().trim();
                const minitial = $('#minitial').val().trim();
                const username = $('#username').val().trim();

                if (!lname || !fname || !username) {
                    Swal.showValidationMessage('Please fill in all required fields.');
                    return false;
                }

            return {
                slug: data.slug,
                lname: lname,
                fname: fname,
                minitial: minitial,
                username: username,
            };
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const data = result.value;
            $.ajax({
                url: '{{ route("admin.user.update", "slug") }}'.replace('slug', data.slug),
                type: 'PUT',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    ...data,
                },
                success: function(res) {
                    if (res == 2) {
                        toastr.success('Record updated successfully.');
                        setTimeout(function() {
                            $('#TBL_USER').DataTable().draw(false);
                        }, 500);
                    }
                },
                error: function(res) {
                    let msg = res.responseJSON?.message || 'Submission failed.';
                    Swal.fire('Error', msg, 'error');
                }
            });
        }
    });
}

// -------------------------
// Delete User Button

function delete_record(slug,url){

    var row = $("#" + slug);    

        row.addClass('table-warning');

        url = url.replace('slug',slug);

        Swal.fire({
            title: 'Please confirm to remove permanently this data.',
            width: '450px',
            customClass: {
                title: 'swal-title-sm',
                actions: 'swal-actions-right',
                confirmButton: 'btn-sm',
                cancelButton: 'btn-sm',
                popup: 'p-3'
            },
            showDenyButton: false,
            showCancelButton: true,
            confirmButtonText: '<i class="fa fa-trash"></i> Remove',
            confirmButtonColor: '#d73925',
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url : url,
                    type: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (res) {
                        if (res == 1) {
                            row.addClass('table-danger');
                            row.addClass('animate__animated animate__zoomOutLeft');

                            toastr.success('Data deleted successfully.');

                            setTimeout(function () {
                                row.closest('table').DataTable().draw(false);
                            }, 500);
                        } else {
                            row.removeClass('table-warning');
                            toastr.error('Error deleting data.');
                        }
                    },
                    error: function (res) {
                        row.removeClass('table-warning');

                        if (res.responseJSON && res.responseJSON.message) {
                            toastr.error(res.responseJSON.message);
                        } else {
                            toastr.error('An unexpected error occurred.');
                        }
                    },
            });
            }else{
                row.removeClass('table-warning');
            }
        });
}

// -------------------------
// Activate/Deactivate User

function activate(slug,url,status){

    var row = $("#" + slug);

    row.addClass('table-info');

    let title = status ? "Deactivate account?" : "Activate account?";
    let confirmButtonText = status ? "Deactivate" : "Activate";

    Swal.fire({
        title: title,
        showCancelButton: true,
        confirmButtonText: confirmButtonText,
        icon : 'question',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url : url,
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (res) {
                    if (res == 1) {
                        row.addClass('animate__animated animate__zoomOutLeft');

                        toastr.success('Data updated successfully.');

                        setTimeout(function () {
                            row.closest('table').DataTable().draw(false);
                        }, 500);
                    } else {
                        row.removeClass('table-warning');
                        toastr.error('Error activating data.');
                    }
                },
                error: function (res) {
                    row.removeClass('table-warning');

                    if (res.responseJSON && res.responseJSON.message) {
                        toastr.error(res.responseJSON.message);
                    } else {
                        toastr.error('An unexpected error occurred.');
                    }
                },
        });
        }else{
            row.removeClass('table-info');
        }
    });
}

// -------------------------
// Change Password

function change_password(slug) {

    const cpForm = @json(view('usercontrol.action.cpass')->render());

    const row = $("#" + slug);
    row.addClass('table-warning');

    Swal.fire({
        title: 'Change Password',
        html: cpForm,
        icon: 'none',
        width: '450px',
        customClass: {
            title: 'swal-title-sm',
            actions: 'swal-actions-right',
            confirmButton: 'btn-sm',
            cancelButton: 'btn-sm',
            popup: 'p-3'
        },
        showConfirmButton: true,
        showCancelButton: true,
        confirmButtonText: 'Confirm',
        cancelButtonText: 'Cancel',
        confirmButtonColor: '#007bff',
        cancelButtonColor: '#6c757d',
        focusConfirm: false,
        allowOutsideClick: true,
        allowEscapeKey: true,

        preConfirm: () => {
            const password = $('#password').val()?.trim();
            const password_confirmation = $('#password_confirmation').val()?.trim();

            console.log(password, password_confirmation);

            if (!password || !password_confirmation) {
                Swal.showValidationMessage('Please fill out both password fields.');
                return false;
            }

            if (password !== password_confirmation) {
                Swal.showValidationMessage('Passwords do not match.');
                return false;
            }

            return { slug, password, password_confirmation };
        },

        willClose: () => {
            row.removeClass('table-warning');
        }
    }).then((result) => {
        if (!result.isConfirmed) return;

        const formData = result.value;

        $.ajax({
            url: '{{ route("admin.user.change_password") }}',
            type: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: formData,
            success: function (res) {
                if (res == 1) {
                    toastr.success('Password updated successfully.');
                    setTimeout(() => {
                        row.closest('table').DataTable().draw(false);
                    }, 500);
                } else {
                    toastr.error('Error updating password.');
                }
            },
            error: function (res) {
                const msg = res.responseJSON?.message || 'An unexpected error occurred.';
                toastr.error(msg);
            },
        });
    });
}

// -------------------------
// Access List

let isModalOpenFunc = false;

function access_list(jsonData) {

    if (isModalOpenFunc) return;

    isModalOpenFunc = true;

    var modal = 'ACCESS_MODAL';

    var row = $("#" + jsonData.slug);

    row.addClass('table-info');

    $.ajax({
        url: '{{ route("admin.user.show", "slug") }}'.replace('slug', jsonData.slug),
        type: 'GET',
        data: {
            _token: '{{ csrf_token() }}'
        },
        success: function(data) {

            $('#modal-body').html(data);

            $('#' + modal).modal('show');

            $("#user_access_form select[multiple]").change(function (){
                updatePortalBadge();
                updateTabs();
            })

            updatePortalBadge();
            updateTabs();

            $('#user_access_form').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: '{{ route("admin.user.update_access") }}', // Form action URL
                    method: 'POST', // Form method
                    data: $(this).serialize(),
                    success: function (res) {
                        if(res == 2){
                            toastr.success('Saved successfully!');

                            // Hide the modal with a static ID (e.g., 'myModal')
                            $('#' + modal).modal('hide');

                            // Reload the DataTable with a static ID (e.g., 'myTable') after a short delay
                            setTimeout(function () {
                                $('#TBL_USER').DataTable().ajax.reload(null, false);
                            }, 500);
                        }
                    },
                    error: function (xhr) {
                        Swal.fire({
                            title: 'Error',
                            text: 'An unexpected error occurred: ' + xhr.responseText,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            });

            $('#' + modal).on('hidden.bs.modal', function(e) {
                isModalOpenFunc = false;
                $('#modal-body').html('');

                row.removeClass('table-info');

                if ($('.modal.show').length === 0) {
                    $('body').removeClass('modal-open');
                } else {
                    $('body').addClass('modal-open');
                }
            });
        },
        error: function(xhr) {
            isModalOpenFunc = false;
            row.removeClass('table-warning');
            Swal.fire({
                title: 'Error',
                text: 'An unexpected error occurred: ' + xhr.responseText,
                icon: 'error',
                confirmButtonText: 'OK'
            });
        }
    });
}

function updatePortalBadge(){
        $(".count-options").each(function (){
            let li = $(this);
            let targetCardId = li.attr('href');
            let len = $(targetCardId+" option:selected").length;
            li.find('.badge').html(len);
        })
    }
function updateTabs(){
    $(".tab-item").each(function (){
        let navLink = $(this);
        let targetPane = navLink.attr('href');
        let len = $(targetPane+" option:selected").length;
        navLink.find('.badge').html(len);
    })
}

</script>
@endpush