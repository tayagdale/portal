<div class="modal fade" id="mdlTerm" tabindex="-1" role="dialog" aria-labelledby="mdlTerm" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Add Term</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <form id="frmTerm">
                        @csrf
                        <div class="form-floating mb-4">
                            <input type="hidden" class="form-control" id="term_id" name="term_id">
                            <input type="number" class="form-control" id="terms" name="terms" placeholder="Terms"
                                autofocus>
                            <label for="terms">Term</label>
                            <p class="mb-0" id="termsError"></p>
                        </div>
                        <div class="form-floating mb-4">
                            <select class=" form-select" id="calendar_id" name="calendar_id" data-container="#mdlTerm"
                                data-placeholder="Select Item">
                                <option value=""></option>
                            </select>
                            <label for="calendar_id">Calendar</label>
                            <p class="mb-0" id="calendar_idError"></p>
                        </div>
                    </form>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="frmTerm" class="btn btn-sm btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
