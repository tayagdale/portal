@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <!-- Quick Overview -->
        <div class="row">
            <div class="col-6 col-lg-3">
                <a class="block block-rounded block-link-shadow text-center" href="be_pages_ecom_orders.html">
                    <div class="block-content block-content-full">
                        <div class="fs-2 fw-semibold text-primary">{{ $open_purchase_orders }}</div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="fw-medium fs-sm text-muted mb-0">
                            Open Purchase Orders
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-lg-3">
                <a class="block block-rounded block-link-shadow text-center" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="fs-2 fw-semibold text-success">{{ $closed_purchase_orders }}</div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="fw-medium fs-sm text-muted mb-0">
                            Closed Purchase Orders
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-lg-3">
                <a class="block block-rounded block-link-shadow text-center" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="fs-2 fw-semibold text-dark">{{ $sales_orders_count }}</div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="fw-medium fs-sm text-muted mb-0">
                            Sales Orders
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-lg-3">
                <a class="block block-rounded block-link-shadow text-center" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="fs-2 fw-semibold text-dark">{{ $reservations_count }}</div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="fw-medium fs-sm text-muted mb-0">
                            Reservations
                        </p>
                    </div>
                </a>
            </div>
        </div>
        <!-- END Quick Overview -->


        <!-- Top Products and Latest Orders -->
        <div class="row items-push">
            <div class="col-xl-6">
                <!-- Top Products -->
                <div class="block block-rounded h-100 mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Latest Reservations</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option"
                                data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <table class="table table-borderless table-striped table-vcenter fs-sm">
                            <tbody>
                                @foreach ($reservations as $reservation)
                                    <tr>
                                        <td class="text-center" style="width: 100px;">
                                            <a class="fw-semibold" href="#">{{ $reservation->id }}</a>
                                        </td>
                                        <td>
                                            <a href="#">{{ $reservation->customer_code }}</a>
                                        </td>
                                        <td>
                                            <a href="#">{{ $reservation->created_at }}</a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END Top Products -->
            </div>
            <div class="col-xl-6">
                <!-- Latest Orders -->
                <div class="block block-rounded h-100 mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Latest Purchase Orders</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option"
                                data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <table class="table table-borderless table-striped table-vcenter">
                            <tbody>
                                @foreach ($purchase_orders as $purchase_order)
                                    <tr>
                                        <td class="fw-semibold text-center fs-sm" style="width: 100px;">
                                            <a href="be_pages_ecom_order.html">{{ $purchase_order->id }}</a>
                                        </td>
                                        <td class="d-none d-sm-table-cell fs-sm">
                                            <a href="be_pages_ecom_customer.html">{{ $purchase_order->po_number }}</a>
                                        </td>
                                        <td>
                                            @switch($purchase_order->status)
                                                @case(2)
                                                    <span class="badge bg-danger">Closed</span>
                                                @break

                                                @case(4)
                                                    <span class="badge bg-info">Draft</span>
                                                @break

                                                @default
                                                    <span class="badge bg-success">Open</span>
                                            @endswitch
                                        </td>
                                        <td class="fw-medium fs-sm text-end">{{ $purchase_order->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END Latest Orders -->
            </div>
        </div>
        <!-- END Top Products and Latest Orders -->
        <!-- Top Products and Latest Orders -->
        <div class="row items-push">
            <div class="col-xl-6">
                <!-- Top Products -->
                <div class="block block-rounded h-100 mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Latest Order Slips</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option"
                                data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <table class="table table-borderless table-striped table-vcenter fs-sm">
                            <tbody>
                                @foreach ($order_slips as $order_slip)
                                    <tr>
                                        <td class="fw-semibold text-center fs-sm" style="width: 100px;">
                                            <a href="be_pages_ecom_order.html">{{ $order_slip->id }}</a>
                                        </td>
                                        <td class="d-none d-sm-table-cell fs-sm">
                                            <a href="be_pages_ecom_customer.html">{{ $order_slip->os_number }}</a>
                                        </td>
                                        <td>
                                            @switch($order_slip->status)
                                                @case(2)
                                                    <span class="badge bg-danger">Closed</span>
                                                @break

                                                @case(4)
                                                    <span class="badge bg-info">Draft</span>
                                                @break

                                                @default
                                                    <span class="badge bg-success">Open</span>
                                            @endswitch
                                        </td>
                                        <td class="fw-medium fs-sm text-end">{{ $order_slip->created_at }}</td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END Top Products -->
            </div>
            <div class="col-xl-6">
                <!-- Latest Orders -->
                <div class="block block-rounded h-100 mb-0">
                    <div class="block-header block-header-default">
                        <h3 class="block-title">Latest Sales Orders</h3>
                        <div class="block-options">
                            <button type="button" class="btn-block-option" data-toggle="block-option"
                                data-action="state_toggle" data-action-mode="demo">
                                <i class="si si-refresh"></i>
                            </button>
                        </div>
                    </div>
                    <div class="block-content">
                        <table class="table table-borderless table-striped table-vcenter">
                            <tbody>
                                @foreach ($sales_orders as $sales_order)
                                    <tr>
                                        <td class="fw-semibold text-center fs-sm" style="width: 100px;">
                                            <a href="be_pages_ecom_order.html">{{ $sales_order->id }}</a>
                                        </td>
                                        <td class="d-none d-sm-table-cell fs-sm">
                                            <a href="be_pages_ecom_customer.html">{{ $sales_order->so_number }}</a>
                                        </td>
                                        <td>
                                            @switch($sales_order->status)
                                                @case(2)
                                                    <span class="badge bg-danger">Closed</span>
                                                @break

                                                @case(4)
                                                    <span class="badge bg-info">Draft</span>
                                                @break

                                                @default
                                                    <span class="badge bg-success">Open</span>
                                            @endswitch
                                        </td>
                                        <td class="fw-medium fs-sm text-end">{{ $sales_order->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END Latest Orders -->
            </div>
        </div>
        <!-- END Top Products and Latest Orders -->
    </div>
    <!-- END Page Content -->
@endsection
