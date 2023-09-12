/*
 *  Document   : be_tables_datatables.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in DataTables Page
 */

// DataTables, for more examples you can check out https://www.datatables.net/
class pgSalesInvoice {
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





        jQuery('.js-dataTable-outgoing_payment').DataTable({
            ajax: '/admin/outgoing_payment/all',
            columns: [
                {
                    data: 'sDate',
                    render: function (data, type, row) {
                        return moment(data).format("MM-DD-YYYY");
                    }
                },
                {
                    data: 'por_number',
                },
                {
                    data: 'po_number',
                },
                {
                    data: 'inspection_number',
                },
                {
                    data: 'supplier',
                },
                {
                    data: 'total_amount',
                },
                {
                    data: 'payment_mode',
                    render: function (data, type, row) {
                        if (data == 1) {
                            return 'Cash'
                        } else {
                            return 'Check'
                        }
                    }
                },
                {
                    data: 'payment_amount',
                },
                {
                    data: 'sStatus',
                    render: function (data, type, row) {
                        return getStatus(row.sStatus);
                    }
                }
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
            {
                targets: 7,
                render: $.fn.dataTable.render.number(',', '.', 2, 'P')
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
One.onLoad(() => pgSalesInvoice.init());

