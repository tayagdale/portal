class l{static initDataTables(){jQuery.extend(jQuery.fn.DataTable.ext.classes,{sWrapper:"dataTables_wrapper dt-bootstrap5",sFilterInput:"form-control form-control-sm",sLengthSelect:"form-select form-select-sm"}),jQuery.extend(!0,jQuery.fn.DataTable.defaults,{language:{lengthMenu:"_MENU_",search:"_INPUT_",searchPlaceholder:"Search..",info:"Page <strong>_PAGE_</strong> of <strong>_PAGES_</strong>",paginate:{first:'<i class="fa fa-angle-double-left"></i>',previous:'<i class="fa fa-angle-left"></i>',next:'<i class="fa fa-angle-right"></i>',last:'<i class="fa fa-angle-double-right"></i>'}}}),jQuery.extend(!0,jQuery.fn.DataTable.Buttons.defaults,{dom:{button:{className:"btn btn-sm btn-primary"}}}),jQuery(".js-dataTable-order_slip_details").DataTable({ajax:`/admin/order_slip_details/${$("#os_number").val()}`,columns:[{data:"os_number"},{data:"item_id"},{data:"brand_name"},{data:"unit_code"},{data:"qty"},{data:"id",render:function(a,e,t){var n=t.brand_name,s=t.qty;return`
                      <div class="text-center">
                        <div class="btn-group">
                          <button type="button" onclick="update_item(${a}, '${n}',  ${s})" class="btn btn-sm btn-alt-info " data-bs-toggle="tooltip" title="Update Item">
                            <i class="fa fa-fw fa-pencil-alt"></i>
                          </button>
                          <button type="button" onclick="delete_item(${a})" class="btn btn-sm btn-alt-danger " data-bs-toggle="tooltip" title="Remove Item">
                            <i class="fa fa-fw fa-trash-alt"></i>
                          </button>
                        </div> 
                      </div> `}}],columnDefs:[{defaultContent:"-",targets:"_all",orderable:!1}],bPaginate:!1,bInfo:!1,autoWidth:!1,responsive:!0,ordering:!1,searching:!1}),jQuery(".js-dataTable-os").DataTable({ajax:"/admin/order_slips/all",columns:[{data:"date",render:function(a,e,t){return moment(a).format("MM-DD-YYYY")}},{data:"os_number"},{data:"customer"},{data:"status",render:function(a,e,t){return getStatus(t.status)}},{data:"id",render:function(a,e,t){return t.status==2?"No Actions Available":`
                            <div class="text-center">
                              <div class="btn-group">
                                <button type="submit" onclick="updateOS('${t.os_number}')" class="btn btn-sm btn-alt-info" data-bs-toggle="tooltip" title="Update">
                                  <i class="fa fa-fw fa-pencil-alt"></i>
                                </button>
                              </div> 
                            </div> `}}],pageLength:10,lengthMenu:[[5,10,15,20],[5,10,15,20]],autoWidth:!1,responsive:!0,order:[[1,"desc"]],columnDefs:[{defaultContent:"-",targets:"_all",orderable:!1},{targets:3,render:$.fn.dataTable.render.number(",",".",2,"P")}]})}static init(){this.initDataTables()}}One.onLoad(()=>l.init());
