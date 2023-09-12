
var statusId;
var requestType;

$(document).ready(function () {

    // Open the modal for adding a new item

    $("#frmInventoryStatus").on('submit', function (e) {
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
                reloadDatatable('js-dataTable-inventory_status');
                $('#mdlInventoryStatus').modal('hide')
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




function update(id, status_value) {
    $('#status_valueError').text('');
    var statusId = id;
    var status_value = status_value;
    var editUrl = `/admin/inventory_status/${statusId}`
    $("#frmInventoryStatus").attr('action', editUrl);
    $('#status_id').val(statusId);
    $('#status_value').val(status_value);
    requestType = 'PUT';
    $('#mdlInventoryStatus').modal('show');

}


function displayErrors(errors) {
    // Loop through the errors and display them in the corresponding divs
    $.each(errors, function (key, value) {
        $('#' + key + 'Error').text(value[0]).fadeIn();
    });
}
