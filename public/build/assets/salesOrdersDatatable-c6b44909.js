class u{static initDataTables(){jQuery.extend(jQuery.fn.DataTable.ext.classes,{sWrapper:"dataTables_wrapper dt-bootstrap5",sFilterInput:"form-control form-control-sm",sLengthSelect:"form-select form-select-sm"}),jQuery.extend(!0,jQuery.fn.DataTable.defaults,{language:{lengthMenu:"_MENU_",search:"_INPUT_",searchPlaceholder:"Search..",info:"Page <strong>_PAGE_</strong> of <strong>_PAGES_</strong>",paginate:{first:'<i class="fa fa-angle-double-left"></i>',previous:'<i class="fa fa-angle-left"></i>',next:'<i class="fa fa-angle-right"></i>',last:'<i class="fa fa-angle-double-right"></i>'}}}),jQuery.extend(!0,jQuery.fn.DataTable.Buttons.defaults,{dom:{button:{className:"btn btn-sm btn-primary"}}}),jQuery(".js-dataTable-sales_order_details").DataTable({ajax:`/admin/sales_order_details/${$("#so_number").val()}`,columns:[{data:"so_number"},{data:"item_id"},{data:"brand_name"},{data:"unit_code"},{data:"lot_no"},{data:"expiration_date"},{data:"qty"},{data:"unit_price"}],columnDefs:[{defaultContent:"-",targets:"_all",orderable:!1},{targets:7,render:$.fn.dataTable.render.number(",",".",2,"P")}],bPaginate:!1,bInfo:!1,autoWidth:!1,responsive:!0,ordering:!1,searching:!1}),jQuery(".js-dataTable-sales_order").DataTable({ajax:"/admin/sales_orders/all",columns:[{data:"sDate",render:function(t,e,a){return moment(t).format("MM-DD-YYYY")}},{data:"so_number"},{data:"os_number"},{data:"customer"},{data:"terms"},{data:"sStatus",render:function(t,e,a){return getStatus(a.sStatus)}},{data:"id",render:function(t,e,a){var n=a.so_number,s=a.os_number,r=a.customer,l=a.terms;return`
                            <div class="text-center">
                              <div class="btn-group">
                                <button type="button"  onclick="updateSO('${n}','${s}','${r}','${l}')" class="btn btn-sm btn-alt-info " data-bs-toggle="tooltip" title="Update">
                                  <i class="fa fa-fw fa-pencil-alt"></i>
                                </button>
                                <a href="/admin/sales_orders/print/${n}"   class="btn btn-sm btn-alt-success " data-bs-toggle="tooltip" title="Print Sales Order">
                                    <i class="fa fa-fw fa-print"></i>
                                </a>
                              </div> 
                            </div> `}}],pageLength:10,lengthMenu:[[5,10,15,20],[5,10,15,20]],autoWidth:!1,responsive:!0,order:[[1,"desc"]],columnDefs:[{defaultContent:"-",targets:"_all",orderable:!1},{targets:3,render:$.fn.dataTable.render.number(",",".",2,"P")}]}),jQuery(".item_table").DataTable({ajax:`/admin/inventory_details/data/${$("#os_number").val()}`,columns:[{data:"lot_no"},{data:"item_brand_name"},{data:"iQty"},{data:null,render:function(t,e,a){return'<input type="text" class="form-control custom-input" placeholder="Enter sale price">'}},{data:"iID",render:function(t,e,a){var n=a.iID,s=a.item_id,r=a.item_brand_name,l=a.item_unit_id,d=a.iQty,i=a.lot_no,o=a.expiration_date;return`
                      <div class="text-center">
                        <div class="btn-group">
                            <button type="button"  onclick="addToSalesOrder(this,'${n}','${s}','${r}','${l}','${d}','${i}','${o}')" class="btn btn-sm btn-alt-info " data-bs-toggle="tooltip" title="Add to Sales Order">
                                <i class="fa fa-fw fa-plus"></i>
                            </button>
                        </div> 
                      </div> `}}],pageLength:10,lengthMenu:[[5,10,15,20],[5,10,15,20]],autoWidth:!1,responsive:!0,order:[[2,"desc"]]})}static init(){this.initDataTables()}}One.onLoad(()=>u.init());
