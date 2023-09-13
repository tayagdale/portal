
var taxId;
var requestType;

$(document).ready(function () {

    // Open the modal for adding a new item

    $("#frmTax").on('submit', function (e) {
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
                reloadDatatable('js-dataTable-taxes');
                $('#mdlTax').modal('hide')
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


function update(id, effective_from, effective_to) {
    var taxId = id;
    var editUrl = `/admin/taxes/${taxId}`
    $("#frmTax").attr('action', editUrl);
    $('#tax_id').val(taxId);
    $('#effective_from').val(effective_from);
    $('#effective_to').val(effective_to);
    requestType = 'PUT';
    $('#mdlTax').modal('show');
}


function displayErrors(errors) {
    // Loop through the errors and display them in the corresponding divs
    $.each(errors, function (key, value) {
        $('#' + key + 'Error').text(value[0]).fadeIn();
    });
}
