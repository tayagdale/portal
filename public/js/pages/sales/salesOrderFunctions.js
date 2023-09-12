
var unitId;
var requestType;
var base_url = window.location.origin;

$(document).ready(function () {

    $("#frmAddSO").on('submit', function (e) {
        e.preventDefault();
        $("#frmAddSO").attr('action', `/admin/sales_orders/${$("#os_number").val()}`);
        $.ajax({
            type: requestType,
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                window.location.href = `${base_url}/admin/sales_order`;
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
    $("#frmAddSO").trigger('reset'); // Reset the form fields
    $('#os_numberError, #dateError').text('');
    requestType = 'POST'; // Set the request type for adding
    getOrderSlips()
    $('#mdlAddSalesOrder').modal('show'); // Show the modal
}

function updateSO(so_number, os_number, customer, terms) {
    window.location.href = `${base_url}/admin/sales_orders/update/${so_number}`;

}

function add_item() {

    $.ajax({
        url: `/admin/order_slip_details/total_qty/${$('#os_number').val()}`,
        type: "GET",
        cache: false,
        processData: false,
        success: function (object) {
            console.log(object.data[0].qty);
            $("#total_os_qty").text(object.data[0].qty);
        },
    });

    reloadDatatable('item_table');
    $("#mdlAddSOItems").modal('show');
}

$("#mdlAddSOItems").on('shown.bs.modal', function () {
    var url = `/admin/inventory_details/data/${$('#os_number').val()}`;
    reloadDatatableWithUrl('item_table', url);

});

function addToSalesOrder(buttonElement, INVTYID, ITEM_ID, ITEM_BRAND_NAME, ITEM_UOM, QTY, LOTNo, EXP_DATE) {


    var salePriceValue = $(buttonElement).closest('tr').find('td').eq(3).find('input.custom-input').val(); // Change the index (0) as needed

    var dateOnly = new Date(EXP_DATE).toISOString().slice(0, 10);
    console.log(INVTYID);
    console.log(ITEM_ID);
    console.log(ITEM_BRAND_NAME);
    console.log(ITEM_UOM);
    console.log(QTY);
    console.log(LOTNo);
    console.log(dateOnly);

    if (!salePriceValue)
        Swal.fire({
            icon: 'warning',
            title: 'Warning',
            text: 'Sale Price required!',
            showConfirmButton: true,
        })
    else {
        $.ajax({
            url: "/admin/sales_order_details",
            type: "POST",
            contentType: "application/x-www-form-urlencoded",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: $.param({ 'so_number': $("#so_number").val(), 'os_number': $("#os_number").val(), 'invty_id': INVTYID, 'item_id': ITEM_ID, 'qty': QTY, 'unit_id': ITEM_UOM, 'lot_no': LOTNo, 'expiration_date': dateOnly, 'unit_price': salePriceValue }),
            cache: false,
            processData: false,
            success: function (data) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Item has been added to sales order.',
                    showConfirmButton: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        reloadDatatable('js-dataTable-sales_order_details');
                        $("#mdlAddSOItems").modal('hide');
                    }
                })

            },
            error: function (e) {
            }
        });

    }


}



function getOrderSlips() {
    var apiGetSupp = "/admin/order_slips/active/all";

    fetch(apiGetSupp, {
        method: "get"
    })
        .then(response => response.json())
        .then(data => {
            let order_slips = data.data;
            let html = '';
            html += "<option value='' disabled selected>Select order slip</option>";
            for (var i = 0; i < order_slips.length; i++) {
                html += "<option value=" + order_slips[i].id + ">" + order_slips[i].os_number + "</option>"
            }
            document.getElementById("os_number").innerHTML = html;
        })
}

