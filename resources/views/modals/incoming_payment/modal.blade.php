<div class="modal fade" id="mdlAddIncomingPayment" tabindex="-1" role="dialog" aria-labelledby="mdlAddIncomingPayment"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">Add Delivery</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <form id="frmAddIncomingPayment">
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" id="or_number" name="or_number"
                                placeholder="OR Number" autofocus>
                            <label for="or_number">OR Number</label>
                            <p class="mb-0" id="or_numberError"></p>
                        </div>
                        <div class="form-floating mb-4">
                            <select class="form-select" id="si_number" name="si_number"
                                aria-label="Floating label select example">
                            </select>
                            <label for="si_number">Sales Invoice No.</label>
                        </div>
                        <div class="form-floating mb-4">
                            <select class="form-select" id="payment_mode" name="payment_mode"
                                aria-label="Floating label select example">
                                <option value=""></option>
                                <option value="1">Cash</option>
                                <option value="2">Check</option>
                            </select>
                            <label for="payment_mode">Mode of Payment</label>
                        </div>
                        <div class="form-floating mb-4">
                            <select class="form-select" id="payment_type" name="payment_type"
                                aria-label="Floating label select example">
                                <option value=""></option>
                                <option value="1">Full</option>
                                <option value="2">Partial</option>
                            </select>
                            <label for="payment_type">Payment Type</label>
                        </div>
                        <div class="form-floating mb-4 " id="checkNo" style="display: none;">
                            <input type="text" class="form-control" id="check_number" name="check_number"
                                placeholder="Check Number">
                            <label for="check_number">Check No.</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="text" class="form-control" id="payment_amount" name="payment_amount"
                                placeholder="Payment Amount">
                            <label for="payment_amount">Payment Amount</label>
                        </div>
                    </form>
                </div>
                <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1"
                        data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="frmAddIncomingPayment" class="btn btn-sm btn-primary">Add</button>
                </div>
            </div>
        </div>
    </div>
</div>
