
var itemId;
var requestType;
var categoryId;

$(document).ready(function () {

    // Open the modal for adding a new item

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
                reloadDatatable('js-dataTable-items');
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

});


function create() {
    $('#brand_nameError, #category_idError, #unit_idError').text('');
    $("#frmItem").trigger('reset'); // Reset the form fields
    $("#frmItem").attr('action', "/admin/items"); // Set the form action for add
    requestType = 'POST'; // Set the request type for adding
    getAllCategories();
    getAllUnits();
    $('#mdlItem').modal('show'); // Show the modal
}

function selectElement(id, valueToSelect) {
    let element = document.getElementById(id);
    element.value = valueToSelect;
}


function update(id, brand_name, generic_name, category) {
    $('#brand_nameError, #category_idError, #unit_idError').text('');
    // console.log(category);
    var itemId = id;
    var brand_name = brand_name;
    var generic_name = generic_name;
    var editUrl = `/admin/items/${itemId}`
    $("#frmItem").attr('action', editUrl);
    $('#item_id').val(itemId);
    $('#brand_name').val(brand_name);
    $('#generic_name').val(generic_name);
    requestType = 'PUT';
    categoryId = category;
    getAllCategories(categoryId);
    getAllUnits();
    $("#category_id").val("2").trigger('change');
    $('#mdlItem').modal('show');

}


function remove(id) {
    var itemId = id; // Get the item ID from the edit button's data attribute
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
                url: `/admin/items/${itemId}`,
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    // Assuming your DataTable has an ID of 'petsTable'
                    reloadDatatable('js-dataTable-items');
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


function getAllCategories(category_id) {
    console.log(category_id);
    if(category_id){
        $.get('/admin/categories/all', function (options) {
            // Populate the select with options
            var select = $('#category_id');
            select.empty(); // Clear previous options
            options.data.forEach(function (option) {
                var newOption = $('<option>', {
                    value: option.id,
                    text: option.category_name
                });
    
                // Set 'selected' attribute if option.id is 2
                if (option.id == category_id) {
                    newOption.attr('selected', 'selected');
                }
    
                select.append(newOption);
            });
        });
    } else {
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