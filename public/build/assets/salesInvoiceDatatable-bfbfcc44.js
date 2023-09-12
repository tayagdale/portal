class n{static initDataTables(){jQuery.extend(jQuery.fn.DataTable.ext.classes,{sWrapper:"dataTables_wrapper dt-bootstrap5",sFilterInput:"form-control form-control-sm",sLengthSelect:"form-select form-select-sm"}),jQuery.extend(!0,jQuery.fn.DataTable.defaults,{language:{lengthMenu:"_MENU_",search:"_INPUT_",searchPlaceholder:"Search..",info:"Page <strong>_PAGE_</strong> of <strong>_PAGES_</strong>",paginate:{first:'<i class="fa fa-angle-double-left"></i>',previous:'<i class="fa fa-angle-left"></i>',next:'<i class="fa fa-angle-right"></i>',last:'<i class="fa fa-angle-double-right"></i>'}}}),jQuery.extend(!0,jQuery.fn.DataTable.Buttons.defaults,{dom:{button:{className:"btn btn-sm btn-primary"}}}),jQuery(".js-dataTable-sales_invoice").DataTable({ajax:"/admin/sales_invoice/all",columns:[{data:"sDate",render:function(t,e,a){return moment(t).format("MM-DD-YYYY")}},{data:"si_number"},{data:"dr_number"},{data:"so_number"},{data:"os_number"},{data:"customer"},{data:"terms"},{data:"sStatus",render:function(t,e,a){return getStatus(a.sStatus)}},{data:"sId",render:function(t,e,a){var s=a.si_number;return`
                            <div class="text-center">
                              <div class="btn-group">
                                <button type="submit" onclick="viewSalesInvoiceDetails('${s}')" class="btn btn-sm btn-alt-info" data-bs-toggle="tooltip" title="View">
                                <i class="fa fa-fw fa-magnifying-glass"></i>
                              </button>
                                <a href="/admin/sales_invoice/print/${s} " class="btn btn-sm btn-alt-success" data-bs-toggle="tooltip" title="Print">
                                <i class="fa fa-fw fa-print"></i>
                                </a>
                              </button>
                              </div> 
                            </div> `}}],pageLength:10,lengthMenu:[[5,10,15,20],[5,10,15,20]],autoWidth:!1,responsive:!0,order:[[1,"desc"]],columnDefs:[{defaultContent:"-",targets:"_all",orderable:!1}]}),jQuery(".js-dataTable-sales-invoice-details").DataTable({columns:[{data:"brand_name"},{data:"qty"},{data:"unit_code"},{data:"lot_no"},{data:"expiration_date"},{data:"unit_price"}],pageLength:10,lengthMenu:[[5,10,15,20],[5,10,15,20]],autoWidth:!1,responsive:!0,order:[[1,"desc"]],columnDefs:[{defaultContent:"-",targets:"_all",orderable:!1},{targets:5,render:$.fn.dataTable.render.number(",",".",2,"P")}]})}static init(){this.initDataTables()}}One.onLoad(()=>n.init());
