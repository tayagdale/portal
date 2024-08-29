
var unitId;
var requestType;
var base_url = window.location.origin;
var initialValue = 0; // The initial value you want tostart with
var currentValue = 0; // The initial value you want tostart with

$(document).ready(function () {
    getAllSuppliers()
    getSubtotal()
    // getAllUnits();
    getAllTerms();
    // Open the modal for adding a new item
    var po_number = $('.po_number').val();

    $("#submitPO").on('submit', function (e) {
        e.preventDefault();
        $("#submitPO").attr('action', `/admin/purchase_orders/${po_number}`);
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
                window.location.href = `${base_url}/admin/purchase_order`;
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
                $('#mdlSupplier').modal('hide');
                getAllSuppliers();
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

    $("#frmAddPoItem").on('submit', function (e) {
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
                reloadDatatable('js-dataTable-purchase_order_details');
                getSubtotal();

                $('#mdlAddPOItem').modal('hide');
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
    $("#frmUpdatePoItem").on('submit', function (e) {
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
                reloadDatatable('js-dataTable-purchase_order_details');
                getSubtotal();

                $('#mdlUpdatePOItem').modal('hide');
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

    $('#item_id').on('change', function () {
        $('#unit_id').prop("disabled", false);
        $.get(`/admin/units/unit/${this.value}`, function (options) {
            var select = $('#unit_id');
            select.empty();

            // Add placeholder
            var placeholder = $('<option>', {
                value: '',
                text: 'Select Unit',
                disabled: true,
                selected: true
            });
            select.append(placeholder);

            $.each(options.data, function (rowIndex, row) {
                $.each(row, function (columnName, columnValue) {
                    var option = $('<option>', {
                        value: columnValue.uom,
                        text: columnValue.unit_code,
                    });
                    select.append(option);
                });
            });
        });
    });

    $('#unit_id').on('change', function () {
        $.get(`/admin/units/qty/${this.value}/${$('#item_id').val()}`, function (options) {
            initialValue = options.data.qty;
            currentValue = initialValue;
            console.log(initialValue);
            $('#qty').val(options.data.qty);
        });
    });


    function updateButtonStates() {
        console.log(currentValue);
        $('#minus').prop('disabled', currentValue === initialValue);
    }

    // Plus button functionality
    $('#plus').on('click', function () {
        currentValue += initialValue; // Add the initial value to the current value
        $('#qty').val(currentValue); // Update the input field with the new value
        updateButtonStates(); // Update button states
    });

    // Minus button functionality
    $('#minus').on('click', function () {
        if (currentValue > initialValue) {
            currentValue -= initialValue; // Subtract the initial value from the current value
            $('#qty').val(currentValue); // Update the input field with the new value
        }
        updateButtonStates(); // Update button states
    });

    // Initial call to set the correct state of the minus button
    updateButtonStates();

});

function create() {
    $('#unit_codeError').text('');
    $("#frmUnit").trigger('reset'); // Reset the form fields
    $("#frmUnit").attr('action', "/admin/units"); // Set the form action for add
    requestType = 'POST'; // Set the request type for adding
    $('#mdlUnit').modal('show'); // Show the modal
}

function createDraft() {
    $('#mdlAddPONumber').modal('show'); // Show the modal
}


function update(id, unit_code) {
    $('#unit_codeError').text('');
    var unitId = id;
    var unit_code = unit_code;
    var editUrl = `/admin/units/${unitId}`
    $("#frmUnit").attr('action', editUrl);
    $('#unit_id').val(unitId);
    $('#unit_code').val(unit_code);
    requestType = 'PUT';
    $('#mdlUnit').modal('show');

}

function updatePO(po_number) {
    window.location.href = `${base_url}/admin/purchase_orders/create/${po_number}`;

}

function displayErrors(errors) {
    // Loop through the errors and display them in the corresponding divs
    $.each(errors, function (key, value) {
        $('#' + key + 'Error').text(value[0]).fadeIn();
    });
}



function create_supplier() {
    $('#supplier_codeError, #descriptionError, #addressError, #contact_personError, #contact_noError, #positionError').text('');
    $("#frmSupplier").trigger('reset'); // Reset the form fields
    $("#frmSupplier").attr('action', "/admin/suppliers"); // Set the form action for add
    requestType = 'POST'; // Set the request type for adding
    $('#mdlSupplier').modal('show'); // Show the modal

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
    $("#frmAddPoItem").trigger('reset'); // Reset the form fields
    $("#frmAddPoItem").attr('action', "/admin/purchase_order_details"); // Set the form action for add
    requestType = 'POST'; // Set the request type for adding
    $(".po_number_add").val($('.po_number').val());

    $('#mdlAddPOItem').modal('show'); // Show the modal
    getItems()
}

function update_item(id, name, qty, unit_price) {
    $("#frmUpdatePoItem").trigger('reset'); // Reset the form fields
    $("#frmUpdatePoItem").attr('action', `/admin/purchase_order_details/update/${id}`); // Set the form action for add
    requestType = 'PUT'; // Set the request type for adding
    po_details_item = id;
    $('#qty_update').val(qty);
    $('#unit_price_update').val(unit_price);
    $('#po_item_details_id').val(po_details_item);
    $('#item_name_update').text(name);
    $("#mdlUpdatePOItem").modal('show');
}


function delete_item(id) {
    var purchaseOrderDetailId = id; // Get the item ID from the edit button's data attribute
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
                url: `/admin/purchase_order_details/${purchaseOrderDetailId}`,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    // Assuming your DataTable has an ID of 'petsTable'
                    reloadDatatable('js-dataTable-purchase_order_details');
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                    getSubtotal();

                },
                error: function (xhr, status, error) {
                    // Handle the error if the Ajax request fails
                    console.log(error);
                }
            });
        }
    })


}

function clearPOItems(id) {
    Swal.fire({
        title: 'Do you want to clear all the item on this PO?',
        showCancelButton: true,
        confirmButtonText: 'Yes',
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `/admin/purchase_order_details/clear/${$('.po_number').val()}`,
                type: "DELETE",
                dataType: 'json',
                cache: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                processData: false,
                success: function (data) {
                    reloadDatatable('js-dataTable-purchase_order_details');
                    getSubtotal();
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
            let suppliers = data.data;
            let html = '';
            html += "<option value='' disabled selected>Select an item</option>";
            for (var i = 0; i < suppliers.length; i++) {
                html += "<option value=" + suppliers[i].id + ">" + suppliers[i].generic_name + ' - ' + suppliers[i].brand_name + "</option>"
            }
            document.getElementById("item_id").innerHTML = html;
        })
}



function getAllSuppliers() {
    $.get('/admin/suppliers/all', function (options) {
        // Populate the select with options
        var select = $('.supplier_id');
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

function getSubtotal() {
    var apiGetSupp = `/admin/purchase_order_details/total/${$('.po_number').val()}`;

    fetch(apiGetSupp, {
        method: "get"
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            var subtotal = 'P' + Number(parseFloat(data.data[0].total).toFixed(2)).toLocaleString('en', { minimumFractionDigits: 2 });
            document.getElementById("sub-total").innerHTML = subtotal == 'PNaN' ? 'P0.00' : subtotal;
            document.getElementById("sub-total-hidden").innerHTML = data.data[0].total;
            document.getElementsByClassName("total_amount").value = data.data[0].total;
            $(".total_amount").val(data.data[0].total == null ? 0 : data.data[0].total)
            console.log($(".total_amount").val());

        })
}

function printPO(po_number) {
    window.location.href = `${base_url}/admin/print_purchase_order`;

}
