class c{static initDataTables(){jQuery.extend(jQuery.fn.DataTable.ext.classes,{sWrapper:"dataTables_wrapper dt-bootstrap5",sFilterInput:"form-control form-control-sm",sLengthSelect:"form-select form-select-sm"}),jQuery.extend(!0,jQuery.fn.DataTable.defaults,{language:{lengthMenu:"_MENU_",search:"_INPUT_",searchPlaceholder:"Search..",info:"Page <strong>_PAGE_</strong> of <strong>_PAGES_</strong>",paginate:{first:'<i class="fa fa-angle-double-left"></i>',previous:'<i class="fa fa-angle-left"></i>',next:'<i class="fa fa-angle-right"></i>',last:'<i class="fa fa-angle-double-right"></i>'}}}),jQuery.extend(!0,jQuery.fn.DataTable.Buttons.defaults,{dom:{button:{className:"btn btn-sm btn-primary"}}}),jQuery(".js-dataTable-customers").DataTable({ajax:"/admin/customers/all",columns:[{data:"customer_code"},{data:"description"},{data:"contact_no"},{data:"msr"},{data:"created_at",render:function(a,e,t){return moment(a).format("MM-DD-YYYY")}},{data:"status",render:function(a,e,t){return getStatus(t.status)}},{data:"id",render:function(a,e,t){var n=t.customer_code,s=t.description,o=t.address,r=t.contact_person,l=t.contact_no,i=t.position;return`
                                <div class="text-center">
                                    <div class="btn-group">
                                    <button type="button" onclick="update(${a},'${n}','${s}','${o}','${r}','${l}','${i}')" class="btn btn-sm btn-alt-info " data-bs-toggle="tooltip" title="Update Brand">
                                        <i class="fa fa-fw fa-pencil-alt"></i>
                                    </button>
                                    <button type="button" onclick="remove(${a})" class="btn btn-sm btn-alt-warning" data-bs-toggle="tooltip" title="Delete Brand">
                                        <i class="fa fa-fw fa-trash"></i>
                                    </button>
                                    </div> 
                                </div> `}}],pageLength:10,lengthMenu:[[5,10,15,20],[5,10,15,20]],autoWidth:!1,responsive:!0,order:[[1,"desc"]]})}static init(){this.initDataTables()}}One.onLoad(()=>c.init());
