
var roleId;
var requestType;

$(document).ready(function () {
    getUnassignedPermissions();
    // Open the modal for adding a new item

    $("#frmRole").on('submit', function (e) {
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
                reloadDatatable('js-dataTable-roles');
                $('#mdlRole').modal('hide')
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

    $("#frmAssignPermission").on('submit', function (e) {
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
                reloadDatatable('js-dataTable-assign');
                $('#mdlAssignPermission').modal('hide')
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
    $('#descriptionError').text('');
    $("#frmRole").trigger('reset'); // Reset the form fields
    $("#frmRole").attr('action', "/admin/roles"); // Set the form action for add
    requestType = 'POST'; // Set the request type for adding
    $('#mdlRole').modal('show'); // Show the modal
}

function assign() {
    $("#frmAssignPermission").trigger('reset'); // Reset the form fields
    $("#frmAssignPermission").attr('action', "/admin/permissions_to_roles"); // Set the form action for add
    requestType = 'POST'; // Set the request type for adding
    getUnassignedPermissions();
    $('#mdlAssignPermission').modal('show'); // Show the modal
}


function unassignPermission(id) {
    var roleId = id; // Get the item ID from the edit button's data attribute
    Swal.fire({
        title: 'Are you sure you want to unassign this permission?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, unassign it.'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: 'DELETE',
                url: `/admin/permissions_to_roles/${id}`,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    // Assuming your DataTable has an ID of 'petsTable'
                    reloadDatatable('js-dataTable-assign');
                    Swal.fire(
                        'Unassigned!',
                        'Permission has been unassigned.',
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

function update(id, description) {
    $('#descriptionError').text('');
    var roleId = id;
    var description = description;
    var editUrl = `/admin/roles/${roleId}`
    $("#frmRole").attr('action', editUrl);
    $('#role_id').val(roleId);
    $('#description').val(description);
    requestType = 'PUT';
    $('#mdlRole').modal('show');

}


function remove(id) {
    var roleId = id; // Get the item ID from the edit button's data attribute
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
                url: `/admin/roles/${roleId}`,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    // Assuming your DataTable has an ID of 'petsTable'
                    reloadDatatable('js-dataTable-roles');
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

function getUnassignedPermissions() {
    var apiGetSupp = `/admin/permissions/unassigned/${$("#role_id").val()}}`;

    fetch(apiGetSupp, {
        method: "get"
    })
        .then(response => response.json())
        .then(data => {
            let permissions = data.data;
            let html = '';
            for (var i = 0; i < permissions.length; i++) {
                html += "<option value=" + permissions[i].id + ">" + permissions[i].permission_name + "</option>"
            }
            document.getElementById("permission_ids").innerHTML = html;
        })
}


function displayErrors(errors) {
    // Loop through the errors and display them in the corresponding divs
    $.each(errors, function (key, value) {
        $('#' + key + 'Error').text(value[0]).fadeIn();
    });
}
