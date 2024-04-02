/*
 *  Document   : be_tables_datatables.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in DataTables Page
 */

// DataTables, for more examples you can check out https://www.datatables.net/
class pgItems {
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

        jQuery('.js-dataTable-items').DataTable({
            ajax: '/admin/items/all',
            columns: [
                {
                    data: 'generic_name',
                },
                {
                    data: 'brand_name',
                },
                {
                    data: 'category',
                },
                {
                    data: 'created_at',
                    render: function (data, type, row) {
                        return moment(data).format("MM-DD-YYYY");
                    }
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
                        var old_brand_name = row['brand_name'];
                        var old_generic_name = row['generic_name'];
                        var old_category = row['category_id'];
                        var uom_1 = row['uom_1'];
                        var qty_1 = row['qty_1'];
                        var uom_2 = row['uom_2'];
                        var qty_2 = row['qty_2'];
                        return `
                                <div class="text-center">
                                    <div class="btn-group">
                                    <button type="button" onclick="update(${data},'${old_brand_name}','${old_generic_name}','${old_category}')" class="btn btn-sm btn-alt-info " data-bs-toggle="tooltip" title="Update Brand">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </button>
                                    <button type="button" onclick="conversion(${data})" class="btn btn-sm btn-alt-success " data-bs-toggle="tooltip" title="Conversion">
                                        <i class="fa fa-fw fa-refresh"></i>
                                    </button>
                                    <button type="button" onclick="remove(${data})" class="btn btn-sm btn-alt-warning" data-bs-toggle="tooltip" title="Delete Brand">
                                        <i class="fa fa-fw fa-trash"></i>
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
            "order": [[1, "asc"]],
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
One.onLoad(() => pgItems.init());

