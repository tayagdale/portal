<div class="modal fade" id="mdlAddReservation" tabindex="-1" role="dialog" aria-labelledby="modal-block-select2"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Add Reservation</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <form id="frmAddReservation">
                        <div class="form-floating mb-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="mb-2">Select Customer</label>
                                    <select class="custom-js-select2 form-select" style="width: 100% !important" id="customer_id"
                                        name="customer_id" data-container="#frmAddReservation" data-placeholder="Select Item">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="frmAddReservation" class="btn btn-sm btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mdlAddResItem" tabindex="-1" role="dialog" aria-labelledby="modal-block-select2"
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
                    <form id="frmAddResItem">
                        <input type="hidden" name="reservation_id" value="{{ $reservation_id }}" id="reservation_item_id">
                        <div class="form-floating mb-4">
                            <div class="row">
                                <div class="col-md-12 os_add_item">
                                    <select class="custom-js-select2 form-select" style="width: 100% !important" id="item_id"
                                        name="item_id" data-container="#mdlAddResItem" data-placeholder="Select Item">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                        </div>
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
                    <button type="submit" form="frmAddResItem" class="btn btn-sm btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>
</div>
