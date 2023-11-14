

var userId;
var requestType;

$(document).ready(function () {

    // Open the modal for adding a new item
    getAllRoles();

    $("#frmUpdateUser").on('submit', function (e) {
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
                reloadDatatable('js-dataTable-users');
                $('#mdlUpdateUser').modal('hide')
                // Optionally, you can display a success message or clear the form here
            },
            error: function (xhr, status, error) {
                // Handle the error if the Ajax request fails
                console.log(error);
            }
        });

    });

});



function update(id, name, email, username, role) {
    userId = id;
    var category_name = category_name;
    var editUrl = `/admin/users/${userId}`
    $("#frmUpdateUser").attr('action', editUrl);
    $('#category_id').val(userId);
    $('#update_name').val(name);
    $('#update_email').val(email);
    $('#update_username').val(username);
    requestType = 'PUT';
    getAllRolesUpdate(role);
    $('#mdlUpdateUser').modal('show');

}

function getAllRoles() {
    $.get('/admin/roles/all', function (options) {
        // Populate the select with options
        var select = $('#role');
        select.empty(); // Clear previous options
        options.data.forEach(function (option) {

            select.append($('<option>', {
                value: option.id,
                text: option.description
            }));
        });
    });
}



function getAllRolesUpdate(role_id) {
    console.log(role_id);
    if (role_id) {
        $.get('/admin/roles/all', function (options) {
            // Populate the select with options
            var select = $('#update_role_id');
            select.empty(); // Clear previous options
            options.data.forEach(function (option) {
                var newOption = $('<option>', {
                    value: option.id,
                    text: option.description
                });

                // Set 'selected' attribute if option.id is 2
                if (option.id == role_id) {
                    newOption.attr('selected', 'selected');
                }

                select.append(newOption);
            });
        });
    } else {
        $.get('/admin/roles/all', function (options) {
            // Populate the select with options
            var select = $('#update_role_id');
            select.empty(); // Clear previous options
            options.data.forEach(function (option) {
                select.append($('<option>', {
                    value: option.id,
                    text: option.description
                }));
            });
        });
    }

}
