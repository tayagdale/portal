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
    <script src="{{ asset('js/pages/reservation/reservationFunctions.js') }}"></script>
    <script type="module">
        // Slick Slider, for more info and examples you can check out http://kenwheeler.github.io/slick/
        One.helpersOnLoad(['custom-jq-select2']);
    </script>

    <!-- Page JS Code -->
    @vite(['resources/js/pages/reservation/reservationDatatable.js'])
@endsection
@section('content')
<form id="submitRes">
        <input type="hidden" value="{{$reservation_id}}" name="reservation_id" id="reservation_id">
        <!-- Hero -->
        <div class="bg-body-light">
            <div class="content content-full">
                <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center pt-4">
                    <div class="flex-grow-1">
                        <h1 class="h3 fw-bold mb-2">

                            <a href="#">Reservation</a> > Update Reservation
                        </h1>
                    </div>
                    <div class="flex-shrink-0 my-3 mt-sm-0 ms-sm-3">
                        <a href="javascript:void(0);" onclick="clearResItems()" class="btn btn-outline-dark"><i
                                class="si si-refresh"></i> Clear</a>

                        <button type="submitRes" class="btn btn-primary"><i class="fa fa-check"></i> Save Reservation</button>

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
                                Reservation Details
                            </h3>
                        </div>
                        <div class="block-content">
                            <!-- Dynamic Table Responsive -->
                            <div class="block block-rounded">

                                <div class="block-content block-content-full">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="">Customer</label>
                                            <select class="custom-js-select2 form-select customer_id" id="customer_id" name="customer_id"
                                                data-placeholder="Select Customer">
                                                <option value=""></option>
                                                @foreach($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->customer_code }} - {{ $customer->description }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                        <div class="col-md-3">
                                            <label for="">Date</label>
                                            <input type="text" value="{{ now()->format('Y-m-d') }}" name="date"
                                                id="date" class="form-control" readonly>
                                            <input type="hidden" name="podate" id="podate" class="form-control"
                                                readonly>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </form>
    
    @include('modals/reservation/modal')

    <div class="row">
        <div class="col-md-12">
            <div class="block block-rounded">
                <div class="block-content">
                    <!-- Dynamic Table Responsive -->
                    <div class="block block-rounded">
                        <div class="block-content block-content-full">
                            <table class="table table-bordered table-vcenter js-dataTable-reservation_order">
                                <thead>
                                    <tr>
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
