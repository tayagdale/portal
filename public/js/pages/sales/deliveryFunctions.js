
var unitId;
var requestType;
var base_url = window.location.origin;

$(document).ready(function () {

    $("#frmAddDelivery").on('submit', function (e) {
        e.preventDefault();
        $("#frmAddDelivery").attr('action', `/admin/delivery/${$("#so_number").val()}`);
        $.ajax({
            type: requestType,
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                window.location.href = `${base_url}/admin/delivery`;
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
    $("#frmAddDelivery").trigger('reset'); // Reset the form fields
    $('#so_numberError').text('');
    requestType = 'POST'; // Set the request type for adding
    getSalesOrders();
    $('#mdlAddDelivery').modal('show'); // Show the modal
}





function getSalesOrders() {
    var apiGetSupp = "/admin/sales_orders/active/all";

    fetch(apiGetSupp, {
        method: "get"
    })
        .then(response => response.json())
        .then(data => {
            let sales_orders = data.data;
            let html = '';
            html += "<option value='' disabled selected>Select sales order</option>";
            for (var i = 0; i < sales_orders.length; i++) {
                html += "<option value=" + sales_orders[i].id + ">" + sales_orders[i].so_number + "</option>"
            }
            document.getElementById("so_number").innerHTML = html;
        })
}


function viewDeliveryDetails(dr_number) {
    $("#delivery_no").text(dr_number);

    reloadDatatableWithUrl("js-dataTable-delivery-details", `/admin/delivery_details/${dr_number}`);

    $("#mdlDeliveryDetails").modal('show');
}
