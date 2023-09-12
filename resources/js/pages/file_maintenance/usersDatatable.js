/*
 *  Document   : be_tables_datatables.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in DataTables Page
 */

// DataTables, for more examples you can check out https://www.datatables.net/
class pgUsers {
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

        jQuery('.js-dataTable-users').DataTable({
            ajax: '/admin/users/all',
            columns: [
                {
                    data: 'name',
                },
                {
                    data: 'email',
                },
                {
                    data: 'username',
                },
                {
                    data: 'role',
                    render: function (data, type, row) {
                        if (data == 1) {
                            return 'Admin'
                        } else if(data == 2) {
                            return 'Purchasing'
                        } else {
                            return 'Sales'
                        }
                    }
                },
                {
                    data: 'created_at',
                },
                // {
                //     data: 'id',
                //     render: function (data, type, row) {
                //         var currBrandName = row['name'];
                //         return `
                //                 <div class="text-center">
                //                     <div class="btn-group">
                //                     <button type="button" onclick="update(${data},'${currBrandName}')" class="btn btn-sm btn-alt-info " data-bs-toggle="tooltip" title="Update Brand">
                //                         <i class="fa fa-fw fa-pencil-alt"></i>
                //                     </button>
                //                     <button type="button" onclick="remove(${data})" class="btn btn-sm btn-alt-warning" data-bs-toggle="tooltip" title="Delete Brand">
                //                         <i class="fa fa-fw fa-trash"></i>
                //                     </button>
                //                     </div> 
                //                 </div> `
                //     }
                // },
            ],
            pageLength: 10,
            lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
            autoWidth: false,
            responsive: true,
            "order": [[1, "desc"]],
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
One.onLoad(() => pgUsers.init());

