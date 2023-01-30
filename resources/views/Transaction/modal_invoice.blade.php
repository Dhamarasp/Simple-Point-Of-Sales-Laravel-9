<div class="modal fade" id="invoiceModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel"><b>Information</b></h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <br>
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header" style="background-color: rgb(190, 190, 54)">
                            <h4 class="text-center text-dark fw-bold">Transaction Invoice</h4>
                        </div>

                        <div class="card-body">
                            <div class="card-body">
                                <table class="table table-borderless table-responsive">
                                    <thead class="col-md-2">
                                        <tr>
                                            <td class="col-md-3">Date Of Transaction</td>
                                            <td>{{ $details->date }}</td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-0">Served By</td>
                                            <td>{{ $details->user->name }}</td>
                                        </tr>
                                    </thead>
                                </table>
                                <table class="table table-striped table-bordered table-responsive">
                                    <thead class="fw-bold">
                                        <td>No</td>
                                        <td>Item</td>
                                        <td>Qty</td>
                                        <td>Price</td>
                                    </thead>
                                    <tbody>
                                        @foreach ($details->detail as $item)
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->item->name }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>@rupiah($item->item->price)</td>
                                        @endforeach
                                    </tbody>
                                    <tr>
                                        <td colspan="3" class="text-end fw-bold">Grand Total</td>
                                        <td colspan="1">@rupiah($details->total)</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end fw-bold">Payment</td>
                                        <td colspan="1">@rupiah($details->pay_total)</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end fw-bold">Change</td>
                                        <td colspan="1">@rupiah($details->pay_total - $details->total)</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
        </div>
    </div>
</div>
