
var termId;
var requestType;

$(document).ready(function () {

    // Open the modal for adding a new item

    $("#frmTerm").on('submit', function (e) {
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
                reloadDatatable('js-dataTable-terms');
                $('#mdlTerm').modal('hide')
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
    $('#termsError').text('');
    $("#frmTerm").trigger('reset'); // Reset the form fields
    $("#frmTerm").attr('action', "/admin/terms"); // Set the form action for add
    requestType = 'POST'; // Set the request type for adding
    getAllCalendar();
    $('#mdlTerm').modal('show'); // Show the modal
}



function update(id, terms) {
    $('#termsError').text('');
    var termId = id;
    var terms = terms;
    var editUrl = `/admin/terms/${termId}`
    $("#frmTerm").attr('action', editUrl);
    $('#term_id').val(termId);
    $('#terms').val(terms);
    requestType = 'PUT';
    getAllCalendar();
    $('#mdlTerm').modal('show');

}


function remove(id) {
    var termId = id; // Get the item ID from the edit button's data attribute
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
                url: `/admin/terms/${termId}`,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    // Assuming your DataTable has an ID of 'petsTable'
                    reloadDatatable('js-dataTable-terms');
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

function getAllCalendar() {
    $.get('/admin/calendars/all', function (options) {
        // Populate the select with options
        var select = $('#calendar_id');
        select.empty(); // Clear previous options
        options.data.forEach(function (option) {
            select.append($('<option>', {
                value: option.id,
                text: option.calendar
            }));
        });
    });
}


function displayErrors(errors) {
    // Loop through the errors and display them in the corresponding divs
    $.each(errors, function (key, value) {
        $('#' + key + 'Error').text(value[0]).fadeIn();
    });
}
