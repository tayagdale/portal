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


        jQuery('.js-dataTable-inspection_details').DataTable({
            ajax: `/admin/inspection_details/${$('#po_number').val()}`,
            columns: [
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
                    data: 'purchase_order_qty',
                },
                // {
                //     data: 'Iqty',
                // },
                {
                    data: 'unit_price',
                },
                {
                    data: 'total_amount',
                },
                {
                    data: 'inspection_number',
                    render: function (data, type, row) {
                        var po_number = row.po_number;
                        var item_id = row.item_id;
                        var brand_name = row.brand_name;
                        var unit_price = row.unit_price;
                        var qty_required = row.purchase_order_qty;
                        if (row.purchase_order_qty == 0) {
                            return `
                            <div class="text-center">
                            <div class="btn-group">
                              <button onclick="view_details('${po_number}','${item_id}')" class="btn btn-sm btn-alt-info " data-bs-toggle="tooltip" title="View Details">
                                <i class="fa fa-fw fa-eye"></i>
                              </button>
                            </div> 
                          </div> `
                        } else {
                            return `
                            <div class="text-center">
                            <div class="btn-group">
                              <button onclick="verify_item('${item_id}','${brand_name}','${qty_required}','${unit_price}')" class="btn btn-sm btn-alt-success " data-bs-toggle="tooltip" title="Verify Items">
                                <i class="fa fa-fw fa-check"></i>
                              </button>
                            </div> 
                          </div> `
                        }

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


        jQuery('.js-dataTable-inspection-details-view').DataTable({
            columns: [
                {
                    data: 'po_number',
                },
                {
                    data: 'generic_name',
                },
                {
                    data: 'brand_name',
                },
                {
                    data: 'qty',
                },
                {
                    data: 'lot_no',
                },
                {
                    data: 'delivery_date',
                },
                {
                    data: 'expiration_date',
                },
                {
                    data: 'user_name',
                },
            ],
            pageLength: 10,
            lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
            autoWidth: false,
            responsive: true,
            columnDefs: [{
                "defaultContent": "-",
                "targets": "_all"
            }]

        });

        // jQuery('.js-dataTable-inspection_details-view').DataTable({
        //     ajax: `/admin/inspection_details/view_detail/`,
        //     columns: [
        //         {
        //             data: 'po_number',
        //         },
        //         {
        //             data: 'generic_name',
        //         },
        //         {
        //             data: 'brand_name',
        //         },
        //         {
        //             data: 'qty',
        //         },
        //         {
        //             data: 'lot_no',
        //         },
        //         {
        //             data: 'delivery_date',
        //         },
        //         {
        //             data: 'expiration_date',
        //         },
        //         {
        //             data: 'user_name',
        //         },
        //     ],
        //     columnDefs: [{
        //         "defaultContent": "-",
        //         "targets": "_all",
        //         "orderable": false
        //     },
        //     {
        //         targets: 5,
        //         render: $.fn.dataTable.render.number(',', '.', 2, 'P')
        //     },
        //     {
        //         targets: 6,
        //         render: $.fn.dataTable.render.number(',', '.', 2, 'P')
        //     },
        //     ],
        //     // pageLength: 10,
        //     "bPaginate": false,
        //     "bInfo": false,
        //     autoWidth: false,
        //     responsive: true,
        //     "ordering": false,
        //     searching: false
        // });



        jQuery('.js-dataTable-inspections').DataTable({
            ajax: '/admin/inspections/all',
            columns: [
                {
                    data: 'inspection_date',
                    render: function (data, type, row) {
                        return moment(data).format("MM-DD-YYYY");
                    }
                },
                {
                    data: 'inspection_number',
                },
                {
                    data: 'po_number',
                },
                {
                    data: 'supplier',
                },
                {
                    data: 'warehouse_name',
                },
                {
                    data: 'warehouse_location',
                },
                {
                    data: 'total_amount',
                },
                {
                    data: 'inspection_status',
                    render: function (data, type, row) {
                        if (row['pod_qty'] == 0) {
                            return '<span class="badge bg-danger">CLOSED</span>';
                        } else {
                            return '<span class="badge bg-success">OPEN</span>';
                        }
                    }
                },
                {
                    data: 'inspection_number',
                    render: function (data, type, row) {
                        var po_number = row.po_number;
                        if (row['pod_qty'] == 0) {
                            return 'All Items Delivered';
                        } else {
                            return `
                            <div class="text-center">
                              <div class="btn-group">
                                <a href="/admin/inspections/${data}/${po_number}" class="btn btn-sm btn-alt-success " data-bs-toggle="tooltip" title="Inpect Items">
                                  <i class="fa fa-fw fa-magnifying-glass"></i>
                                </a>
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
                targets: 4,
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

