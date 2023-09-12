@extends('layouts.backend')
@section('css')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/select2/css/select2.min.css') }}">
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
    <script src="{{ asset('js/plugins/select2/js/select2.full.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('js/plugins/jquery-validation/additional-methods.js') }}"></script>
    <script src="{{ url('https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.2/moment.min.js') }}"></script>
    <script src="{{ url('https://cdn.jsdelivr.net/npm/sweetalert2@11') }}"></script>
    <script src="{{ asset('js/pages/functions.js') }}"></script>
    <script src="{{ asset('js/pages/payment/outgoingPaymentFunctions.js') }}"></script>
    <script type="module">
        // Slick Slider, for more info and examples you can check out http://kenwheeler.github.io/slick/
        One.helpersOnLoad(['jq-select2']);
    </script>

    <!-- Page JS Code -->
    @vite(['resources/js/pages/payment/outgoingPaymentDatatable.js'])
@endsection
@section('content')
    <!-- Hero -->
    <div class="bg-body-light">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center pt-4">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-2">
                        Outgoing Payment
                    </h1>
                </div>
                <div class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" a>
                    <a href="#" data-bs-toggle="modal" onclick="create()" class="btn btn-sm btn-primary"><i
                            class="fa fa-plus"></i> Release Payment</a>
                    @include('modals/outgoing_payment/modal')

                    <!-- <a href="./admin/purchase_order_add.php" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add New PO</a> -->
                </div>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content">
        <div class="block block-rounded">
            <div class="block-content">
                <!-- Dynamic Table Responsive -->
                <div class="block block-rounded">
                    <div class="block-content block-content-full">
                        <!-- DataTables init on table by adding .js-dataTable-responsive class, functionality is initialized in js/pages/be_tables_datatables.min.js which was auto compiled from _js/pages/be_tables_datatables.js -->
                        <table class="table table-bordered table-striped table-vcenter js-dataTable-outgoing_payment">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>P-OR No</th>
                                    <th>PO No</th>
                                    <th>Inspection No</th>
                                    <th>Supplier</th>
                                    <th>Total Amount</th>
                                    <th>Payment Type</th>
                                    <th>Payment Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- END Page Content -->
@endsection
