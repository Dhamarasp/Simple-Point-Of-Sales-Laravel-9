@extends('layouts.app')
@section('title', 'History')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header" style="background-color: black">
                        <h4 class="text-center text-light">History Transaction</h4>
                    </div>

                    <div class="card-body">
                        @if ($details->isEmpty())
                            <h3 class="text-center">Tokone Bangkrut</h3>
                        @else
                            <div class="card-body">
                                <table class="table table-bordered table-responsive">
                                    <thead class="fw-bold text-center">
                                        <td>No</td>
                                        <td>Date</td>
                                        <td>Nama Kasir</td>
                                        <td>Grand Total</td>
                                        <td>Pay Total</td>
                                        <td>Action</td>
                                    </thead>
                                    @foreach ($details as $key => $detail)
                                        <tr class="align-middle text-center">
                                            <td>{{ $details->firstitem() + $key }}</td>
                                            <td>{{ date('d F Y', strtotime($detail->created_at)) }}</td>
                                            <td>{{ $detail->user->name }}</td>
                                            <td>@rupiah($detail->total)</td>
                                            <td>@rupiah($detail->pay_total)</td>
                                            <td>
                                                <button id="btnShow" type="button"
                                                    class="btn btn-sm btn-primary" data-id="{{ $detail->id }}">Detail</button>
                                                {{-- <a href="{{ route('history.show', $detail->id) }}" class="btn btn-sm btn-primary">Detail</a> --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                                {{ $details->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('DetailTransaction.showHistory')
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('body').on('click', '#btnShow', function() {
                let history_id = $(this).data('id');

                $.get("/history/"+ history_id, function(details) {
                    let data = details
                    $('#date').html(data.date);
                    $('#kasir').html(data.user.name);
                    $('#total').html(data.total);
                    $('#payment').html(data.pay_total);
                    $('#change').html(data.change);
                    
                    let tableData = ""
                    data.detail.forEach((dt, index) => {
                        
                        tableData += `<tr class="align-middle">
                                            <td id="no"> ${++index} </td>
                                            <td id="item"> ${dt.item.name} </td>
                                            <td id="qty"> ${dt.qty} </td>
                                            <td id="price"> ${dt.item.price} </td>
                                        </tr>`
                    });

                    $('#table-detail').html(tableData)


                    $('#showHistory').modal('show');
                })
            });
        })
    </script>
@endsection
