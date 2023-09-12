
var permissionId;
var requestType;

$(document).ready(function () {

    // Open the modal for adding a new item

    $("#frmPermission").on('submit', function (e) {
        e.preventDefault();

        $.ajax({
            type: requestType,
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                // Assuming your DataTable has an ID of 'petsTable'
                reloadDatatable('js-dataTable-permissions');
                $('#mdlPermission').modal('hide')
                // Optionally, you can display a success message or clear the form here
            },
            error: function (xhr, status, error) {
                // Handle the error if the Ajax request fails
                console.log(error);
                if (xhr.status === 422) {
                    var errors = xhr.responseJSON.errors;
                    displayErrors(errors);
                }
            }
        });

    });

});


function create() {
    $('#permission_nameError').text('');
    $("#frmPermission").trigger('reset'); // Reset the form fields
    $("#frmPermission").attr('action', "/admin/permissions"); // Set the form action for add
    requestType = 'POST'; // Set the request type for adding
    $('#mdlPermission').modal('show'); // Show the modal
}



function update(id, permission_name) {
    $('#permission_nameError').text('');
    var permissionId = id;
    var permission_name = permission_name;
    var editUrl = `/admin/permissions/${permissionId}`
    $("#frmPermission").attr('action', editUrl);
    $('#permission_id').val(permissionId);
    $('#permission_name').val(permission_name);
    requestType = 'PUT';
    $('#mdlPermission').modal('show');

}


function remove(id) {
    var permissionId = id; // Get the item ID from the edit button's data attribute
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'DELETE',
                url: `/admin/permissions/${permissionId}`,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    // Assuming your DataTable has an ID of 'petsTable'
                    reloadDatatable('js-dataTable-permissions');
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )

                },
                error: function (xhr, status, error) {
                    // Handle the error if the Ajax request fails
                    console.log(error);
                }
            });
        }
    })


}

function displayErrors(errors) {
    // Loop through the errors and display them in the corresponding divs
    $.each(errors, function (key, value) {
        $('#' + key + 'Error').text(value[0]).fadeIn();
    });
}
