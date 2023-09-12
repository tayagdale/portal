class r{static initDataTables(){jQuery.extend(jQuery.fn.DataTable.ext.classes,{sWrapper:"dataTables_wrapper dt-bootstrap5",sFilterInput:"form-control form-control-sm",sLengthSelect:"form-select form-select-sm"}),jQuery.extend(!0,jQuery.fn.DataTable.defaults,{language:{lengthMenu:"_MENU_",search:"_INPUT_",searchPlaceholder:"Search..",info:"Page <strong>_PAGE_</strong> of <strong>_PAGES_</strong>",paginate:{first:'<i class="fa fa-angle-double-left"></i>',previous:'<i class="fa fa-angle-left"></i>',next:'<i class="fa fa-angle-right"></i>',last:'<i class="fa fa-angle-double-right"></i>'}}}),jQuery.extend(!0,jQuery.fn.DataTable.Buttons.defaults,{dom:{button:{className:"btn btn-sm btn-primary"}}}),jQuery(".js-dataTable-inspection_details").DataTable({ajax:`/admin/inspection_details/${$("#po_number").val()}`,columns:[{data:"item_id"},{data:"brand_name"},{data:"unit_code"},{data:"purchase_order_qty"},{data:"Iqty"},{data:"unit_price"},{data:"total_amount"},{data:"inspection_number",render:function(a,t,e){var n=e.item_id,s=e.brand_name;return e.purchase_order_qty==0?"All items verified":`
                            <div class="text-center">
                            <div class="btn-group">
                              <button onclick="verify_item('${n}','${s}')" class="btn btn-sm btn-alt-success " data-bs-toggle="tooltip" title="Verify Items">
                                <i class="fa fa-fw fa-check"></i>
                              </button>
                            </div> 
                          </div> `}}],columnDefs:[{defaultContent:"-",targets:"_all",orderable:!1},{targets:5,render:$.fn.dataTable.render.number(",",".",2,"P")},{targets:6,render:$.fn.dataTable.render.number(",",".",2,"P")}],bPaginate:!1,bInfo:!1,autoWidth:!1,responsive:!0,ordering:!1,searching:!1}),jQuery(".js-dataTable-inspections").DataTable({ajax:"/admin/inspections/all",columns:[{data:"inspection_date",render:function(a,t,e){return moment(a).format("MM-DD-YYYY")}},{data:"inspection_number"},{data:"po_number"},{data:"supplier"},{data:"warehouse_name"},{data:"warehouse_location"},{data:"total_amount"},{data:"inspection_status",render:function(a,t,e){return getStatus(e.status)}},{data:"inspection_number",render:function(a,t,e){var n=e.po_number;return`
                        <div class="text-center">
                          <div class="btn-group">
                            <a href="/admin/inspections/${a}/${n}" class="btn btn-sm btn-alt-success " data-bs-toggle="tooltip" title="Inpect Items">
                              <i class="fa fa-fw fa-magnifying-glass"></i>
                            </a>
                          </div> 
                        </div> `}}],pageLength:10,lengthMenu:[[5,10,15,20],[5,10,15,20]],autoWidth:!1,responsive:!0,order:[[1,"desc"]],columnDefs:[{defaultContent:"-",targets:"_all",orderable:!1},{targets:4,render:$.fn.dataTable.render.number(",",".",2,"P")}]})}static init(){this.initDataTables()}}One.onLoad(()=>r.init());
