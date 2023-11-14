class r{static initDataTables(){jQuery.extend(jQuery.fn.DataTable.ext.classes,{sWrapper:"dataTables_wrapper dt-bootstrap5",sFilterInput:"form-control form-control-sm",sLengthSelect:"form-select form-select-sm"}),jQuery.extend(!0,jQuery.fn.DataTable.defaults,{language:{lengthMenu:"_MENU_",search:"_INPUT_",searchPlaceholder:"Search..",info:"Page <strong>_PAGE_</strong> of <strong>_PAGES_</strong>",paginate:{first:'<i class="fa fa-angle-double-left"></i>',previous:'<i class="fa fa-angle-left"></i>',next:'<i class="fa fa-angle-right"></i>',last:'<i class="fa fa-angle-double-right"></i>'}}}),jQuery.extend(!0,jQuery.fn.DataTable.Buttons.defaults,{dom:{button:{className:"btn btn-sm btn-primary"}}}),jQuery(".js-dataTable-warehouse").DataTable({ajax:"/admin/warehouse/all",columns:[{data:"warehouse_name"},{data:"warehouse_location"},{data:"created_at",render:function(t,e,a){return moment(t).format("MM-DD-YYYY")}},{data:"status",render:function(t,e,a){return getStatus(a.status)}},{data:"id",render:function(t,e,a){var s=a.warehouse_name,n=a.warehouse_location;return`
                                <div class="text-center">
                                    <div class="btn-group">
                                    <button type="button" onclick="update(${t},'${s}','${n}')" class="btn btn-sm btn-alt-info " data-bs-toggle="tooltip" title="Update Warehouse">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </button>
                                    <button type="button" onclick="remove(${t})" class="btn btn-sm btn-alt-warning" data-bs-toggle="tooltip" title="Delete Warehouse">
                                        <i class="fa fa-fw fa-trash"></i>
                                    </button>
                                    </div> 
                                </div> `}}],pageLength:10,lengthMenu:[[5,10,15,20],[5,10,15,20]],autoWidth:!1,responsive:!0,order:[[1,"desc"]]})}static init(){this.initDataTables()}}One.onLoad(()=>r.init());
