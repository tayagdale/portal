@extends('layouts.backend')
@section('css')
    <!-- Page JS Plugins CSS -->
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-bs5/css/dataTables.bootstrap5.min.css') }}">
    <link rel="stylesheet" href="{{ asset('js/plugins/datatables-buttons-bs5/css/buttons.bootstrap5.min.css') }}">

    <style>
        /* Define the size of the div */
        #purchase_order {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .short-bond-paper {

            width: 8.5in;
            /* 215.9mm */
            height: 10in;
            /* 279.4mm */
            background-color: white;
            border: 1px solid #000;
            /* Add a border for visualization */
            padding: 10px;
            /* Add some padding for content */
            background-image: url('{{ asset('media/photos/sales_order.jpg') }}');
            background-size: contain;
            background-repeat: no-repeat;
            border: none !important;
        }

        .supplier_name {
            margin-left: 135px;
            margin-top: 115px;
        }

        .supplier_address {
            margin-top: -35px;
        }

        .po_div {
            margin-top: 100px;
            margin-left: 70px;
        }

        .po_details {
            line-height: 0;
        }

        .po_tbl {
            margin-top: -21px !important;
            width: 88% !important;
            margin-left: 24px !important;
            /* border: 1px solid black !important; */

        }

        .po_thead {
            height: 10px;
            /* border: 1px solid black; */
        }

        .code {
            width: 18px;
            height: 15px !important;
            font-size: 2px;
            color: transparent;
        }

        .del_qty {
            width: 22px;
            height: 15px !important;
            font-size: 7px;
            color: transparent;
        }

        .lot_no {
            width: 5px;
            height: 15px !important;
            font-size: 2px;
            color: transparent;
        }

        .order_qty {
            width: 29px;
            height: 15px !important;
            font-size: 7px;
            color: transparent;
        }

        .uom {
            width: 6px;
            height: 15px !important;
            font-size: 2px;
            color: transparent;
        }

        .description {
            width: 185px;
            height: 15px !important;
            font-size: 12px;
            color: transparent;
        }



        .td_details {
            height: 20px !important;
            font-size: 8px;
            padding: -16px;
        }




        .total_div {
            /* margin-top: 518px !important; */
            position: absolute;
            right: 622px;
            top: 1133px;
            width: 100%;
            text-align: center;
        }

        @media print {
            .short-bond-paper {
                /* -webkit-print-color-adjust: exact !important; */
                /* Chrome, Safari 6 – 15.3, Edge */
                /* color-adjust: exact !important; */
                /* Firefox 48 – 96 */
                /* print-color-adjust: exact !important; */
                /* Firefox 97+, Safari 15.4+ */
                /* background-image: url('{{ asset('media/photos/sales_order.jpg') }}');
                    background-size: contain;
                    background-repeat: no-repeat; */

                border: none !important;
            }

            .supplier_name {
                margin-left: 105px;
                margin-top: 105px;
            }

            .supplier_address {
                margin-top: -25px;
            }

            .po_div {
                margin-top: 110px;
                margin-left: 100px;
            }

            .po_details {
                line-height: 0;
            }

            .po_tbl {
                margin-top: -10px !important;
                width: 96% !important;
                margin-left: 17px !important;

            }

            .po_thead {
                height: 10px;
            }

            .order_qty {
                width: 53px;
                height: 15px !important;
                font-size: 10px;
                color: transparent;
            }

            .uom {
                width: 47px;
                height: 15px !important;
                font-size: 10px;
                color: transparent;
            }

            .description {
                width: 197px;
                height: 15px !important;
                font-size: 10px;
                color: transparent;
            }

            .unit_price {
                width: 57px;
                height: 15px !important;
                font-size: 10px;
                color: transparent;
            }

            .total_amount {
                width: 121px;
                height: 15px !important;
                font-size: 10px;
                color: transparent;
            }

            .po_qty {
                width: 60px;
                height: 15px !important;
                font-size: 10px;
                color: transparent;
            }

            .avail_stocks {
                width: 60px;
                height: 15px !important;
                font-size: 10px;
                color: transparent;
            }

            .stocks_level {
                width: 60px;
                height: 15px !important;
                font-size: 10px;
                color: transparent;
            }

            .remarks {
                width: 60px;
                height: 15px !important;
                font-size: 10px;
                color: transparent;
            }


            .td_details {
                height: 15px !important;
                font-size: 6px;
                padding: -16px;
            }


            .total_div {
                position: absolute;
                right: 400px;
                top: 840px;
                width: 100%;
                text-align: center;
            }


        }
    </style>
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
@endsection
@section('content')
    <!-- Hero -->
    <div class="bg-body-light d-print-none">
        <div class="content content-full">
            <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center py-2">
                <div class="flex-grow-1">
                    <h1 class="h3 fw-bold mb-1">
                        Steritex Medical System
                    </h1>
                    <h2 class="fs-base lh-base fw-medium text-muted mb-0">
                        Sales Order
                    </h2>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">Sales Order</a>
                        </li>
                        <li class="breadcrumb-item" aria-current="page">
                            Print
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
    <!-- END Hero -->

    <!-- Page Content -->
    <div class="content content-boxed">
        <!-- Invoice -->
        <div class="block block-rounded">
            <div class="block-header block-header-default">
                <h3 class="block-title">{{ $so_number }}</h3>
                {{-- <h3 class="block-title">{{ $so_details }}</h3> --}}
                <div class="block-options">
                    <!-- Print Page functionality is initialized in Helpers.onePrint() -->
                    <button type="button" class="btn-block-option" onclick="One.helpers('invoice-print');">
                        <i class="si si-printer me-1"></i> Print Invoice
                    </button>
                </div>
            </div>
            <div id="purchase_order">
                {{-- style="background-image: url('{{ asset('media/photos/purchase_order.jpg') }}');background-size: contain;   background-repeat: no-repeat; "> --}}
                <div class="short-bond-paper">
                    <div class="row">
                        <div class="col-8">
                            <div class="supplier_name">
                                @php
                                    $decodedSO = json_decode($so, true);
                                @endphp
                                @foreach ($decodedSO as $sales_order)
                                    <p>{{ $sales_order['description'] }}</p>

                                    <p class="supplier_address">
                                        {{ $sales_order['address'] }}
                                    </p>
                                @endforeach
                            </div>

                        </div>
                        <div class="col-4">
                            <div class="po_div">
                                @foreach ($decodedSO as $sales_order)
                                    <p class="po_number po_details">{{ $sales_order['so_number'] }}</p>

                                    <p class="po_date po_details">
                                        @php
                                            echo date('d-m-Y', strtotime($sales_order['date']));
                                        @endphp
                                    </p>
                                    <p class="po_terms po_details">
                                        {{ $sales_order['terms'] }}
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <table class="po_tbl">
                            <thead class="po_thead">
                                <tr>
                                    <th class="text-center code">Code</th>
                                    <th class="text-center order_qty">Ord. QTY</th>
                                    <th class="text-center del_qty">Del. QTY</th>
                                    <th class="text-center lot_no">LOT NO. /EXP</th>
                                    <th class="text-center uom">UoM</th>
                                    <th class="description">Item
                                        Description</th>
                                    {{-- <th class="unit_price">Unit
                                        Price</th>
                                    <th class="total_amount">Total
                                        Amount</th>
                                    <th class="po_qty">P.O. QTY
                                    </th>
                                    <th class="avail_stocks">Avail
                                        Stocks</th>
                                    <th class="stocks_level">Stock
                                        Level</th>
                                    <th class="remarks">Remarks
                                    </th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $decodedSO_details = json_decode($so_details, true);
                                @endphp
                                @foreach ($decodedSO_details as $so_detail)
                                    <tr>
                                        <td class="td_details">{{ $so_detail['item_id'] }}</td>
                                        <td class="td_details"> {{ $so_detail['qty'] }}</td>
                                        <td class="td_details">{{ $so_detail['qty'] }}</td>
                                        <td class="td_details">{{ $so_detail['lot_no'] }}</td>
                                        <td class="td_details">{{ $so_detail['unit_code'] }}</td>
                                        <td class="td_details">
                                            <p class="fw-semibold mb-1">{{ $so_detail['brand_name'] }}</p>
                                        </td>
                                        {{-- <td class="td_details">N/A
                                        </td>
                                        <td class="td_details">N/A
                                        </td>
                                        <td class="td_details">N/A
                                        </td> --}}
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="row total_div">
                        <div class="col-2"></div>
                        <div class="col-2"></div>
                        <div class="col-2"></div>
                        <div class="col-6">
                            @foreach ($decodedSO as $sales_order)
                                {{ $so_detail['so_number'] }}
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <!-- END Invoice -->
    </div>
    <!-- END Page Content -->
@endsection
