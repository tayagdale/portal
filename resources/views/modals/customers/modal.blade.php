<div class="modal fade" id="mdlCustomer" tabindex="-1" role="dialog" aria-labelledby="mdlCustomer" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Add Customer</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <form id="frmCustomer">
                        @csrf
                        <div class="form-floating mb-4">
                            <input type="hidden" class="form-control" id="customer_id" name="customer_id">
                            <input type="text" class="form-control" id="customer_code" name="customer_code"
                                placeholder="customer Code" autofocus>
                            <label for="customer_code">Customer Code</label>
                            <p class="mb-0" id="customer_codeError"></p>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" id="description" name="description"
                                placeholder="Description">

                            <label for="description">Description</label>
                            <p class="mb-0" id="descriptionError"></p>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" id="address" name="address"
                                placeholder="Address">

                            <label for="address">Address</label>
                            <p class="mb-0" id="addressError"></p>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" id="contact_person" name="contact_person"
                                placeholder="Contact Person">

                            <label for="contact_person">Contact Person</label>
                            <p class="mb-0" id="contact_personError"></p>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" id="contact_no" name="contact_no"
                                placeholder="Contact No">

                            <label for="contact_no">Contact No</label>
                            <p class="mb-0" id="contact_noError"></p>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" id="position" name="position"
                                placeholder="Position">

                            <label for="position">Position</label>
                            <p class="mb-0" id="positionError"></p>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" id="position" name="msr"
                                placeholder="Sales Representative">

                            <label for="msr">Sales Representative</label>
                            <p class="mb-0" id="msrError"></p>
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
                    <button type="submit" form="frmCustomer" class="btn btn-sm btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>
</div>
