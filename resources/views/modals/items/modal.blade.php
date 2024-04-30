<div class="modal fade" id="mdlItem" tabindex="-1" role="dialog" aria-labelledby="mdlItem" aria-hidden="true">
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
                    <form id="frmItem">
                        @csrf
                        <div class="form-floating mb-4">
                            <input type="hidden" class="form-control" id="item_id" name="item_id">
                            <input type="text" class="form-control" id="generic_name" name="generic_name"
                                placeholder="Generic Name" autofocus>
                            <label for="generic_name">Description</label>
                            <p class="mb-0" id="generic_nameError"></p>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="hidden" class="form-control" id="item_id" name="item_id">
                            <input type="text" class="form-control" id="brand_name" name="brand_name"
                                placeholder="Brand Name" autofocus>
                            <label for="brand_name">Brand Name</label>
                            <p class="mb-0" id="brand_nameError"></p>
                        </div>
                        <div class="form-floating mb-4">
                            <select class=" form-select" id="category_id" name="category_id" data-container="#mdlItem"
                                data-placeholder="Select Item">
                                <option value=""></option>
                            </select>
                            <label for="category_id">Category</label>
                            <p class="mb-0" id="category_idError"></p>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="hidden" value="{{ Auth::user()->id }}" class="form-control" id="encoded_by"
                                name="encoded_by" placeholder="Encoded By">
                        </div>
                        <div class="form-floating mb-4">
                            <input type="hidden" value="{{ Auth::user()->id }}" class="form-control" id="edited_by"
                                name="edited_by" placeholder="Encoded By">
                        </div>
                    </form>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="frmItem" class="btn btn-sm btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="itemConversion" tabindex="-1" role="dialog" aria-labelledby="mdlItem" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Conversion</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <form id="itemConversionForm">
                        <div class="row">
                            <input type="hidden" class="form-control" id="conversion_item_id" name="item_id">

                            <div class="col-md-5">
                                <div class="form-floating mb-4">
                                    <select class=" form-select" id="unit_id_1" name="uom_1"
                                        data-container="#itemConversion" data-placeholder="Select Item">
                                        <option value=""></option>
                                    </select>
                                    <label for="category_id">Unit of Measure</label>
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" id="qty1" name="qty_1"
                                        placeholder="Quantity">
                                    <label for="generic_name">Quantity</label>
                                </div>
                            </div>
                            <div class="col-md-2 text-center fs-5" style="align-self: center;">
                                <span><i class="fa fa-arrow-right"></i></span>
                            </div>
                            <div class="col-md-5">
                                <div class="form-floating mb-4">
                                    <select class="form-select" id="unit_id_2" name="uom_2"
                                        data-container="#itemConversion" data-placeholder="Select Item">
                                        <option value=""></option>
                                    </select>
                                    <label for="unit_id">Unit of Measure</label>
                                </div>
                                <div class="form-floating mb-4">
                                    <input type="text" class="form-control" id="qty2" name="qty_2"
                                        placeholder="Quantity">
                                    <label for="generic_name">Quantity</label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="itemConversionForm" class="btn btn-sm btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
