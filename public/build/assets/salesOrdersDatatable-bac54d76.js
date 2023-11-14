class u{static initDataTables(){jQuery.extend(jQuery.fn.DataTable.ext.classes,{sWrapper:"dataTables_wrapper dt-bootstrap5",sFilterInput:"form-control form-control-sm",sLengthSelect:"form-select form-select-sm"}),jQuery.extend(!0,jQuery.fn.DataTable.defaults,{language:{lengthMenu:"_MENU_",search:"_INPUT_",searchPlaceholder:"Search..",info:"Page <strong>_PAGE_</strong> of <strong>_PAGES_</strong>",paginate:{first:'<i class="fa fa-angle-double-left"></i>',previous:'<i class="fa fa-angle-left"></i>',next:'<i class="fa fa-angle-right"></i>',last:'<i class="fa fa-angle-double-right"></i>'}}}),jQuery.extend(!0,jQuery.fn.DataTable.Buttons.defaults,{dom:{button:{className:"btn btn-sm btn-primary"}}}),jQuery(".js-dataTable-sales_order_details").DataTable({ajax:`/admin/sales_order_details/${$("#so_number").val()}`,columns:[{data:"so_number"},{data:"item_id"},{data:"brand_name"},{data:"unit_code"},{data:"lot_no"},{data:"expiration_date"},{data:"qty"},{data:"unit_price"},{data:"sodID",render:function(a,e,t){return`
                      <div class="text-center">
                        <div class="btn-group">
                          <button type="button" onclick="delete_item(${a})" class="btn btn-sm btn-alt-danger " data-bs-toggle="tooltip" title="Remove Item">
                            <i class="fa fa-fw fa-trash-alt"></i>
                          </button>
                        </div> 
                      </div> `}}],columnDefs:[{defaultContent:"-",targets:"_all",orderable:!1},{targets:7,render:$.fn.dataTable.render.number(",",".",2,"P")}],bPaginate:!1,bInfo:!1,autoWidth:!1,responsive:!0,ordering:!1,searching:!1}),jQuery(".js-dataTable-sales_order").DataTable({ajax:"/admin/sales_orders/all",columns:[{data:"sDate",render:function(a,e,t){return moment(a).format("MM-DD-YYYY")}},{data:"so_number"},{data:"os_number"},{data:"customer"},{data:"terms"},{data:"sStatus",render:function(a,e,t){return getStatus(t.sStatus)}},{data:"id",render:function(a,e,t){var s=t.so_number,n=t.os_number,r=t.customer,l=t.terms;return t.sStatus==2?`
                            <div class="text-center">
                              <div class="btn-group">
                                <a href="/admin/sales_orders/print/${s}"   class="btn btn-sm btn-alt-success " data-bs-toggle="tooltip" title="Print Sales Order">
                                    <i class="fa fa-fw fa-print"></i>
                                </a>
                              </div> 
                            </div> `:`
                            <div class="text-center">
                              <div class="btn-group">
                                <button type="button"  onclick="updateSO('${s}','${n}','${r}','${l}')" class="btn btn-sm btn-alt-info " data-bs-toggle="tooltip" title="Update">
                                  <i class="fa fa-fw fa-pencil-alt"></i>
                                </button>
                                <a href="/admin/sales_orders/print/${s}"   class="btn btn-sm btn-alt-success " data-bs-toggle="tooltip" title="Print Sales Order">
                                    <i class="fa fa-fw fa-print"></i>
                                </a>
                              </div> 
                            </div> `}}],pageLength:10,lengthMenu:[[5,10,15,20],[5,10,15,20]],autoWidth:!1,responsive:!0,order:[[1,"desc"]],columnDefs:[{defaultContent:"-",targets:"_all",orderable:!1},{targets:3,render:$.fn.dataTable.render.number(",",".",2,"P")}]}),jQuery(".item_table").DataTable({ajax:`/admin/inventory_details/data/${$("#os_number").val()}`,columns:[{data:"lot_no"},{data:"item_brand_name"},{data:"iQty"},{data:null,render:function(a,e,t){return'<input type="text" class="form-control qty_to_add" placeholder="Enter qty to add">'}},{data:null,render:function(a,e,t){return'<input type="text" class="form-control custom-input" placeholder="Enter sale price">'}},{data:"iID",render:function(a,e,t){var s=t.iID,n=t.item_id,r=t.item_brand_name,l=t.item_unit_id,d=t.iQty,i=t.lot_no,o=t.expiration_date;return`
                      <div class="text-center">
                        <div class="btn-group">
                            <button type="button"  onclick="addToSalesOrder(this,'${s}','${n}','${r}','${l}','${d}','${i}','${o}')" class="btn btn-sm btn-alt-info " data-bs-toggle="tooltip" title="Add to Sales Order">
                                <i class="fa fa-fw fa-plus"></i>
                            </button>
                        </div> 
                      </div> `}}],pageLength:10,lengthMenu:[[5,10,15,20],[5,10,15,20]],autoWidth:!1,responsive:!0,order:[[2,"desc"]]})}static init(){this.initDataTables()}}One.onLoad(()=>u.init());
