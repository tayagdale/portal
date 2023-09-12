class l{static initDataTables(){jQuery.extend(jQuery.fn.DataTable.ext.classes,{sWrapper:"dataTables_wrapper dt-bootstrap5",sFilterInput:"form-control form-control-sm",sLengthSelect:"form-select form-select-sm"}),jQuery.extend(!0,jQuery.fn.DataTable.defaults,{language:{lengthMenu:"_MENU_",search:"_INPUT_",searchPlaceholder:"Search..",info:"Page <strong>_PAGE_</strong> of <strong>_PAGES_</strong>",paginate:{first:'<i class="fa fa-angle-double-left"></i>',previous:'<i class="fa fa-angle-left"></i>',next:'<i class="fa fa-angle-right"></i>',last:'<i class="fa fa-angle-double-right"></i>'}}}),jQuery.extend(!0,jQuery.fn.DataTable.Buttons.defaults,{dom:{button:{className:"btn btn-sm btn-primary"}}}),jQuery(".js-dataTable-roles").DataTable({ajax:"/admin/roles/all",columns:[{data:"description"},{data:"id",render:function(t,e,a){var s=a.description,n=a.id;return t==1||t==2||t==3?"Default Role":`
                                <div class="text-center">
                                    <div class="btn-group">
                                    <a type="button" href="/admin/roles/assign/${n}"  class="btn btn-sm btn-alt-success " data-bs-toggle="tooltip" title="Assign Permission">
                                        <i class="fa fa-fw fa-user-gear"></i>
                                    </a>
                                    <button type="button" onclick="update(${t},'${s}')" class="btn btn-sm btn-alt-info " data-bs-toggle="tooltip" title="Update Brand">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </button>
                                    <button type="button" onclick="remove(${t})" class="btn btn-sm btn-alt-warning" data-bs-toggle="tooltip" title="Delete Brand">
                                        <i class="fa fa-fw fa-trash"></i>
                                    </button>
                                    </div> 
                                </div> `}}],pageLength:10,lengthMenu:[[5,10,15,20],[5,10,15,20]],autoWidth:!1,responsive:!0,order:[[1,"desc"]]}),jQuery(".js-dataTable-assign").DataTable({ajax:{url:`/admin/permissions/get_current/${$("#role_id").val()}`},columns:[{data:"permission_name"},{data:"id",render:function(t,e,a){return`
                    <div class="text-center">
                      <div class="btn-group">
                        <button  type="button" onclick="unassignPermission(${t})" class="btn btn-sm btn-alt-warning" data-bs-toggle="tooltip" title="Deactivate Role">
                          <i class="fa fa-fw fa-ban"></i>
                        </button>
                      </div>
                    </div>`}}],pageLength:10,lengthMenu:[[5,10,15,20],[5,10,15,20]],autoWidth:!1,buttons:["reload","add"],dom:"<'row'<'col-sm-12'<'text-center  py-2 mb-2'B>>><'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>><'row'<'col-sm-12'tr>><'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"})}static init(){this.initDataTables()}}One.onLoad(()=>l.init());
