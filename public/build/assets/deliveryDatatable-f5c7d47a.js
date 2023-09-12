class s{static initDataTables(){jQuery.extend(jQuery.fn.DataTable.ext.classes,{sWrapper:"dataTables_wrapper dt-bootstrap5",sFilterInput:"form-control form-control-sm",sLengthSelect:"form-select form-select-sm"}),jQuery.extend(!0,jQuery.fn.DataTable.defaults,{language:{lengthMenu:"_MENU_",search:"_INPUT_",searchPlaceholder:"Search..",info:"Page <strong>_PAGE_</strong> of <strong>_PAGES_</strong>",paginate:{first:'<i class="fa fa-angle-double-left"></i>',previous:'<i class="fa fa-angle-left"></i>',next:'<i class="fa fa-angle-right"></i>',last:'<i class="fa fa-angle-double-right"></i>'}}}),jQuery.extend(!0,jQuery.fn.DataTable.Buttons.defaults,{dom:{button:{className:"btn btn-sm btn-primary"}}}),jQuery(".js-dataTable-delivery").DataTable({ajax:"/admin/delivery/all",columns:[{data:"sDate",render:function(a,e,t){return moment(a).format("MM-DD-YYYY")}},{data:"dr_number"},{data:"so_number"},{data:"os_number"},{data:"customer"},{data:"terms"},{data:"sStatus",render:function(a,e,t){return getStatus(t.sStatus)}},{data:"dId",render:function(a,e,t){var n=t.dr_number;return`
                            <div class="text-center">
                              <div class="btn-group">
                                <button type="submit" onclick="viewDeliveryDetails('${n}')" class="btn btn-sm btn-alt-info" data-bs-toggle="tooltip" title="View">
                                <i class="fa fa-fw fa-magnifying-glass"></i>
                              </button>
                                <a href="/admin/delivery/print/${n} " class="btn btn-sm btn-alt-success" data-bs-toggle="tooltip" title="Print">
                                <i class="fa fa-fw fa-print"></i>
                                </a>
                              </button>
                              </div> 
                            </div> `}}],pageLength:10,lengthMenu:[[5,10,15,20],[5,10,15,20]],autoWidth:!1,responsive:!0,order:[[1,"desc"]],columnDefs:[{defaultContent:"-",targets:"_all",orderable:!1}]}),jQuery(".js-dataTable-delivery-details").DataTable({columns:[{data:"brand_name"},{data:"qty"},{data:"unit_code"},{data:"lot_no"},{data:"expiration_date"}],pageLength:10,lengthMenu:[[5,10,15,20],[5,10,15,20]],autoWidth:!1,responsive:!0,order:[[1,"desc"]],columnDefs:[{defaultContent:"-",targets:"_all",orderable:!1}]})}static init(){this.initDataTables()}}One.onLoad(()=>s.init());
