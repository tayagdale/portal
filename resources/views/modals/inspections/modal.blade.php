<div class="modal fade" id="mdlAddInspection" tabindex="-1" role="dialog" aria-labelledby="modal-block-select2"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Add Inspection</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <form id="frmAddInspection">
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" id="inspection_number" name="inspection_number"
                                placeholder="Inspection Number" autofocus>
                            <label for="inspection_number">Inspection Number</label>
                            <p class="mb-0" id="inspection_numberError"></p>
                        </div>
                        <div class="form-floating mb-4">
                            <select class="form-select js-select2" id="po_number" name="po_number"
                                aria-label="Floating label select example">
                            </select>
                            <label for="po_number">Purchase Order No</label>
                            <p class="mb-0" id="po_numberError"></p>
                        </div>
                        <div class="form-floating mb-4">
                            <select class="form-select js-select2" id="warehouse_id" name="warehouse_id"
                                aria-label="Floating label select example">
                            </select>
                            <label for="warehouse_id">Warehouse</label>
                            <p class="mb-0" id="warehouse_idError"></p>
                        </div>
                    </form>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="frmAddInspection" class="btn btn-sm btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>
</div>
