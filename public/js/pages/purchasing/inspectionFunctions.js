
var unitId;
var requestType;
var base_url = window.location.origin;
var qtyRequired;
var unitPrice;
$(document).ready(function () {
    getAllWarehouses();
    $("#frmAddInspection").on('submit', function (e) {
        e.preventDefault();
        $("#frmAddInspection").attr('action', `/admin/inspections/${$("#po_number").val()}`); // Set the form action for add
        $.ajax({
            type: requestType,
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                window.location.href = `${base_url}/admin/inspection`;
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

    $("#frmVerifyInspection").on('submit', function (e) {
        e.preventDefault();
        var qtyToDeliver = parseInt($("#txtItemQty_verify").val());
        if (qtyToDeliver > qtyRequired) {
            Swal.fire(
                'Warning!',
                'Quantity Delivered must not be greater than the quantity from Purchase Order.',
                'warning'
            )
        } else {
            $("#frmVerifyInspection").attr('action', `/admin/inspection_details/create`); // Set the form action for add
            $.ajax({
                type: 'POST',
                url: $(this).attr('action'),
                data: $(this).serialize(),
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    $('#mdlInspectionVerify').modal('hide'); // Show the modal
                    reloadDatatable('js-dataTable-inspection_details');
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
        }




    });

});


function create() {
    $("#frmAddInspection").trigger('reset'); // Reset the form fields
    $('#po_numberError').text('');
    requestType = 'POST'; // Set the request type for adding
    getPurchaseOrders()
    $('#mdlAddInspection').modal('show'); // Show the modal
}


function verify_item(item_id, brand_name, qty_required, unit_price) {
    unitPrice = unit_price;
    console.log(unitPrice);
    qtyRequired = parseInt(qty_required);
    $("#frmVerifyInspection").trigger('reset'); // Reset the form fields
    $('#qtyError, #lot_noError, #delivery_dateError, #expiration_dateError').text('');
    $('#itemNameVerify').text(brand_name)
    $('#txtItemId_verify').val(item_id);
    $('#txt_unit_price').val(unitPrice);
    $('#mdlInspectionVerify').modal('show'); // Show the modal
}

function view_details(po_number, item_id) {
    console.log(po_number);
    $("#purchase_no").text(po_number);

    reloadDatatableWithUrl("js-dataTable-inspection-details-view", `/admin/inspection_details/view_detail/${po_number}/${item_id}`);

    $("#mdlInspectionDetails").modal('show');
}
function displayErrors(errors) {
    // Loop through the errors and display them in the corresponding divs
    $.each(errors, function (key, value) {
        $('#' + key + 'Error').text(value[0]).fadeIn();
    });
}


function getAllWarehouses() {
    $.get('/admin/warehouse/all', function (options) {
        // Populate the select with options
        var select = $('#warehouse_id');
        select.empty(); // Clear previous options
        options.data.forEach(function (option) {

            select.append($('<option>', {
                value: option.id,
                text: option.warehouse_name
            }));
        });
    });
}


function getPurchaseOrders() {
    var apiGetSupp = "/admin/purchase_orders/active/all";

    fetch(apiGetSupp, {
        method: "get"
    })
        .then(response => response.json())
        .then(data => {
            let purchase_orders = data.data;
            let html = '';
            html += "<option value='' disabled selected>Select purchase order</option>";
            for (var i = 0; i < purchase_orders.length; i++) {
                html += "<option value=" + purchase_orders[i].id + ">" + purchase_orders[i].po_number + "</option>"
            }
            document.getElementById("po_number").innerHTML = html;
        })
}

