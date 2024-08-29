class s{static initDataTables(){jQuery.extend(jQuery.fn.DataTable.ext.classes,{sWrapper:"dataTables_wrapper dt-bootstrap5",sFilterInput:"form-control form-control-sm",sLengthSelect:"form-select form-select-sm"}),jQuery.extend(!0,jQuery.fn.DataTable.defaults,{language:{lengthMenu:"_MENU_",search:"_INPUT_",searchPlaceholder:"Search..",info:"Page <strong>_PAGE_</strong> of <strong>_PAGES_</strong>",paginate:{first:'<i class="fa fa-angle-double-left"></i>',previous:'<i class="fa fa-angle-left"></i>',next:'<i class="fa fa-angle-right"></i>',last:'<i class="fa fa-angle-double-right"></i>'}}}),jQuery.extend(!0,jQuery.fn.DataTable.Buttons.defaults,{dom:{button:{className:"btn btn-sm btn-primary"}}}),jQuery(".js-dataTable-reservation_order").DataTable({ajax:`/admin/reservation/details/${$("#reservation_id").val()}`,columns:[{data:"item_id"},{data:"brand_name"},{data:"unit_code"},{data:"qty"},{data:"id",render:function(a,e,t){return t.brand_name,t.qty,`
                      <div class="text-center">
                        <div class="btn-group">
                          <button type="button" onclick="delete_item(${a})" class="btn btn-sm btn-alt-danger " data-bs-toggle="tooltip" title="Remove Item">
                            <i class="fa fa-fw fa-trash-alt"></i>
                          </button>
                        </div> 
                      </div> `}}],columnDefs:[{defaultContent:"-",targets:"_all",orderable:!1}],bPaginate:!1,bInfo:!1,autoWidth:!1,responsive:!0,ordering:!1,searching:!1}),jQuery(".js-dataTable-reservation").DataTable({ajax:"/admin/reservation/all",columns:[{data:"reservation_date",render:function(a,e,t){return moment(a).format("MM-DD-YYYY")}},{data:"customer"},{data:"status",render:function(a,e,t){return getResStatus(a)}},{data:"id",render:function(a,e,t){return t.status==0?"No Actions Available":`
                            <div class="text-center">
                              <div class="btn-group">
                                <button type="submit" onclick="updateRes('${t.id}')" class="btn btn-sm btn-alt-info" data-bs-toggle="tooltip" title="Update">
                                  <i class="fa fa-fw fa-pencil-alt"></i>
                                </button>
                                <button type="submit" onclick="viewDetails('${t.id}')" class="btn btn-sm btn-alt-info" data-bs-toggle="tooltip" title="View Reservation Details">
                                  <i class="fa fa-fw fa-eye"></i>
                                </button>
                                <button type="submit" onclick="addToOrder('${t.id}')" class="btn btn-sm btn-alt-success" data-bs-toggle="tooltip" title="Add to Order">
                                    <i class="fa fa-fw fa-check"></i>
                                </button>
                                <button type="submit" onclick="cancelRes('${t.id}')" class="btn btn-sm btn-alt-danger" data-bs-toggle="tooltip" title="Cancel">
                                    <i class="fa fa-fw fa-times"></i>
                                </button>
                              </div> 
                            </div> `}}],pageLength:10,lengthMenu:[[5,10,15,20],[5,10,15,20]],autoWidth:!1,responsive:!0,order:[[1,"desc"]],columnDefs:[{defaultContent:"-",targets:"_all",orderable:!1}]}),jQuery(".js-dataTable-reservation-details-view").DataTable({columns:[{data:"reservation_id"},{data:"generic_name"},{data:"brand_name"},{data:"qty"},{data:"created_at"}],pageLength:10,lengthMenu:[[5,10,15,20],[5,10,15,20]],autoWidth:!1,responsive:!0,columnDefs:[{defaultContent:"-",targets:"_all"}]})}static init(){this.initDataTables()}}One.onLoad(()=>s.init());
