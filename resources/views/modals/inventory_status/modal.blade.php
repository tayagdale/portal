<div class="modal fade" id="mdlInventoryStatus" tabindex="-1" role="dialog" aria-labelledby="mdlInventoryStatus"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Add Inventory Status</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <form id="frmInventoryStatus">
                        @csrf
                        <div class="form-floating mb-4">
                            <input type="hidden" class="form-control" id="status_id" name="status_id">
                            <input type="text" class="form-control" id="status_value" name="status_value"
                                placeholder="Status Value" autofocus>
                            <label for="status_value">Status Value</label>
                            <p class="mb-0" id="status_valueError"></p>
                        </div>
                    </form>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="frmInventoryStatus" class="btn btn-sm btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
