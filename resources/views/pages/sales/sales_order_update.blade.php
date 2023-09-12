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
    <script src="{{ asset('js/pages/sales/salesOrderFunctions.js') }}"></script>



    <!-- Page JS Code -->
    @vite(['resources/js/pages/sales/salesOrdersDatatable.js'])
@endsection
@section('content')
    <form id="submitSO">
        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center pt-4">
                    <div class="flex-grow-1">
                        <h1 class="h3 fw-bold mb-2">

                            <a href="./admin/sales_order.php">Sales Order</a> > Update Sales Order
                        </h1>
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
                                Details
                            </h3>
                        </div>
                        <div class="block-content">
                            <!-- Dynamic Table Responsive -->
                            <div class="block block-rounded">
                                <div class="block-content block-content-full">
                                    <input type="hidden" name="os_no" id="os_no">
                                    <input type="hidden" name="so_no" id="so_no">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="">SO No.</label>
                                            <input type="text" value="{{ $so_number }}" name="so_number"
                                                id="so_number" class="form-control" readonly>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">OS No.</label>
                                            <input type="text" value="{{ $os_number }}" name="os_number"
                                                id="os_number" class="form-control" readonly>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">Customer</label>
                                            <input type="text" value="{{ $customer }}" name="customer"
                                                id="customer" class="form-control" readonly>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="">Terms</label>
                                            <input type="text" value="{{ $terms }}" name="terms" id="terms"
                                                class="form-control" readonly>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </form>

    <div class="row">
        <div class="col-md-12">
            <div class="block block-rounded">
                <div class="block-content">
                    <!-- Dynamic Table Responsive -->
                    <div class="block block-rounded">
                        <div class="block-content block-content-full">
                            <table class="table table-bordered table-vcenter js-dataTable-sales_order_details">
                                <thead>
                                    <tr>
                                        <th>SO No</th>
                                        <th>Item ID</th>
                                        <th>Name</th>
                                        <th>Unit</th>
                                        <th>Lot No.</th>
                                        <th>Expiration Date</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <!-- <th style="width:10%;"></th> -->
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                            <div id="table-res">
                                <a href="javascript:void(0);" onclick="add_item()" class="btn btn-outline-primary"><i
                                        class="fa fa-plus"></i></a>
                                @include('modals/sales_order/modal')

                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>
    <!-- END Page Content -->
@endsection
