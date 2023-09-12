
var unitId;
var requestType;
var base_url = window.location.origin;

$(document).ready(function () {

    $("#frmAddSalesInvoice").on('submit', function (e) {
        e.preventDefault();
        $("#frmAddSalesInvoice").attr('action', `/admin/sales_invoice/${$("#dr_number").val()}`);
        $.ajax({
            type: requestType,
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                window.location.href = `${base_url}/admin/sales_invoice`;
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
    $("#frmAddSalesInvoice").trigger('reset'); // Reset the form fields
    $('#dr_numberError').text('');
    requestType = 'POST'; // Set the request type for adding
    getDeliveries();
    $('#mdlAddSalesInvoice').modal('show'); // Show the modal
}





function getDeliveries() {
    var apiGetSupp = "/admin/delivery/active/all";

    fetch(apiGetSupp, {
        method: "get"
    })
        .then(response => response.json())
        .then(data => {
            let sales_orders = data.data;
            let html = '';
            html += "<option value='' disabled selected>Select delivery</option>";
            for (var i = 0; i < sales_orders.length; i++) {
                html += "<option value=" + sales_orders[i].id + ">" + sales_orders[i].dr_number + "</option>"
            }
            document.getElementById("dr_number").innerHTML = html;
        })
}


function viewSalesInvoiceDetails(si_number) {
    $("#sales_invoice_no").text(si_number);

    reloadDatatableWithUrl("js-dataTable-sales-invoice-details", `/admin/sales_invoice_details/${si_number}`);

    $("#mdlSalesInvoiceDetails").modal('show');
}
