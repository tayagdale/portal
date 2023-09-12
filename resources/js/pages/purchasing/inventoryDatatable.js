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
                    data: 'Iqty',
                },
                {
                    data: 'unit_code',
                },
                {
                    data: 'expiration_date',
                    render: function (data, type, row) {
                        return moment(data).format("MM-DD-YYYY");
                    }
                },
                {
                    data: 'Iqty',
                    render: function (data, type, row) {
                        if (data < 1) {
                            return `<span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-danger-light text-danger">OUT OF STOCK</span>`
                        } else if (data < 10) {
                            return `<span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-warning-light text-warning">LIMITED</span>`
                        } else {
                            return `<span class="fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-success-light text-success">IN STOCK</span>`
                        }
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

