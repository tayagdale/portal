class s{static initDataTables(){jQuery.extend(jQuery.fn.DataTable.ext.classes,{sWrapper:"dataTables_wrapper dt-bootstrap5",sFilterInput:"form-control form-control-sm",sLengthSelect:"form-select form-select-sm"}),jQuery.extend(!0,jQuery.fn.DataTable.defaults,{language:{lengthMenu:"_MENU_",search:"_INPUT_",searchPlaceholder:"Search..",info:"Page <strong>_PAGE_</strong> of <strong>_PAGES_</strong>",paginate:{first:'<i class="fa fa-angle-double-left"></i>',previous:'<i class="fa fa-angle-left"></i>',next:'<i class="fa fa-angle-right"></i>',last:'<i class="fa fa-angle-double-right"></i>'}}}),jQuery.extend(!0,jQuery.fn.DataTable.Buttons.defaults,{dom:{button:{className:"btn btn-sm btn-primary"}}}),jQuery(".js-dataTable-inventory_status").DataTable({ajax:"/admin/inventory_status/all",columns:[{data:"status_name"},{data:"status_value"},{data:"id",render:function(t,l,a){var e=a.status_value;return`
                                <div class="text-center">
                                    <div class="btn-group">
                                    <button type="button" onclick="update(${t},'${e}')" class="btn btn-sm btn-alt-info " data-bs-toggle="tooltip" title="Update Brand">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </button>
                                    </div> 
                                </div> `}}],pageLength:10,lengthMenu:[[5,10,15,20],[5,10,15,20]],autoWidth:!1,responsive:!0,order:[[1,"desc"]]})}static init(){this.initDataTables()}}One.onLoad(()=>s.init());
