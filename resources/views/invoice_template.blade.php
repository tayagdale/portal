<div class="block-content">
    <div class="p-sm-4 p-xl-7">
        <!-- Invoice Info -->
        <div class="row mb-4">
            <!-- Company Info -->
            <div class="col-6 fs-sm">
                @php
                    $decodedPO = json_decode($po, true);
                @endphp
                @foreach ($decodedPO as $purchase_order)
                    <p class="h3">{{ $purchase_order['description'] }}</p>

                    <address>
                        {{ $purchase_order['address'] }}
                    </address>
                @endforeach
            </div>
            <!-- END Company Info -->

            <!-- Client Info -->
            <div class="col-6 text-end fs-sm">
                <p class="h3">Client</p>
                <address>
                    Street Address<br>
                    State, City<br>
                    Region, Postal Code<br>
                    ctr@example.com
                </address>
            </div>
            <!-- END Client Info -->
        </div>
        <!-- END Invoice Info -->

        <!-- Table -->
        <div class="table-responsive push">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 60px;">Order QTY</th>
                        <th class="text-center" style="width: 60px;">UoM</th>
                        <th>Item Description</th>
                        <th class="text-end" style="width: 120px;">Unit Price</th>
                        <th class="text-end" style="width: 120px;">Total Amount</th>
                        <th class="text-center" style="width: 90px;">P.O. QTY</th>
                        <th class="text-center" style="width: 60px;">Avail Stocks</th>
                        <th class="text-center" style="width: 60px;">Stock Level</th>
                        <th class="text-center" style="width: 60px;">Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $decodedPO_details = json_decode($po_details, true);
                    @endphp
                    @foreach ($decodedPO_details as $po_detail)
                        <tr>
                            <td class="text-center">{{ $po_detail['qty'] }}</td>
                            <td class="text-center">{{ $po_detail['unit_code'] }}</td>
                            <td>
                                <p class="fw-semibold mb-1">{{ $po_detail['brand_name'] }}</p>
                                {{-- <div class="text-muted">{{ $po_detail['item_id'] }}
                                </div> --}}
                            </td>
                            <td class="text-end">{{ $po_detail['unit_price'] }}</td>
                            <td class="text-end">{{ $po_detail['total_amount'] }}</td>
                            <td class="text-center">{{ $po_detail['qty'] }}</td>
                            <td class="text-center">N/A</td>
                            <td class="text-center">N/A</td>
                            <td class="text-center">N/A</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- END Table -->

        <!-- Footer -->
        <p class="fs-sm text-muted text-center">
            Thank you very much for doing business with us. We look forward to working with you again!
        </p>
        <!-- END Footer -->
    </div>
</div>