<div class="modal fade" id="mdlUnit" tabindex="-1" role="dialog" aria-labelledby="mdlUnit" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Add Unit</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <form id="frmUnit">
                        @csrf
                        <div class="form-floating mb-4">
                            <input type="hidden" class="form-control" id="unit_id" name="unit_id">
                            <input type="text" class="form-control" id="unit_code" name="unit_code"
                                placeholder="Unit Code" autofocus>
                            <label for="unit_code">Unit Code</label>
                            <p class="mb-0" id="unit_codeError"></p>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="hidden" value="{{ Auth::user()->id }}" class="form-control" id="encoded_by"
                                name="encoded_by" placeholder="Encoded By">

                            {{-- <p class="mb-0" id="nameError"></p> --}}
                        </div>
                        <div class="form-floating mb-4">
                            <input type="hidden" value="{{ Auth::user()->id }}" class="form-control" id="edited_by"
                                name="edited_by" placeholder="Encoded By">

                            {{-- <p class="mb-0" id="nameError"></p> --}}
                        </div>
                    </form>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="frmUnit" class="btn btn-sm btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
