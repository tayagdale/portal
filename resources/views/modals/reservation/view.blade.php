<div class="modal fade" id="mdlReservationDetails" tabindex="-1" role="dialog" aria-labelledby="modal-block-select2"
    aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="block block-rounded block-transparent mb-0">
                <div class="block-header block-header-default">
                    <h3 class="block-title">View Inspection Details</h3>
                    <div class="block-options">
                        <button type="button" class="btn-block-option" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fa fa-fw fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="block-content fs-sm">
                    <div class="form-floating mb-4">
                        <h3>Reservation ID: <span id="reservation_id"></span></h3>
                    </div>

                    <table class="table table-bordered table-vcenter js-dataTable-reservation-details-view">
                        <thead>
                            <tr>
                                <th>Reservation Id</th>
                                <th>Description</th>
                                <th>Brand</th>
                                <th>Qty</th>
                                <th>Reserved Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- <tr>
                        <td>12344</td>
                        <td>Pencil</td>
                        <td>CM</td>
                        <td>10</td>
                        <td>P15.00</td>
                        <td>P150.00</td>
                        <td>
                          <a href="#" class="text-info mx-2"><i class="fa fa-pencil"></i></a>
                          <a href="#" class="text-danger mx-2"><i class="fa fa-trash"></i></a>
                        </td>
                      </tr> -->
                        </tbody>
                    </table>
                </div>
                <!-- <div class="block-content block-content-full text-end bg-body">
                    <button type="button" class="btn btn-sm btn-alt-secondary me-1" data-bs-dismiss="modal">Close</button>
                    <button type="submit" form="frmAddSOItem" class="btn btn-sm btn-primary">Add</button>
                </div> -->
            </div>
        </div>
    </div>
</div>
