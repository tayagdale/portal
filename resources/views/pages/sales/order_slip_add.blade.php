@extends('layouts.backend')
@section('css')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
@endsection

@section('js')
    <!-- jQuery (required for DataTables plugin) -->
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>

    <!-- Page JS Plugins -->
    <script src="{{ asset('js/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-responsive-bs5/js/responsive.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons-jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons-pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons-pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.print.min.js') }}"></script>
    <script src="{{ asset('js/plugins/datatables-buttons/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-validation/additional-methods.js') }}"></script>
    <script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js') }}"></script>
    <script src="{{ url('https://cdn.jsdelivr.net/npm/sweetalert2@11') }}"></script>
    <script src="{{ asset('js/pages/functions.js') }}"></script>
    <script src="{{ asset('js/pages/sales/orderSlipFunctions.js') }}"></script>



    <!-- Page JS Code -->
    @vite(['resources/js/pages/sales/orderSlipsDatatable.js'])
@endsection
@section('content')
    <form id="submitOS">
        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center pt-4">
                    <div class="flex-grow-1">
                        <h1 class="h3 fw-bold mb-2">

                            <a href="#">Order Slip</a> > Add New Order Slip
                        </h1>
                    </div>
                    <div class="flex-shrink-0 my-3 mt-sm-0 ms-sm-3">
                        <a href="javascript:void(0);" onclick="clearOSItems()" class="btn btn-outline-dark"><i
                                class="si si-refresh"></i> Clear</a>

                        <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Submit OS</button>

                    </div>
                </div>
            </div>
        </div>
        <!-- END Hero -->

        <!-- Page Content -->
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="block block-rounded mb-4">
                        <div class="block-header block-header-default">
                            <h3 class="block-title">
                                OS Details
                            </h3>
                        </div>
                        <div class="block-content">
                            <!-- Dynamic Table Responsive -->
                            <div class="block block-rounded">

                                <div class="block-content block-content-full">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="">OS No.</label>
                                            <input type="text" value="{{ $os_number }}" name="os_number"
                                                id="os_number" class="form-control os_number">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">Date</label>
                                            <input type="text" value="{{ now()->format('Y-m-d') }}" name="date"
                                                id="date" class="form-control" readonly>
                                            <input type="hidden" name="podate" id="podate" class="form-control"
                                                readonly>
                                            <input type="hidden" name="total_amount" id="total_amount"
                                                class="form-control total_amount" readonly>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">Customer</label>
                                            <div class="d-flex">
                                                <select class="form-select customer_id" id="customer_id" name="customer_id"
                                                    data-placeholder="Select Customer">
                                                    <option value=""></option>
                                                </select>
                                                <a href="javascript:void(0);" onclick="create_customer()"
                                                    style="margin-left: 10px;" class="btn btn-outline-primary"><i
                                                        class="fa fa-plus"></i></a>
                                            </div>
                                            <p class="mb-0" id="customer_idError"></p>

                                        </div>
                                        <div class="col-md-3">

                                            <label for="">Terms</label>
                                            <select class="form-select" name="terms" id="terms" style="width: 100%;"
                                                data-placeholder="Select Terms">
                                                <option value=""></option>
                                                <option value="1">One</option>
                                                <option value="2">Two</option>
                                            </select>
                                            <p class="mb-0" id="termsError"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </form>
    @include('modals/customers/modal')
    @include('modals/order_slips/modal')
    @include('modals/items/modal')

    <div class="row">
        <div class="col-md-12">
            <div class="block block-rounded">
                <div class="block-content">
                    <!-- Dynamic Table Responsive -->
                    <div class="block block-rounded">
                        <div class="block-content block-content-full">
                            <table class="table table-bordered table-vcenter js-dataTable-order_slip_details">
                                <thead>
                                    <tr>
                                        <th>OS No.</th>
                                        <th>Item Id</th>
                                        <th>Name</th>
                                        <th>UOM</th>
                                        <th>Quantity</th>
                                        <th style="width:10%;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <div id="table-res">
                                <a href="javascript:void(0);" onclick="add_item()" class="btn btn-outline-primary"><i
                                        class="fa fa-plus"></i></a>

                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END Page Content -->
@endsection
