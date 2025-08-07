@push('scripts')
<script>
$(document).ready(function(){
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
        });

    var menu_Table = $('#menu_Table').DataTable({
        processing: true,
        serverSide: true,
        ordering: false,
        pageLength: 20,
        lengthChange: false,
        searching: false,
        ajax: "{{ route('admin.menu.index') }}",
        columns: [
            { data:'menuName_create'},
            { data:'menuRoute_create'},
            { data: 'submenus'},
            { data:'menuCategory_create'},
            { data:'menuPortal_create'},
            { data:'action'},
        ]
    });

    const createForm = @json(view('menu.modals.create')->render());

$('#createMenuBtn').on('click', function() {
    Swal.fire({
            title: 'Menu Form',
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
            didOpen: () => {
                const iconInput = document.getElementById('icon');
                const iconPreview = document.getElementById('icon-preview');

                if (iconInput && iconPreview) {
                    const defaultIcon = '<i class="fas fa-question"></i>';
                    iconPreview.innerHTML = defaultIcon;

                    iconInput.addEventListener('input', function () {
                        const val = iconInput.value.trim();

                        if (val !== '') {
                            // Create a temporary icon element to test rendering
                            const testIcon = document.createElement('i');
                            testIcon.className = val;
                            testIcon.style.visibility = 'hidden'; // don't show
                            document.body.appendChild(testIcon);

                            // Give it time to render (in case fonts are loading)
                            setTimeout(() => {
                                if (testIcon.offsetWidth > 0 && testIcon.offsetHeight > 0) {
                                    iconPreview.innerHTML = `<i class="${val}"></i>`;
                                } else {
                                    iconPreview.innerHTML = defaultIcon;
                                }
                                testIcon.remove();
                            }, 50);
                        } else {
                            iconPreview.innerHTML = defaultIcon;
                        }
                    });
                }
            },
            preConfirm: () => {
                const menuName_create = $('#menuName_create').val().trim();
                const menuRoute_create = $('#menuRoute_create').val().trim();
                const menuCategory_create = $('#menuCategory_create').val().trim();
                const menuPortal_create = $('#menuPortal_create').val();
                const icon = $('#icon').val().trim();
                const is_menu_create = $('#is_menu_create').is(':checked') ? 1 : 0;
                const is_dropdown_create = $('#is_dropdown_create').is(':checked') ? 1 : 0;
                const submenus = [];
                $('input[name="submenus[]"]:checked').each(function() {
                    submenus.push($(this).val());
                });

                if (!menuName_create || !menuRoute_create || !menuCategory_create || !menuPortal_create || !is_menu_create) {
                    Swal.showValidationMessage(
                        'Please fill in Name, Route, Category, Portal, Is menu.');
                    return false;
                }
                return {
                    menuName_create: menuName_create,
                    menuRoute_create: menuRoute_create,
                    menuCategory_create: menuCategory_create,
                    menuPortal_create: menuPortal_create,
                    icon: icon,
                    is_menu_create: is_menu_create,
                    is_dropdown_create: is_dropdown_create,
                    submenus: submenus
                };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const data = result.value;
                $.ajax({
                    url: "{{ route('admin.menu.store') }}",
                    type: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: data,
                    success: function(res) {
                        if (res == 1) {
                            toastr.success('Record created successfully.');
                            setTimeout(function() {
                                $('#menu_Table').DataTable().draw(false);
                            }, 500);
                        }
                    },
                    error: function(res) {
                        let msg = res.responseJSON?.message ||
                            'Submission failed.';
                        Swal.fire('Error', msg, 'error');
                    }
                });
            }
        });       
});

});

function delete_record(slug, url, isSubmenu) {
    var row = $("#" + slug);

    row.addClass('table-warning');
    url = url.replace('slug', slug);

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
                url: url,
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
                            $('#menu_Table').DataTable().draw(false);
                            if (isSubmenu == true) {
                                $('#TBL_SUBMENU').DataTable().draw(false);
                            }
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
                }
            });
        } else {
            row.removeClass('table-warning');
        }
    });
}

function edit_form(data){

    const editForm = @json(view('menu.modals.edit')->render());

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
                document.getElementById('menuName_create').value = data.menuName_create;
                document.getElementById('menuRoute_create').value = data.menuRoute_create;
                document.getElementById('menuCategory_create').value = data.menuCategory_create;
                document.getElementById('menuPortal_create').value = data.menuPortal_create;
                document.getElementById('is_menu_create').checked = data.is_menu_create == 1;
                document.getElementById('is_dropdown_create').checked = data.is_dropdown_create == 1;

                // Set icon input value and preview
                const iconInput = document.getElementById('icon');
                const iconPreview = document.getElementById('icon-preview');
                const iconClass = data.icon && data.icon.trim() !== '' ? data.icon : 'fas fa-file-alt';

                if (iconInput && iconPreview) {
                    iconInput.value = iconClass;
                    iconPreview.innerHTML = `<i class="${iconClass}"></i>`;

                    iconInput.addEventListener('input', function () {
                        const val = iconInput.value.trim();

                        if (val !== '') {
                            // Validate preview by testing render
                            const testIcon = document.createElement('i');
                            testIcon.className = val;
                            testIcon.style.visibility = 'hidden';
                            document.body.appendChild(testIcon);

                            setTimeout(() => {
                                if (testIcon.offsetWidth > 0 && testIcon.offsetHeight > 0) {
                                    iconPreview.innerHTML = `<i class="${val}"></i>`;
                                } else {
                                    iconPreview.innerHTML = `<i class="fas fa-file-alt"></i>`;
                                }
                                testIcon.remove();
                            }, 50);
                        } else {
                            iconPreview.innerHTML = `<i class="fas fa-file-alt"></i>`;
                        }
                    });
                }
            },
            preConfirm: () => {
                const menuName_create = $('#menuName_create').val().trim();
                const menuRoute_create = $('#menuRoute_create').val().trim();
                const menuCategory_create = $('#menuCategory_create').val().trim();
                const menuPortal_create = $('#menuPortal_create').val();
                const icon = $('#icon').val();
                const is_menu_create = $('#is_menu_create').is(':checked') ? 1 : 0;
                const is_dropdown_create = $('#is_dropdown_create').is(':checked') ? 1 : 0;

                if (!menuName_create || !menuRoute_create || !menuCategory_create || !menuPortal_create || !is_menu_create) {
                    Swal.showValidationMessage('Please fill in Name, Route, Category, Portal, Is menu.');
                    return false;
                }

                return {
                    slug: data.slug,
                    menuName_create: menuName_create,
                    menuRoute_create: menuRoute_create,
                    menuCategory_create: menuCategory_create,
                    menuPortal_create: menuPortal_create,
                    icon: icon,
                    is_menu_create: is_menu_create,
                    is_dropdown_create: is_dropdown_create,
                };
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const data = result.value;
            $.ajax({
                url: '{{ route("admin.menu.update", "slug") }}'.replace('slug', data.slug),
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    _method: 'PUT',
                    ...data,
                },
                success: function(res) {
                    if (res == 2) {
                        toastr.success('Record updated successfully.');
                        setTimeout(function() {
                            $('#menu_Table').DataTable().draw(false);
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

let isModalOpenFunc = false;

function submenu_list(jsonData) {

        if (isModalOpenFunc) return;

        isModalOpenFunc = true;

        var modal = 'SUB_MENU_MODAL';

        var row = $("#" + jsonData.slug);

        row.addClass('table-info');

        $.ajax({
            url: '{{ route("admin.submenu.show", "menu_id") }}'.replace('menu_id', jsonData.menu_id),
            type: 'GET',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(data) {

                $('#modal-body').html(data);

                $('#' + modal).modal('show');

                let active = '';


                submenusTbl = $("#TBL_SUBMENU").DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: '{{ route("admin.submenu.index") }}',
                        data: function (d) {
                            d.slug = jsonData.slug;
                            d.menu_id = jsonData.menu_id;
                        }
                    },
                    columns: [
                        { data : "name" },
                        { data : "nav_name" },
                        { data : "route" },
                        { data : "is_nav" },
                        { data : "users_with_access_count" },
                        { data : "action", orderable: false },
                    ],

                    columnDefs:[
                        {
                        targets: [0,1,2,5],
                        createdCell: function (td, cellData, rowData, row, col) {
                                $(td).addClass('text-center align-middle');

                            }
                        },
                        {
                        targets: [3,4],
                        createdCell: function (td, cellData, rowData, row, col) {
                                $(td).addClass('text-center text-strong align-middle');

                            }
                        },
                    ],
                    order:[[3,'desc'],[0,'asc']],
                    responsive: false,
                    initComplete: function( settings, json ) {
                        $('#'+settings.sTableId+'_filter input').unbind();
                        $('#'+settings.sTableId+'_filter input').bind('keyup', function (e) {
                            if (e.keyCode == 13) {
                                submenusTbl.search(this.value).draw();
                            }
                        });
                    },
                    drawCallback: function(settings){
                        if(active != ''){
                            $("#"+settings.sTableId+" #"+active).addClass('table-success');
                        }
                    }
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
                handleError(xhr);
            }
        });
}

function submenu_form(jsonData, url, menu_id) {
        $('#submenuForm')[0].reset();
        $('#slug').val('');
        $('#is_nav').prop('checked', false);

        let method = 'POST';

        if (jsonData) {
            $('#slug').val(jsonData.slug ?? '');
            $('#name').val(jsonData.name ?? '');
            $('#nav_name').val(jsonData.nav_name ?? '');
            $('#route').val(jsonData.route ?? '');
            $('#is_nav').prop('checked', jsonData.is_nav == 1);

            method = 'PUT';
        }

        $('#SUB_MENU_FORM_MODAL').modal('show');

        $('#btn_save_sub').off('click').on('click', function () {
            var formArray = $('#submenuForm').serializeArray();
            var formData = {};

            $(formArray).each(function () {
                formData[this.name] = this.value;
            });

            if (!$('#is_nav').is(':checked')) {
                formData['is_nav'] = null;
            }

            $.ajax({
                url: url,
                method: method,
                data: {
                    formData,
                    menu_id: menu_id
                },
                success: function (res) {
                    if (res == 1) {
                        $('#submenuForm')[0].reset();
                        $('#SUB_MENU_FORM_MODAL').modal('hide');
                        toastr.success('Record saved successfully.');
                        setTimeout(function () {
                            $('#TBL_SUBMENU').DataTable().draw(false);
                            $('#menu_Table').DataTable().draw(false);
                        }, 500);
                    }
                },
                error: function (xhr) {
                    handleError(xhr);
                }
            });

        });

        $('#SUB_MENU_FORM_MODAL').on('hidden.bs.modal', function (e) {
            $('#submenuForm')[0].reset();

            if ($('.modal.show').length === 0) {
                $('body').removeClass('modal-open');
            } else {
                $('body').addClass('modal-open');
            }
        });
}



</script>
@endpush
