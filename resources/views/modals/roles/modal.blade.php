<div class="modal fade" id="mdlRole" tabindex="-1" role="dialog" aria-labelledby="mdlRole" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Add Role</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <form id="frmRole">
                        @csrf
                        <div class="form-floating mb-4">
                            <input type="hidden" class="form-control" id="role_id" name="role_id">
                            <input type="text" class="form-control" id="description" name="description"
                                placeholder="Description" autofocus>
                            <label for="description">Description</label>
                            <p class="mb-0" id="descriptionError"></p>
                        </div>
                    </form>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="frmRole" class="btn btn-sm btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="mdlAssignPermission" tabindex="-1" role="dialog" aria-labelledby="modal-block-select2"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Assign Permission</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <form id="frmAssignPermission">
                        <div class="form-floating mb-4">
                            <div class="row">
                                <div class="col-md-10 po_add_item">
                                    @if (isset($role_id))
                                        <input type="text" value="{{ $role_id }}" id="r_id" name="r_id"
                                            hidden>
                                    @endif
                                    <select multiple class="js-select2 form-select" style="width: 120% !important"
                                        id="permission_ids" name="permission_ids[]"
                                        data-container="#mdlAssignPermission" data-placeholder="Select permissions">
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="frmAssignPermission" class="btn btn-sm btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>
</div>
