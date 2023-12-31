<div class="modal fade" id="mdlAddDelivery" tabindex="-1" role="dialog" aria-labelledby="mdlAddDelivery" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Add Delivery</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <form id="frmAddDelivery">
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" id="dr_number" name="dr_number"
                                placeholder="Delivery Number" autofocus>
                            <label for="dr_number">Delivery Number</label>
                            <p class="mb-0" id="dr_numberError"></p>
                        </div>
                        <div class="form-floating mb-4">
                            <select class="form-select" id="so_number" name="so_number"
                                aria-label="Floating label select example">
                            </select>
                            <label for="so_number">Sales Order No.</label>
                        </div>
                    </form>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="frmAddDelivery" class="btn btn-sm btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="mdlDeliveryDetails" tabindex="-1" role="dialog" aria-labelledby="modal-block-select2"
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
                    <div class="form-floating mb-4">
                        <h3>Delivery No. <span id="delivery_no"></span></h3>
                    </div>

                    <table class="table table-bordered table-vcenter js-dataTable-delivery-details">
                        <thead>
                            <tr>
                                <th>Brand Name</th>
                                <th>QTY</th>
                                <th>UoM</th>
                                <th>Lot No.</th>
                                <th>Expiration Date</th>
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
