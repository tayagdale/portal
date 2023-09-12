<div class="modal fade" id="mdlAddSalesOrder" tabindex="-1" role="dialog" aria-labelledby="mdlAddItem" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Add Sales Order</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <form id="frmAddSO">
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" id="so_number" name="so_number"
                                placeholder="Sales Order Number" autofocus>
                            <label for="so_number">Sales Order Number</label>
                            <p class="mb-0" id="so_numberError"></p>
                        </div>
                        <div class="form-floating mb-4">
                            <select class="form-select" id="os_number" name="os_number"
                                aria-label="Floating label select example">
                            </select>
                            <label for="os_number">Order Slip No.</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="date" class="form-control" id="date" name="date"
                                placeholder="Description">
                            <label for="date">Date</label>
                        </div>
                    </form>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="frmAddSO" class="btn btn-sm btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="mdlAddSOItems" tabindex="-1" role="dialog" aria-labelledby="modal-block-select2"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Add Item</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <form id="frmAddSOItem">
                        <div class="form-floating mb-4">
                            <h3>Total Quantity Needed: <span id="total_os_qty"></span></h3>
                        </div>
                    </form>

                    <table class="table table-bordered table-vcenter item_table">
                        <thead>
                            <tr>
                                <th>Lot No</th>
                                <th>Brand Name</th>
                                <th>QTY</th>
                                <th>Sale Price</th>
                                <th style="width:10%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- <tr>
                        <td>12344</td>
                        <td>Pencil</td>
                        <td>CM</td>
                        <td>10</td>
                        <td>P15.00</td>
                        <td>P150.00</td>
                        <td>
                          <a href="#" class="text-info mx-2"><i class="fa fa-pencil"></i></a>
                          <a href="#" class="text-danger mx-2"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr> -->
                        </tbody>
                    </table>
                </div>
                <!-- <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="frmAddSOItem" class="btn btn-sm btn-primary">Add</button>
                </div> -->
            </div>
        </div>
    </div>
</div>
