<div class="modal fade" id="mdlPermission" tabindex="-1" role="dialog" aria-labelledby="mdlPermission" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Add Permission</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <form id="frmPermission">
                        @csrf
                        <div class="form-floating mb-4">
                            <input type="hidden" class="form-control" id="permission_id" name="permission_id">
                            <input type="text" class="form-control" id="permission_name" name="permission_name"
                                placeholder="Permission Name" autofocus>
                            <label for="permission_name">Permission Name</label>
                            <p class="mb-0" id="permission_nameError"></p>
                        </div>
                    </form>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="frmPermission" class="btn btn-sm btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
