<div class="modal fade" id="mdlAddReservationToOS" tabindex="-1" role="dialog" aria-labelledby="modal-block-select2"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Add to Order Slip</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <form id="frmAddResOSNumber" method="POST" action="{{ route('reservation.add_to_os') }}">
                    @csrf
                        <div class="form-floating mb-4">
                            <input type="hidden" name="res_id" id="res_id">
                            <input type="text" class="form-control" id="os_number" name="os_number"
                                placeholder="PO Number" autofocus required>
                            <label for="os_number">OS Number</label>
                            <p class="mb-0" id="os_numberError"></p>
                        </div>
                    </form>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="frmAddResOSNumber" class="btn btn-sm btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>
</div>