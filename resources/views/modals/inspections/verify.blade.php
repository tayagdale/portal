<div class="modal fade" id="mdlInspectionVerify" tabindex="-1" role="dialog" aria-labelledby="modal-block-select2"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Item Verification</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <form id="frmVerifyInspection">
                        @csrf
                        <input type="hidden" id="txtItemInspectID_verify" name="inspection_number"
                            value="{{ $inspection_number }}">
                        <input type="hidden" id="txtItemPONo_verify" name="po_number" value="{{ $po_number }}">
                        <input type="hidden" id="txtItemId_verify" name="item_id">
                        <input type="hidden" id="txt_unit_price" name="unit_price">
                        <h3 id="itemNameVerify"></h3>
                        <div class="form-floating mb-4">
                            <input type="number" class="form-control" id="txtItemQty_verify" name="qty"
                                placeholder="Description">
                            <label for="txtItemQty_verify">Quantity Item Delivered</label>
                            <p class="mb-0" id="qtyError"></p>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" id="txtItemLotNo_verify" name="lot_no"
                                placeholder="Description">
                            <label for="txtItemLotNo_verify">Lot No.</label>
                            <p class="mb-0" id="lot_noError"></p>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="date" class="form-control" id="txtItemDelivered_verify" name="delivery_date"
                                placeholder="Description">
                            <label for="txtItemDelivered_verify">Date Delivered</label>
                            <p class="mb-0" id="delivery_dateError"></p>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="date" class="form-control" id="txtItemExp_verify" name="expiration_date"
                                placeholder="Description">
                            <label for="txtItemExp_verify">Expiration Date</label>
                            <p class="mb-0" id="expiration_dateError"></p>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="hidden" value="{{ Auth::user()->id }}" class="form-control" id="inspect_by"
                                name="inspect_by" placeholder="Inspect By">
                        </div>
                    </form>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="frmVerifyInspection" class="btn btn-sm btn-primary">Verify</button>
                </div>
            </div>
        </div>
    </div>
</div>
