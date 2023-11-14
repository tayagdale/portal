
var inventoryId;
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



function view_inventory(inventory_id) {
    inventoryId = inventory_id;
    console.log(inventory_id);
    $('#mdlViewInventory').modal('show'); // Show the modal

    var url = `/admin/inventory_details/data/item/${inventoryId}`;
    reloadDatatableWithUrl('inventory_table', url);
}





$("#mdlViewInventory").on('shown.bs.modal', function () {
    console.log(inventoryId);
    var url = `/admin/inventory_details/data/item/${inventoryId}`;
    reloadDatatableWithUrl('item_table', url);

});
