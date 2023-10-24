@extends('layouts.backend')

@section('content')
    <!-- Page Content -->
    <div class="content">
        <!-- Quick Overview -->
        <div class="row">
            <div class="col-6 col-lg-3">
                <a class="block block-rounded block-link-shadow text-center" href="be_pages_ecom_orders.html">
                    <div class="block-content block-content-full">
                        <div class="fs-2 fw-semibold text-primary">35</div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="fw-medium fs-sm text-muted mb-0">
                            Pending Orders
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-lg-3">
                <a class="block block-rounded block-link-shadow text-center" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="fs-2 fw-semibold text-success">33%</div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="fw-medium fs-sm text-muted mb-0">
                            Profit
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-lg-3">
                <a class="block block-rounded block-link-shadow text-center" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="fs-2 fw-semibold text-dark">109</div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="fw-medium fs-sm text-muted mb-0">
                            Orders Today
                        </p>
                    </div>
                </a>
            </div>
            <div class="col-6 col-lg-3">
                <a class="block block-rounded block-link-shadow text-center" href="javascript:void(0)">
                    <div class="block-content block-content-full">
                        <div class="fs-2 fw-semibold text-dark">$8920</div>
                    </div>
                    <div class="block-content py-2 bg-body-light">
                        <p class="fw-medium fs-sm text-muted mb-0">
                            Earnings Today
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
                        <h3 class="block-title">Top Products</h3>
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
                                <tr>
                                    <td class="text-center" style="width: 100px;">
                                        <a class="fw-semibold" href="be_pages_ecom_product_edit.html">PID.965</a>
                                    </td>
                                    <td>
                                        <a href="be_pages_ecom_product_edit.html">Diablo III</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell text-center">
                                        <div class="text-warning">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center" style="width: 100px;">
                                        <a class="fw-semibold" href="be_pages_ecom_product_edit.html">PID.154</a>
                                    </td>
                                    <td>
                                        <a href="be_pages_ecom_product_edit.html">Control</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell text-center">
                                        <div class="text-warning">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center" style="width: 100px;">
                                        <a class="fw-semibold" href="be_pages_ecom_product_edit.html">PID.523</a>
                                    </td>
                                    <td>
                                        <a href="be_pages_ecom_product_edit.html">Minecraft</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell text-center">
                                        <div class="text-warning">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center" style="width: 100px;">
                                        <a class="fw-semibold" href="be_pages_ecom_product_edit.html">PID.423</a>
                                    </td>
                                    <td>
                                        <a href="be_pages_ecom_product_edit.html">Hollow Knight</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell text-center">
                                        <div class="text-warning">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center" style="width: 100px;">
                                        <a class="fw-semibold" href="be_pages_ecom_product_edit.html">PID.391</a>
                                    </td>
                                    <td>
                                        <a href="be_pages_ecom_product_edit.html">Sekiro: Shadows Die Twice</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell text-center">
                                        <div class="text-warning">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center" style="width: 100px;">
                                        <a class="fw-semibold" href="be_pages_ecom_product_edit.html">PID.218</a>
                                    </td>
                                    <td>
                                        <a href="be_pages_ecom_product_edit.html">NBA 2K20</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell text-center">
                                        <div class="text-warning">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center" style="width: 100px;">
                                        <a class="fw-semibold" href="be_pages_ecom_product_edit.html">PID.995</a>
                                    </td>
                                    <td>
                                        <a href="be_pages_ecom_product_edit.html">Forza Motorsport 7</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell text-center">
                                        <div class="text-warning">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center" style="width: 100px;">
                                        <a class="fw-semibold" href="be_pages_ecom_product_edit.html">PID.761</a>
                                    </td>
                                    <td>
                                        <a href="be_pages_ecom_product_edit.html">Minecraft</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell text-center">
                                        <div class="text-warning">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center" style="width: 100px;">
                                        <a class="fw-semibold" href="be_pages_ecom_product_edit.html">PID.860</a>
                                    </td>
                                    <td>
                                        <a href="be_pages_ecom_product_edit.html">Dark Souls III</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell text-center">
                                        <div class="text-warning">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center" style="width: 100px;">
                                        <a class="fw-semibold" href="be_pages_ecom_product_edit.html">PID.952</a>
                                    </td>
                                    <td>
                                        <a href="be_pages_ecom_product_edit.html">Age of Mythology</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell text-center">
                                        <div class="text-warning">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center" style="width: 100px;">
                                        <a class="fw-semibold" href="be_pages_ecom_product_edit.html">PID.952</a>
                                    </td>
                                    <td>
                                        <a href="be_pages_ecom_product_edit.html">Age of Empires IV</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell text-center">
                                        <div class="text-warning">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                    </td>
                                </tr>
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
                        <h3 class="block-title">Latest Orders</h3>
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
                                <tr>
                                    <td class="fw-semibold text-center fs-sm" style="width: 100px;">
                                        <a href="be_pages_ecom_order.html">ORD.7116</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell fs-sm">
                                        <a href="be_pages_ecom_customer.html">Barbara Scott</a>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">Delivered</span>
                                    </td>
                                    <td class="fw-medium fs-sm text-end">$706,00</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold text-center fs-sm">
                                        <a href="be_pages_ecom_order.html">ORD.7115</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell fs-sm">
                                        <a href="be_pages_ecom_customer.html">Helen Jacobs</a>
                                    </td>
                                    <td>
                                        <span class="badge bg-danger">Canceled</span>
                                    </td>
                                    <td class="fw-medium fs-sm text-end">$464,00</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold text-center fs-sm">
                                        <a href="be_pages_ecom_order.html">ORD.7114</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell fs-sm">
                                        <a href="be_pages_ecom_customer.html">Ryan Flores</a>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">Delivered</span>
                                    </td>
                                    <td class="fw-medium fs-sm text-end">$505,00</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold text-center fs-sm">
                                        <a href="be_pages_ecom_order.html">ORD.7113</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell fs-sm">
                                        <a href="be_pages_ecom_customer.html">Jesse Fisher</a>
                                    </td>
                                    <td>
                                        <span class="badge bg-warning">Processing</span>
                                    </td>
                                    <td class="fw-medium fs-sm text-end">$525,00</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold text-center fs-sm">
                                        <a href="be_pages_ecom_order.html">ORD.7112</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell fs-sm">
                                        <a href="be_pages_ecom_customer.html">Melissa Rice</a>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">Delivered</span>
                                    </td>
                                    <td class="fw-medium fs-sm text-end">$578,00</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold text-center fs-sm">
                                        <a href="be_pages_ecom_order.html">ORD.7111</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell fs-sm">
                                        <a href="be_pages_ecom_customer.html">Jose Mills</a>
                                    </td>
                                    <td>
                                        <span class="badge bg-warning">Processing</span>
                                    </td>
                                    <td class="fw-medium fs-sm text-end">$348,00</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold text-center fs-sm">
                                        <a href="be_pages_ecom_order.html">ORD.7110</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell fs-sm">
                                        <a href="be_pages_ecom_customer.html">Jesse Fisher</a>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">Delivered</span>
                                    </td>
                                    <td class="fw-medium fs-sm text-end">$591,00</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold text-center fs-sm">
                                        <a href="be_pages_ecom_order.html">ORD.7109</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell fs-sm">
                                        <a href="be_pages_ecom_customer.html">Brian Cruz</a>
                                    </td>
                                    <td>
                                        <span class="badge bg-warning">Processing</span>
                                    </td>
                                    <td class="fw-medium fs-sm text-end">$534,00</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold text-center fs-sm">
                                        <a href="be_pages_ecom_order.html">ORD.7108</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell fs-sm">
                                        <a href="be_pages_ecom_customer.html">Jose Wagner</a>
                                    </td>
                                    <td>
                                        <span class="badge bg-success">Delivered</span>
                                    </td>
                                    <td class="fw-medium fs-sm text-end">$760,00</td>
                                </tr>
                                <tr>
                                    <td class="fw-semibold text-center fs-sm">
                                        <a href="be_pages_ecom_order.html">ORD.7107</a>
                                    </td>
                                    <td class="d-none d-sm-table-cell fs-sm">
                                        <a href="be_pages_ecom_customer.html">Danielle Jones</a>
                                    </td>
                                    <td>
                                        <span class="badge bg-danger">Canceled</span>
                                    </td>
                                    <td class="fw-medium fs-sm text-end">$270,00</td>
                                </tr>
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
