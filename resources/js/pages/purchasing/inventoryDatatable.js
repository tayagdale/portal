/*
 *  Document   : be_tables_datatables.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in DataTables Page
 */


// DataTables, for more examples you can check out https://www.datatables.net/
class pgPurchaseOrders {
    /*
     * Init DataTables functionality
     *
     */

    static initDataTables() {
        // Override a few default classes
        jQuery.extend(jQuery.fn.DataTable.ext.classes, {
            sWrapper: "dataTables_wrapper dt-bootstrap5",
            sFilterInput: "form-control form-control-sm",
            sLengthSelect: "form-select form-select-sm"
        });

        // Override a few defaults
        jQuery.extend(true, jQuery.fn.DataTable.defaults, {
            language: {
                lengthMenu: "_MENU_",
                search: "_INPUT_",
                searchPlaceholder: "Search..",
                info: "Page <strong>_PAGE_</strong> of <strong>_PAGES_</strong>",
                paginate: {
                    first: '<i class="fa fa-angle-double-left"></i>',
                    previous: '<i class="fa fa-angle-left"></i>',
                    next: '<i class="fa fa-angle-right"></i>',
                    last: '<i class="fa fa-angle-double-right"></i>'
                }
            }
        });

        // Override buttons default classes
        jQuery.extend(true, jQuery.fn.DataTable.Buttons.defaults, {
            dom: {
                button: {
                    className: 'btn btn-sm btn-primary'
                },
            }
        });



        jQuery('.js-dataTable-inventory').DataTable({
            ajax: '/admin/inventory/all',
            columns: [
                {
                    data: 'generic_name',
                },
                {
                    data: 'item_brand_name',
                },
                {
                    data: 'supp',
                },
                {
                    data: 'Iqty',
                },
                {
                    data: 'unicode',
                },

                {
                    data: 'unit_price',
                },
                {
                    data: 'converted_qty',
                    render: function (data, type, row) {

                        // console.log(parseInt(data));
                        return parseInt(data);
                    }
                },

                {
                    data: 'converted_uom',
                },
                {
                    data: 'inventory_status',
                    render: function (data, type, row) {
                        if (data == "In Stock") {
                            return `<span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-success-light text-success">IN STOCK</span>`
                        } else if (data == "Warning") {
                            return `<span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-warning-light text-warning">WARNING</span>`
                        } else {
                            return `<span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-danger-light text-danger">OUT OF STOCK</span>`
                        }
                    }
                },
                {
                    data: 'inventory_id',
                    render: function (data, type, row) {
                        var old_brand_name = row['brand_name'];
                        var old_generic_name = row['generic_name'];
                        var old_category = row['category_id'];
                        return `
                                <div class="text-center">
                                    <div class="btn-group">
                                    <button type="button" onclick="view_inventory(${data})" class="btn btn-sm btn-alt-info " data-bs-toggle="tooltip" title="View Inventory">
                                        <i class="fa fa-fw fa-magnifying-glass"></i>
                                    </button>
                                    </div> 
                                </div> `
                    }
                },
            ],
            pageLength: 10,
            lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
            autoWidth: false,
            responsive: true,
            "order": [[1, "desc"]],
            columnDefs: [{
                "defaultContent": "-",
                "targets": "_all",
                "orderable": false
            },
            ]
        });


        jQuery('.inventory_table').DataTable({
            ajax: `/admin/inventory_details/data/item/2`,
            columns: [
                {
                    data: 'po_number',
                },
                {
                    data: 'lot_no',
                },
                {
                    data: 'Iqty',
                },
                {
                    data: 'expiration_date',
                    render: function (data, type, row) {
                        if (data == '0000-00-00 00:00:00') {
                            return `<span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-info-light text-info">Not Available</span>`;
                        } else {
                            var parts = data.split(' ')[0].split('-'); // Split date part from the datetime string
                            var expDate = new Date(parts[0], parts[1] - 1, parts[2]);

                            // Get the current date
                            var currentDate = new Date();

                            // Calculate the date 18 months before the expiration date
                            var warningYear = expDate.getFullYear();
                            var warningMonth = expDate.getMonth() - 18;

                            // Adjust the year and month correctly
                            if (warningMonth < 0) {
                                warningYear -= 1;
                                warningMonth += 12;
                            }

                            var warningDate = new Date(warningYear, warningMonth, expDate.getDate());
                            console.log(warningDate);
                            // Check if the current date is after the warning date
                            if (currentDate >= warningDate) {
                                // Change the class to 'warning'
                                return `<span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-warning-light text-warning">${moment(data).format("MM-DD-YYYY")}</span>`;
                            } else {
                                return `<span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-success-light text-success">${moment(data).format("MM-DD-YYYY")}</span>`
                            }
                        }

                    }
                },
                {
                    data: 'inspection_date',
                },
            ],
            pageLength: 10,
            lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
            autoWidth: false,
            responsive: true,
            "order": [[2, "desc"]],
        });

    }

    /*
     * Init functionality
     *
     */
    static init() {
        this.initDataTables();

    }




}


// Initialize when page loads
One.onLoad(() => pgPurchaseOrders.init());



