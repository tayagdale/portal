<div class="modal fade" id="mdlAddOSItem" tabindex="-1" role="dialog" aria-labelledby="modal-block-select2"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
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
                    <form id="frmAddOSItem">
                        <div class="form-floating mb-4">
                            <div class="row">
                                <div class="col-md-10 os_add_item">
                                    <select class="js-select2 form-select" style="width: 100% !important" id="item_id"
                                        name="item_id" data-container="#mdlAddOSItem" data-placeholder="Select Item">
                                        <option value=""></option>
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <a class="btn btn-sm btn-outline-info" style="margin-top: 2px;"
                                        data-bs-toggle="tooltip" onclick="create_item()" title="Add New Item"><i
                                            class="fa fa-plus"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="form-floating mb-4 os_add_item">
                            <select class="js-select2 form-select" id="unit_measure" name="unit_measure" data-container="#mdlAddOSItem" data-placeholder="Select UOM">
                                <option value=""></option>
                            </select>
                        </div> -->
                        <div class="form-floating mb-4">
                            <select class="form-select" id="unit_id" name="unit_id" data-placeholder="Select Unit">
                                <option value=""></option>
                            </select>
                            <label for="unit_id">Unit</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="number" class="form-control" id="qty" name="qty"
                                placeholder="Quantity">
                            <input type="hidden" class="form-control os_number_add" id="os_number" name="os_number">
                            <label for="qty">Quantity</label>
                        </div>
                    </form>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="frmAddOSItem" class="btn btn-sm btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="mdlUpdateOSItem" tabindex="-1" role="dialog" aria-labelledby="modal-block-select2"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Update Item</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <form id="frmUpdateOSItem">
                        <input type="hidden" class="form-control" id="os_item_details_id" name="os_item_details_id">
                        <div class="form-floating mb-4 os_add_item">
                            <h3 id="item_name_update"></h3>
                        </div>
                        <!-- <div class="form-floating mb-4 os_add_item">
                            <select class="js-select2 form-select" id="unit_measure_update" name="unit_measure_update" data-container="#mdlUpdateOSItem" data-placeholder="Select UOM">
                                <option value=""></option>
                            </select>
                        </div> -->
                        <div class="form-floating mb-4">
                            <input type="number" class="form-control" id="qty_update" name="qty"
                                placeholder="Quantity">
                            <input type="hidden" class="form-control" id="total_amount_update" name="total_amount">
                            <label for="qty">Quantity</label>
                        </div>
                    </form>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="frmUpdateOSItem" class="btn btn-sm btn-primary">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="mdlAddOSNumber" tabindex="-1" role="dialog" aria-labelledby="modal-block-select2"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Create Order Slip</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <form id="frmAddOSNumber" action="{{ route('order_slip_add.create') }}">
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" id="os_number"
                                name="os_number" placeholder="PO Number" autofocus required>
                            <label for="os_number">OS Number</label>
                            <p class="mb-0" id="os_numberError"></p>
                        </div>
                    </form>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="frmAddOSNumber" class="btn btn-sm btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>
</div>
