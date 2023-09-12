<div class="modal fade" id="mdlWarehouse" tabindex="-1" role="dialog" aria-labelledby="mdlWarehouse" aria-hidden="true">
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
                    <form id="frmWarehouse">
                        @csrf
                        <div class="form-floating mb-4">
                            <input type="hidden" class="form-control" id="warehouse_id" name="warehouse_id">
                            <input type="text" class="form-control" id="warehouse_name" name="warehouse_name"
                                placeholder="Warehouse Name" autofocus>
                            <label for="warehouse_name">Warehouse Name</label>
                            <p class="mb-0" id="warehouse_nameError"></p>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" id="warehouse_location" name="warehouse_location"
                                placeholder="Warehouse Location" autofocus>
                            <label for="warehouse_location">Warehouse Location</label>
                            <p class="mb-0" id="warehouse_locationError"></p>
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
                    <button type="submit" form="frmWarehouse" class="btn btn-sm btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
