
var unitId;
var requestType;
var base_url = window.location.origin;

$(document).ready(function () {

    const selectInput = document.getElementById("payment_mode");
    const textInputContainer = document.getElementById("checkNo");

    // Add an event listener to the select input
    selectInput.addEventListener("change", function() {
    const selectedValue = selectInput.value;
    
    // Check if the selected value is the one that should trigger the input field
    if (selectedValue === "2") {
        textInputContainer.style.display = "block"; // Show the input field
    } else {
        textInputContainer.style.display = "none"; // Hide the input field
        $("#check_number").val(""); // Hide the input field
    }
    });

    $("#frmAddIncomingPayment").on('submit', function (e) {
        e.preventDefault();
        $("#frmAddIncomingPayment").attr('action', `/admin/incoming_payment/${$("#si_number").val()}`);
        $.ajax({
            type: requestType,
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                window.location.href = `${base_url}/admin/incoming_payment`;
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
    $("#frmAddIncomingPayment").trigger('reset'); // Reset the form fields
    $('#si_numberError').text('');
    requestType = 'POST'; // Set the request type for adding
    getSalesInvoices();
    $('#mdlAddIncomingPayment').modal('show'); // Show the modal
}





function getSalesInvoices() {
    var apiGetSupp = "/admin/sales_invoice/active/all";

    fetch(apiGetSupp, {
        method: "get"
    })
        .then(response => response.json())
        .then(data => {
            let sales_orders = data.data;
            let html = '';
            html += "<option value='' disabled selected>Select Sales Invoice</option>";
            for (var i = 0; i < sales_orders.length; i++) {
                html += "<option value=" + sales_orders[i].id + ">" + sales_orders[i].si_number + "</option>"
            }
            document.getElementById("si_number").innerHTML = html;
        })
}

