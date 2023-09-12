
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

    $("#frmAddOutgoingPayment").on('submit', function (e) {
        e.preventDefault();
        $("#frmAddOutgoingPayment").attr('action', `/admin/outgoing_payment/${$("#inspection_number").val()}`);
        $.ajax({
            type: requestType,
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                window.location.href = `${base_url}/admin/outgoing_payment`;
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
    $("#frmAddOutgoingPayment").trigger('reset'); // Reset the form fields
    $('#inspection_numberError').text('');
    requestType = 'POST'; // Set the request type for adding
    getInspections();
    $('#mdlAddOutgoingPayment').modal('show'); // Show the modal
}





function getInspections() {
    var apiGetSupp = "/admin/inspections/active/all";

    fetch(apiGetSupp, {
        method: "get"
    })
        .then(response => response.json())
        .then(data => {
            let inspections = data.data;
            let html = '';
            html += "<option value='' disabled selected>Select Inspection</option>";
            for (var i = 0; i < inspections.length; i++) {
                html += "<option value=" + inspections[i].id + ">" + inspections[i].inspection_number + "</option>"
            }
            document.getElementById("inspection_number").innerHTML = html;
        })
}

