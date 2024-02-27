@push('scripts')
<script>
$(document).ready(function(){
        $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
        });


    $('#regBtn').on('click', function(){
        $('#registrationModal').modal('show');
        $('#registrationModal').modal().find('.modal-title').text('Account Registration Form');
        $('#errorContainer').prop('hidden', true);
    });


    $('#registrationModalForm').submit(function(e){
        e.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: "{{ url('admin/registeruserinfo') }}",
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
                        timer: 1000
                    });

                    Toast.fire({
                        icon: 'success',
                        title: 'Registration Successful!'
                    });

                    $('#registrationModal').modal('hide');
                    $('#registrationModalForm').trigger('reset');
                }
            },

            error: function(xhr) {

                console.log(xhr);

                // Check if the response has validation errors
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    // Display validation errors
                    var errors = xhr.responseJSON.errors;

                    // Assuming the server returns an error for the 'admin_username' field
                    if (errors.registration_username) {
                        $('#errorContainer').prop('hidden', false);
                    } else {
                        // Clear the error container if no specific error for 'admin_username'
                        $('#errorContainer').prop('hidden', true);
                    }
                }
            }
        });
    });


});
</script>
@endpush
