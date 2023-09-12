/*
 *  Document   : be_tables_datatables.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in DataTables Page
 */

// DataTables, for more examples you can check out https://www.datatables.net/
class pgSalesOrders {
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


        jQuery('.js-dataTable-sales_order_details').DataTable({
            ajax: `/admin/sales_order_details/${$('#so_number').val()}`,
            columns: [
                {
                    data: 'so_number',
                },
                {
                    data: 'item_id',
                },
                {
                    data: 'brand_name',
                },
                {
                    data: 'unit_code',
                },
                {
                    data: 'lot_no',
                },
                {
                    data: 'expiration_date',
                },
                {
                    data: 'qty',
                },
                {
                    data: 'unit_price',
                }
            ],
            columnDefs: [{
                "defaultContent": "-",
                "targets": "_all",
                "orderable": false
            },
            {
                targets: 7,
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


        jQuery('.js-dataTable-sales_order').DataTable({
            ajax: '/admin/sales_orders/all',
            columns: [
                {
                    data: 'sDate',
                    render: function (data, type, row) {
                        return moment(data).format("MM-DD-YYYY");
                    }
                },
                {
                    data: 'so_number',
                },
                {
                    data: 'os_number',
                },
                {
                    data: 'customer',
                },
                {
                    data: 'terms',
                },
                {
                    data: 'sStatus',
                    render: function (data, type, row) {
                        return getStatus(row.sStatus);
                    }
                },
                {
                    data: 'id',
                    render: function (data, type, row) {
                        var so_number = row['so_number'];
                        var os_number = row['os_number'];
                        var customer = row['customer'];
                        var terms = row['terms'];
                        return `
                            <div class="text-center">
                              <div class="btn-group">
                                <button type="button"  onclick="updateSO('${so_number}','${os_number}','${customer}','${terms}')" class="btn btn-sm btn-alt-info " data-bs-toggle="tooltip" title="Update">
                                  <i class="fa fa-fw fa-pencil-alt"></i>
                                </button>
                                <a href="/admin/sales_orders/print/${so_number}"   class="btn btn-sm btn-alt-success " data-bs-toggle="tooltip" title="Print Sales Order">
                                    <i class="fa fa-fw fa-print"></i>
                                </a>
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
            {
                targets: 3,
                render: $.fn.dataTable.render.number(',', '.', 2, 'P')
            },
            ]
        });


        jQuery('.item_table').DataTable({
            ajax: `/admin/inventory_details/data/${$('#os_number').val()}`,
            columns: [
                {
                    data: 'lot_no',
                },
                {
                    data: 'item_brand_name',
                },
                {
                    data: 'iQty',
                },
                {
                    data: null, // This column doesn't have specific data
                    render: function (data, type, row) {
                        return `<input type="text" class="form-control custom-input" placeholder="Enter sale price">`;
                    },
                },
                {
                    data: 'iID',
                    render: function (data, type, row) {
                        var INVTYID = row['iID'];
                        var ITEM_ID = row['item_id'];
                        var ITEM_BRAND_NAME = row['item_brand_name'];
                        var ITEM_UOM = row['item_unit_id'];
                        var QTY = row['iQty'];
                        var LOTNo = row['lot_no'];
                        var EXP_DATE = row['expiration_date'];
                        return `
                      <div class="text-center">
                        <div class="btn-group">
                            <button type="button"  onclick="addToSalesOrder(this,'${INVTYID}','${ITEM_ID}','${ITEM_BRAND_NAME}','${ITEM_UOM}','${QTY}','${LOTNo}','${EXP_DATE}')" class="btn btn-sm btn-alt-info " data-bs-toggle="tooltip" title="Add to Sales Order">
                                <i class="fa fa-fw fa-plus"></i>
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
One.onLoad(() => pgSalesOrders.init());

