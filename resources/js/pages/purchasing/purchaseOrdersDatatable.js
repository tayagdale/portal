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


        jQuery('.js-dataTable-purchase_order_details').DataTable({
            ajax: `/admin/purchase_order_details/${$('#po_number').val()}`,
            columns: [
                {
                    data: 'item_id',
                },
                {
                    data: 'brand_name',
                },
                {
                    data: 'generic_name',
                },
                {
                    data: 'unit_code',
                },
                {
                    data: 'qty',
                },
                {
                    data: 'unit_price',
                },
                {
                    data: 'total_amount',
                },
                {
                    data: 'id',
                    render: function (data, type, row) {
                        var item_name = row['brand_name'];
                        var item_qty = row['qty'];
                        var item_price = row['unit_price'];
                        return `
                      <div class="text-center">
                        <div class="btn-group">
                          <button type="button" onclick="update_item(${data}, '${item_name}',  ${item_qty}, ${item_price})" class="btn btn-sm btn-alt-info " data-bs-toggle="tooltip" title="Update Item">
                            <i class="fa fa-fw fa-pencil-alt"></i>
                          </button>
                          <button type="button" onclick="delete_item(${data})" class="btn btn-sm btn-alt-danger " data-bs-toggle="tooltip" title="Remove Item">
                            <i class="fa fa-fw fa-trash-alt"></i>
                          </button>
                        </div> 
                      </div> `
                    }
                },
            ],
            columnDefs: [{
                "defaultContent": "-",
                "targets": "_all",
                "orderable": false
            },
            {
                targets: 5,
                render: $.fn.dataTable.render.number(',', '.', 2, 'P')
            },
            {
                targets: 6,
                render: $.fn.dataTable.render.number(',', '.', 2, 'P')
            },
            ],
            // pageLength: 10,
            "bPaginate": false,
            "bInfo": false,
            autoWidth: false,
            responsive: true,
            "ordering": false,
            searching: false
        });


        jQuery('.js-dataTable-purchase_orders').DataTable({
            ajax: '/admin/purchase_orders/all',
            columns: [
                {
                    data: 'date',
                    render: function (data, type, row) {
                        return moment(data).format("MM/DD/YYYY");
                    }
                },
                {
                    data: 'po_number',
                },
                {
                    data: 'supplier',
                },
                {
                    data: 'total_amount',
                },
                {
                    data: 'status',
                    render: function (data, type, row) {
                        return getStatus(row.status);
                    }
                },
                {
                    data: 'id',
                    render: function (data, type, row) {
                        if (row.status == 2) {
                            return `
                            <div class="text-center">
                              <div class="btn-group">
                                <a href="/admin/purchase_orders/print/${row.po_number} " class="btn btn-sm btn-alt-success" data-bs-toggle="tooltip" title="Update">
                                <i class="fa fa-fw fa-print"></i>
                                </a>
                              </button>
                              </div> 
                            </div> `
                        } else {
                            return `
                            <div class="text-center">
                              <div class="btn-group">
                                <button type="submit" onclick="updatePO('${row.po_number}')" class="btn btn-sm btn-alt-info" data-bs-toggle="tooltip" title="Update">
                                  <i class="fa fa-fw fa-pencil-alt"></i>
                                </button>
                                <a href="/admin/purchase_orders/print_/${row.po_number} " class="btn btn-sm btn-alt-success" data-bs-toggle="tooltip" title="Update">
                                <i class="fa fa-fw fa-print"></i>
                                </a>
                              </button>
                              </div> 
                            </div> `
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
            {
                targets: 3,
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
One.onLoad(() => pgPurchaseOrders.init());

