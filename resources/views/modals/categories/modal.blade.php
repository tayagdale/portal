<div class="modal fade" id="mdlCategory" tabindex="-1" role="dialog" aria-labelledby="mdlCategory" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Add Category</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <form id="frmCategory">
                        @csrf
                        <div class="form-floating mb-4">
                            <input type="hidden" class="form-control" id="category_id" name="category_id">
                            <input type="text" class="form-control" id="category_name" name="category_name"
                                placeholder="Category Name" autofocus>
                            <label for="category_name">Category Name</label>
                            <p class="mb-0" id="category_nameError"></p>
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
                    <button type="submit" form="frmCategory" class="btn btn-sm btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
