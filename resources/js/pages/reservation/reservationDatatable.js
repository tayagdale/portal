/*
 *  Document   : be_tables_datatables.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in DataTables Page
 */

// DataTables, for more examples you can check out https://www.datatables.net/
class pgReservation {
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


        jQuery('.js-dataTable-reservation_order').DataTable({
            ajax: `/admin/reservation/details/${$('#reservation_id').val()}`,
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
                    data: 'qty',
                },
                {
                    data: 'id',
                    render: function (data, type, row) {
                        var item_name = row['brand_name'];
                        var item_qty = row['qty'];
                        return `
                      <div class="text-center">
                        <div class="btn-group">
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
            }
            ],
            // pageLength: 10,
            "bPaginate": false,
            "bInfo": false,
            autoWidth: false,
            responsive: true,
            "ordering": false,
            searching: false
        });


        jQuery('.js-dataTable-reservation').DataTable({
            ajax: '/admin/reservation/all',
            columns: [
                {
                    data: 'reservation_date',
                    render: function (data, type, row) {
                        return moment(data).format("MM-DD-YYYY");
                    }
                },
                {
                    data: 'customer',
                },
                {
                    data: 'status',
                    render: function (data, type, row) {
                        return getResStatus(data);
                    }
                },
                {
                    data: 'id',
                    render: function (data, type, row) {
                        if (row.status == 0) {
                            return `No Actions Available`
                        } else {
                            return `
                            <div class="text-center">
                              <div class="btn-group">
                                <button type="submit" onclick="updateRes('${row.id}')" class="btn btn-sm btn-alt-info" data-bs-toggle="tooltip" title="Update">
                                  <i class="fa fa-fw fa-pencil-alt"></i>
                                </button>
                                <button type="submit" onclick="viewDetails('${row.id}')" class="btn btn-sm btn-alt-info" data-bs-toggle="tooltip" title="View Reservation Details">
                                  <i class="fa fa-fw fa-eye"></i>
                                </button>
                                <button type="submit" onclick="addToOrder('${row.id}')" class="btn btn-sm btn-alt-success" data-bs-toggle="tooltip" title="Add to Order">
                                    <i class="fa fa-fw fa-check"></i>
                                </button>
                                <button type="submit" onclick="cancelRes('${row.id}')" class="btn btn-sm btn-alt-danger" data-bs-toggle="tooltip" title="Cancel">
                                    <i class="fa fa-fw fa-times"></i>
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
            ]
        });


        jQuery('.js-dataTable-reservation-details-view').DataTable({
            columns: [
                {
                    data: 'reservation_id',
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
                    data: 'created_at',
                }
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
One.onLoad(() => pgReservation.init());

