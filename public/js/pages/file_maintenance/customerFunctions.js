
var customerId;
var requestType;

$(document).ready(function () {

    // Open the modal for adding a new item

    $("#frmCustomer").on('submit', function (e) {
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
                reloadDatatable('js-dataTable-customers');
                $('#mdlCustomer').modal('hide')
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
    $('#customer_codeError, #descriptionError, #addressError, #contact_personError, #contact_noError, #positionError').text('');
    $("#frmCustomer").trigger('reset'); // Reset the form fields
    $("#frmCustomer").attr('action', "/admin/customers"); // Set the form action for add
    requestType = 'POST'; // Set the request type for adding
    $('#mdlCustomer').modal('show'); // Show the modal
}



function update(id, customer_code, description, address, contact_person, contact_no, position) {
    $('#customer_codeError, #descriptionError, #addressError, #contact_personError, #contact_noError, #positionError').text('');
    var customerId = id;
    var customer_code = customer_code;
    var description = description;
    var address = address;
    var contact_person = contact_person;
    var contact_no = contact_no;
    var position = position;
    var editUrl = `/admin/customers/${customerId}`
    $("#frmCustomer").attr('action', editUrl);
    $('#customer_id').val(customerId);
    $('#customer_code').val(customer_code);
    $('#description').val(description);
    $('#address').val(address);
    $('#contact_person').val(contact_person);
    $('#contact_no').val(contact_no);
    $('#position').val(position);
    requestType = 'PUT';
    $('#mdlCustomer').modal('show');

}


function remove(id) {
    var customerId = id; // Get the item ID from the edit button's data attribute
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
                url: `/admin/customers/${customerId}`,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    // Assuming your DataTable has an ID of 'petsTable'
                    reloadDatatable('js-dataTable-customers');
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
