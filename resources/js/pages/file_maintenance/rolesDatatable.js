/*
 *  Document   : be_tables_datatables.js
 *  Author     : pixelcave
 *  Description: Custom JS code used in DataTables Page
 */

// DataTables, for more examples you can check out https://www.datatables.net/
class pgRoles {
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

        jQuery('.js-dataTable-roles').DataTable({
            ajax: '/admin/roles/all',
            columns: [
                {
                    data: 'description',
                },
                {
                    data: 'id',
                    render: function (data, type, row) {
                        var old_role_name = row['description'];
                        var role_id = row['id'];

                        if (data == 1 || data == 2 || data == 3) {
                            return `Default Role`
                        }
                        return `
                                <div class="text-center">
                                    <div class="btn-group">
                                    <a type="button" href="/admin/roles/assign/${role_id}"  class="btn btn-sm btn-alt-success " data-bs-toggle="tooltip" title="Assign Permission">
                                        <i class="fa fa-fw fa-user-gear"></i>
                                    </a>
                                    <button type="button" onclick="update(${data},'${old_role_name}')" class="btn btn-sm btn-alt-info " data-bs-toggle="tooltip" title="Update Brand">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
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
            "order": [[1, "desc"]],
        });


        jQuery('.js-dataTable-assign').DataTable({
            ajax: {
                url: `/admin/permissions/get_current/${$('#role_id').val()}`
            },
            columns: [
                {
                    data: 'permission_name',
                },
                {
                    data: 'id',
                    render: function (data, type, row) {
                        return `
                    <div class="text-center">
                      <div class="btn-group">
                        <button  type="button" onclick="unassignPermission(${data})" class="btn btn-sm btn-alt-warning" data-bs-toggle="tooltip" title="Deactivate Role">
                          <i class="fa fa-fw fa-ban"></i>
                        </button>
                      </div>
                    </div>`


                    }
                },
            ],
            pageLength: 10,
            lengthMenu: [[5, 10, 15, 20], [5, 10, 15, 20]],
            autoWidth: false,
            buttons: [
                'reload',
                'add'
            ],
            dom: "<'row'<'col-sm-12'<'text-center  py-2 mb-2'B>>>" +
                "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
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
One.onLoad(() => pgRoles.init());

