@extends('layouts.app')
@section('title', "Detail Transaction")

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header" style="background-color: black">
                    <h4 class="text-center text-light">Detail Transaction</h4>
                </div>

                <div class="card-body">
                    <div class="card-body">
                        <table class="table table-borderless table-responsive">
                            <thead class="col-md-2">
                                <tr>
                                    <td class="col-md-2">Date Of Transaction</td>
                                    <td>{{ date('d F Y', strtotime($details->created_at)) }}</td>
                                </tr>
                                <tr>
                                    <td class="col-md-0">Served By</td>
                                    <td>{{ $details->user->name }}</td>
                                </tr>
                            </thead>
                        </table>
                        <table class="table table-striped table-bordered table-responsive">
                            <thead class="fw-bold text-center">
                                <td>No</td>
                                <td>Item</td>
                                <td>Qty</td>
                                <td>Sub Total</td>
                            </thead>
                            @foreach ($details->detail as $item)
                            <tr class="align-middle text-center">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->item->name }}</td>
                                <td>{{ $item->qty }}</td>
                                <td>@rupiah($item->item->price * $item->qty)</td>
                            </tr>
                            @endforeach
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
                                @php
                                    $susuk = ($details->pay_total - $details->total)
                                @endphp
                                <td colspan="1">@rupiah($susuk)</td>
                            </tr>
                        </table>
                    </div>
                    <div class="form-group text-end">
                        <button onclick="history.back()" class="btn btn-sm btn-danger">Back</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
