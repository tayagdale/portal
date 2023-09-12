
var supplierId;
var requestType;

$(document).ready(function () {

    // Open the modal for adding a new item

    $("#frmSupplier").on('submit', function (e) {
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
                reloadDatatable('js-dataTable-suppliers');
                $('#mdlSupplier').modal('hide')
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
    $('#supplier_codeError, #descriptionError, #addressError, #contact_personError, #contact_noError, #positionError').text('');
    $("#frmSupplier").trigger('reset'); // Reset the form fields
    $("#frmSupplier").attr('action', "/admin/suppliers"); // Set the form action for add
    requestType = 'POST'; // Set the request type for adding
    $('#mdlSupplier').modal('show'); // Show the modal
}



function update(id, supplier_code, description, address, contact_person, contact_no, position) {
    $('#supplier_codeError, #descriptionError, #addressError, #contact_personError, #contact_noError, #positionError').text('');
    var supplierId = id;
    var supplier_code = supplier_code;
    var description = description;
    var address = address;
    var contact_person = contact_person;
    var contact_no = contact_no;
    var position = position;
    var editUrl = `/admin/suppliers/${supplierId}`
    $("#frmSupplier").attr('action', editUrl);
    $('#supplier_id').val(supplierId);
    $('#supplier_code').val(supplier_code);
    $('#description').val(description);
    $('#address').val(address);
    $('#contact_person').val(contact_person);
    $('#contact_no').val(contact_no);
    $('#position').val(position);
    requestType = 'PUT';
    $('#mdlSupplier').modal('show');

}


function remove(id) {
    var supplierId = id; // Get the item ID from the edit button's data attribute
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
                url: `/admin/suppliers/${supplierId}`,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    // Assuming your DataTable has an ID of 'petsTable'
                    reloadDatatable('js-dataTable-suppliers');
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
