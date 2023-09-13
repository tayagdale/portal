<div class="modal fade" id="mdlTax" tabindex="-1" role="dialog" aria-labelledby="mdlTax" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Update Effectivity Date</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <form id="frmTax">
                        @csrf
                        <div class="form-floating mb-4">
                            <input type="hidden" class="form-control" id="tax_id" name="tax_id">
                            <input type="date" class="form-control" id="effective_from" name="effective_from"
                                placeholder="Effective From">
                            <label for="effective_from">Effective From</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="date" class="form-control" id="effective_to" name="effective_to"
                                placeholder="Effective To">
                            <label for="effective_to">Effective To</label>
                        </div>
                    </form>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="frmTax" class="btn btn-sm btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
