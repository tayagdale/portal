
var unitId;
var requestType;
var base_url = window.location.origin;
$(document).ready(function () {
    getAllCustomers()
    getAllUnits()
    getAllTerms()
    // Open the modal for adding a new item
    var os_number = $('.os_number').val();

    $("#submitOS").on('submit', function (e) {
        e.preventDefault();
        $("#submitOS").attr('action', `/admin/order_slips/${os_number}`);
        requestType = 'PUT';
        $.ajax({
            type: requestType,
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                window.location.href = `${base_url}/admin/order_slip`;
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
                getAllCustomers();
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

    $("#frmItem").on('submit', function (e) {
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
                getItems();
                $('#mdlItem').modal('hide')
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

    $("#frmAddOSItem").on('submit', function (e) {
        e.preventDefault();
        var unit_price = $("#unit_price").val();
        var qty = $("#qty").val();
        $('.total_amount_add').val(unit_price * qty);
        $.ajax({
            type: requestType,
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                reloadDatatable('js-dataTable-order_slip_details');

                $('#mdlAddOSItem').modal('hide');
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
    $("#frmUpdateOSItem").on('submit', function (e) {
        e.preventDefault();
        var qty = $("#qty_update").val();
        var unit_price = $("#unit_price_update").val();
        console.log(unit_price);
        console.log(qty);
        $('#total_amount_update').val(unit_price * qty);
        console.log($('#total_amount_update').val());
        $.ajax({
            type: requestType,
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                reloadDatatable('js-dataTable-order_slip_details');

                $('#mdlUpdateOSItem').modal('hide');
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


function updateOS(os_number) {
    window.location.href = `${base_url}/admin/order_slips/create/${os_number}`;

}

function createDraft() {
    $('#mdlAddOSNumber').modal('show'); // Show the modal
}


function displayErrors(errors) {
    // Loop through the errors and display them in the corresponding divs
    $.each(errors, function (key, value) {
        $('#' + key + 'Error').text(value[0]).fadeIn();
    });
}



function create_customer() {
    $('#customer_codeError, #descriptionError, #addressError, #contact_personError, #contact_noError, #positionError').text('');
    $("#frmCustomer").trigger('reset'); // Reset the form fields
    $("#frmCustomer").attr('action', "/admin/customers"); // Set the form action for add
    requestType = 'POST'; // Set the request type for adding
    $('#mdlCustomer').modal('show'); // Show the modal

}

function create_item() {
    $('#brand_nameError, #category_idError, #unit_idError').text('');
    $("#frmItem").trigger('reset'); // Reset the form fields
    $("#frmItem").attr('action', "/admin/items"); // Set the form action for add
    requestType = 'POST'; // Set the request type for adding
    getAllCategories();
    getAllUnits();
    $('#mdlItem').modal('show'); // Show the modal
}

function add_item() {
    $("#frmAddOSItem").trigger('reset'); // Reset the form fields
    $("#frmAddOSItem").attr('action', "/admin/order_slip_details"); // Set the form action for add
    requestType = 'POST'; // Set the request type for adding
    $(".os_number_add").val($('.os_number').val());

    $('#mdlAddOSItem').modal('show'); // Show the modal
    getItems()
}

function update_item(id, name, qty) {
    $("#frmUpdateOSItem").trigger('reset'); // Reset the form fields
    $("#frmUpdateOSItem").attr('action', `/admin/order_slip_details/update/${id}`); // Set the form action for add
    requestType = 'PUT'; // Set the request type for adding
    os_item_details_id = id;
    $('#qty_update').val(qty);
    $('#os_item_details_id').val(os_item_details_id);
    $('#item_name_update').text(name);
    $("#mdlUpdateOSItem").modal('show');
}


function delete_item(id) {
    var orderSlipDetailId = id; // Get the item ID from the edit button's data attribute
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
                url: `/admin/order_slip_details/${orderSlipDetailId}`,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    // Assuming your DataTable has an ID of 'petsTable'
                    reloadDatatable('js-dataTable-order_slip_details');
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

function clearOSItems(id) {
    Swal.fire({
        title: 'Do you want to clear all the item on this OS?',
        showCancelButton: true,
        confirmButtonText: 'Yes',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `/admin/order_slip_details/clear/${$('.os_number').val()}`,
                type: "DELETE",
                dataType: 'json',
                cache: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false,
                success: function (data) {
                    reloadDatatable('js-dataTable-order_slip_details');
                },
                error: function (e) {
                }
            });
        }
    })
}


function getItems() {
    var apiGetSupp = "/admin/items/all";

    fetch(apiGetSupp, {
        method: "get"
    })
        .then(response => response.json())
        .then(data => {
            let items = data.data;
            let html = '';
            html += "<option value='' disabled selected>Select an item</option>";
            for (var i = 0; i < items.length; i++) {
                html += `<option data-generic-name=${items[i].generic_name} value=` + items[i].id + ">" + items[i].generic_name + ' - ' + items[i].brand_name + "</option>"
            }
            document.getElementById("item_id").innerHTML = html;
        })
}




function getAllCustomers() {
    $.get('/admin/customers/all', function (options) {
        // Populate the select with options
        var select = $('.customer_id');
        select.empty(); // Clear previous options
        // select.append($('<option>', {
        //     value: '',
        //     text: ''
        // }));
        options.data.forEach(function (option) {

            select.append($('<option>', {
                value: option.id,
                text: option.description
            }));
        });
    });
}


function getAllTerms() {
    $.get('/admin/terms/all', function (options) {
        // Populate the select with options
        var select = $('#terms');
        select.empty(); // Clear previous options
        // select.append($('<option>', {
        //     value: '',
        //     text: ''
        // }));
        options.data.forEach(function (option) {

            select.append($('<option>', {
                value: option.id,
                text: option.terms + ' ' + option.calendar
            }));
        });
    });
}



function getAllCategories() {
    $.get('/admin/categories/all', function (options) {
        // Populate the select with options
        var select = $('#category_id');
        select.empty(); // Clear previous options
        options.data.forEach(function (option) {
            select.append($('<option>', {
                value: option.id,
                text: option.category_name
            }));
        });
    });
}

function getAllUnits() {
    $.get('/admin/units/all', function (options) {
        // Populate the select with options
        var select = $('#unit_id');
        select.empty(); // Clear previous options
        options.data.forEach(function (option) {

            select.append($('<option>', {
                value: option.id,
                text: option.unit_code
            }));
        });
    });
}
