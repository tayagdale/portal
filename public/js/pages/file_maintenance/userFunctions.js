

$(document).ready(function () {

    // Open the modal for adding a new item
    getAllRoles();

});

function getAllRoles() {
    $.get('/admin/roles/all', function (options) {
        // Populate the select with options
        var select = $('#role_id');
        select.empty(); // Clear previous options
        options.data.forEach(function (option) {

            select.append($('<option>', {
                value: option.id,
                text: option.description
            }));
        });
    });
}