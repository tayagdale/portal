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
            background-image: url('{{ asset('media/photos/purchase_order.jpg') }}');
            background-size: contain;
            background-repeat: no-repeat;
            border: none !important;
        }

        .supplier_name {
            margin-left: 135px;
            margin-top: 160px;
        }

        .supplier_address {
            margin-top: -28px;
        }

        .po_div {
            margin-top: 145px;
        }

        .po_details {
            line-height: 0;
        }

        .po_tbl {
            margin-top: -17px !important;
            width: 92% !important;
            margin-left: 10px !important;
            /* border: 1px solid black !important; */

        }

        .po_thead {
            height: 10px;
            /* border: 1px solid black; */
        }


        .order_qty {
            width: 53px;
            height: 15px !important;
            font-size: 12px;
            color: transparent;
        }

        .uom {
            width: 47px;
            height: 15px !important;
            font-size: 12px;
            color: transparent;
        }

        .description {
            width: 197px;
            height: 15px !important;
            font-size: 12px;
            color: transparent;
        }

        .unit_price {
            width: 57px;
            height: 15px !important;
            font-size: 12px;
            color: transparent;
        }

        .total_amount {
            width: 121px;
            height: 15px !important;
            font-size: 12px;
            color: transparent;
        }

        .po_qty {
            width: 60px;
            height: 15px !important;
            font-size: 12px;
            color: transparent;
        }

        .avail_stocks {
            width: 60px;
            height: 15px !important;
            font-size: 12px;
            color: transparent;
        }

        .stocks_level {
            width: 60px;
            height: 15px !important;
            font-size: 12px;
            color: transparent;
        }

        .remarks {
            width: 60px;
            height: 15px !important;
            font-size: 12px;
            color: transparent;
        }


        .td_details {
            height: 15px !important;
            font-size: 8px;
            padding: -16px;
        }




        .total_div {
            /* margin-top: 518px !important; */
            position: absolute;
            right: 333px;
            top: 1106px;
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
                /* background-image: url('{{ asset('media/photos/purchase_order.jpg') }}');
                background-size: contain;
                background-repeat: no-repeat; */

                border: none !important;
            }

            .supplier_name {
                margin-left: 125px;
                margin-top: 140px;
            }

            .supplier_address {
                margin-top: -18px;
            }

            .po_div {
                margin-top: 125px;
            }

            .po_details {
                line-height: 0.5;
                margin-left: 40px;
            }


            .po_tbl {
                margin-top: -3px !important;
                width: 99% !important;
                margin-left: 4px !important;

            }

            .po_thead {
                height: 5px;
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
                right: 140px;
                top: 800px;
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
                        Purchase Order
                    </h2>
                </div>
                <nav class="flex-shrink-0 mt-3 mt-sm-0 ms-sm-3" aria-label="breadcrumb">
                    <ol class="breadcrumb breadcrumb-alt">
                        <li class="breadcrumb-item">
                            <a class="link-fx" href="javascript:void(0)">Purchase Order</a>
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
                <h3 class="block-title">{{ $po_number }}</h3>
                {{-- <h3 class="block-title">{{ $po_details }}</h3> --}}
                <div class="block-options">
                    <!-- Print Page functionality is initialized in Helpers.onePrint() -->
                    <button type="button" class="btn-block-option" onclick="One.helpers('invoice-print');">
                        <i class="si si-printer me-1"></i> Print Invoice
                    </button>
                </div>
            </div>
            <div id="purchase_order">
                <div class="short-bond-paper">
                    <div class="row">
                        <div class="col-8">
                            <div class="supplier_name">
                                @php
                                    $decodedPO = json_decode($po, true);
                                @endphp
                                @foreach ($decodedPO as $purchase_order)
                                    <p class="h3">{{ $purchase_order['description'] }}</p>

                                    <p class="supplier_address">
                                        {{ $purchase_order['address'] }}
                                    </p>
                                @endforeach
                            </div>

                        </div>
                        <div class="col-4">
                            <div class="po_div">
                                @php
                                    $decodedPO = json_decode($po, true);
                                @endphp
                                @foreach ($decodedPO as $purchase_order)
                                    <p class="po_number po_details">{{ $purchase_order['po_number'] }}</p>

                                    <p class="po_date po_details">
                                        {{ $purchase_order['date'] }}
                                    </p>
                                    <p class="po_terms po_details">
                                        {{ $purchase_order['terms'] }}
                                    </p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <table class="po_tbl">
                            <thead class="po_thead">
                                <tr>
                                    <th class="text-center order_qty">Order
                                        QTY</th>
                                    <th class="text-center uom"></th>
                                    <th class="description">Item
                                        Description</th>
                                    <th class="unit_price">Unit
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
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $decodedPO_details = json_decode($po_details, true);
                                @endphp
                                @foreach ($decodedPO_details as $po_detail)
                                    <tr>
                                        <td class="td_details">
                                            {{ $po_detail['qty'] }}</td>
                                        <td class="td_details">
                                            {{ $po_detail['unit_code'] }}</td>
                                        <td class="td_details">
                                            <p class="fw-semibold mb-1">{{ $po_detail['brand_name'] }}</p>
                                        </td>
                                        <td class="td_details">
                                            @php
                                                echo number_format($po_detail['unit_price'], 2);
                                            @endphp
                                        </td>
                                        <td class="td_details">
                                            @php
                                                echo number_format($po_detail['total_amount'], 2);
                                            @endphp
                                        </td>
                                        <td class="td_details">
                                            {{ $po_detail['qty'] }}</td>
                                        <td class="td_details">N/A
                                        </td>
                                        <td class="td_details">N/A
                                        </td>
                                        <td class="td_details">N/A
                                        </td>
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
                            @foreach ($decodedPO as $purchase_order)
                                @php
                                    echo number_format($purchase_order['total_amount'], 2);
                                @endphp
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
