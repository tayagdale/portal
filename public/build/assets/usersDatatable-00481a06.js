class l{static initDataTables(){jQuery.extend(jQuery.fn.DataTable.ext.classes,{sWrapper:"dataTables_wrapper dt-bootstrap5",sFilterInput:"form-control form-control-sm",sLengthSelect:"form-select form-select-sm"}),jQuery.extend(!0,jQuery.fn.DataTable.defaults,{language:{lengthMenu:"_MENU_",search:"_INPUT_",searchPlaceholder:"Search..",info:"Page <strong>_PAGE_</strong> of <strong>_PAGES_</strong>",paginate:{first:'<i class="fa fa-angle-double-left"></i>',previous:'<i class="fa fa-angle-left"></i>',next:'<i class="fa fa-angle-right"></i>',last:'<i class="fa fa-angle-double-right"></i>'}}}),jQuery.extend(!0,jQuery.fn.DataTable.Buttons.defaults,{dom:{button:{className:"btn btn-sm btn-primary"}}}),jQuery(".js-dataTable-users").DataTable({ajax:"/admin/users/all",columns:[{data:"name"},{data:"email"},{data:"username"},{data:"description"},{data:"created_at"},{data:"id",render:function(e,o,a){var t=a.name,s=a.email,r=a.username,n=a.role_id;return`
                                <div class="text-center">
                                    <div class="btn-group">
                                    <button type="button" onclick="update(${e},'${t}','${s}','${r}','${n}')" class="btn btn-sm btn-alt-info " data-bs-toggle="tooltip" title="Update User">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </button>
                                    </div> 
                                </div> `}}],pageLength:10,lengthMenu:[[5,10,15,20],[5,10,15,20]],autoWidth:!1,responsive:!0,order:[[1,"desc"]]})}static init(){this.initDataTables()}}One.onLoad(()=>l.init());