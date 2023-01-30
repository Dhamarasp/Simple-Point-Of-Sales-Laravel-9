@extends('layouts.app')
@section('title', 'Transaction')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-header">
                        <h4>Transaction</h4>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        <div class="card-body">
                            @if ($items->isEmpty())
                                <tr>
                                    <div class="text-center" colspan="5">All Product Already In Cart</div>
                                </tr>
                            @else
                                <form class="d-flex" role="search">
                                    <input class="form-control me-2" type="search" placeholder="Search Product"
                                        aria-label="Search" name="key" value="{{ Request::get('key') }}">
                                    <button class="btn btn-outline-secondary" type="submit">Search</button>
                                </form>
                                <br>
                                <table class="table table-striped table-bordered table-responsive">
                                    <thead class="fw-bold text-center">
                                        <td>No</td>
                                        <td>Category</td>
                                        <td>Product</td>
                                        <td>Price</td>
                                        <td>Stock</td>
                                        <td>Action</td>
                                    </thead>
                                    @foreach ($items as $key => $item)
                                        <tr class="align-middle text-center">
                                            <td>{{ $items->firstitem() + $key }}</td>
                                            <td>{{ $item->kategori->name }}</td>
                                            <td>{{ $item->name }}</td>
                                            <td>@rupiah($item->price)</td>
                                            <td>{{ $item->stock }}</td>
                                            <td>
                                                <form action="{{ route('transaction.store') }}" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="item_id" value="{{ $item->id }}">
                                                    <input type="hidden" name="qty" value="1">
                                                    <button type="submit" class="btn btn-sm btn-primary text-light">Add to
                                                        cart</button>
                                                </form>
                                            </td>

                                        </tr>
                                    @endforeach
                                </table>
                                {{ $items->links() }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{-- // cart // --}}
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h4>Cart</h4>
                    </div>

                    <div class="card-body">
                        @if (session('statuscart'))
                            <div class="alert alert-secondary alert-dismissible fade show" role="alert">
                                {{ session('statuscart') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if (session('statuscartdelete'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('statuscartdelete') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                        @if (count($carts) > 0)
                            <table class="table table-striped table-responsive">
                                <thead class="fw-bold text-center">
                                    <td>No</td>
                                    <td>Item</td>
                                    <td>Qty</td>
                                    <td>Subtotal</td>
                                    <td>Action</td>
                                </thead>
                                @foreach ($carts as $item)
                                    <tr class="align-middle text-center">
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <form action="{{ route('transaction.update', $item->cart->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <td>
                                                <input class="form-control" id="qty" type="number" name="qty"
                                                    min="1" max="{{ $item->stock + $item->cart->qty }}"
                                                    value="{{ $item->cart->qty }}"
                                                    onchange="ubah{{ $loop->iteration }}(event)"
                                                    oninput="ubah{{ $loop->iteration }}(event)">
                                            </td>
                                            <td>@rupiah($item->price * $item->cart->qty)</td>
                                            <script>
                                                function ubah{{ $loop->iteration }}(e) {

                                                    document.getElementById("update{{ $loop->iteration }}").style.display = "inline";
                                                    document.getElementById("hapus{{ $loop->iteration }}").style.display = "none";

                                                    document.getElementById('qty_temp').value = e.target.value
                                                }
                                            </script>
                                            <td>
                                                <button id="update{{ $loop->iteration }}"
                                                    class="btn btn-sm btn-primary" style="display: none;">Update</button>
                                        </form>
                                        <form method="POST" action="{{ route('transaction.destroy', $item->cart->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" id="hapus{{ $loop->iteration }}"
                                                class="btn btn-sm btn-danger" style="display: ;">Delete</button>
                                        </form>
                                        </td>
                                    </tr>
                                @endforeach
                                <form action="{{ route('checkout') }}" method="POST">
                                    @csrf
                                    <tr>
                                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                                        <td colspan="3" class="text-end fw-bold">Grand Total</td>
                                        <td colspan="2"><input type="text" class="form-control" name="total"
                                                @php
                                                    $val_sum=$carts->sum(function($item){
                                                    return $item->price * $item->cart->qty;
                                                    }) 
                                                @endphp
                                            value="@rupiah($val_sum)"></td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" class="text-end fw-bold" >Payment</td>
                                                @php
                                                    $val_sum=$carts->sum(function($item){
                                                    return $item->price * $item->cart->qty;
                                                    }) 
                                                @endphp
                                        <td colspan="2">
                                            <input type="number"class="form-control @if (session('uangKurang')) is-invalid @endif @error ('pay_total') is-invalid @enderror" name="pay_total">
                                            <p class="m-0 mt-1" style="font-size: .875em;
                                            color: #ea868f;">
                                                @if (session('uangKurang'))
                                                    {{ session('uangKurang') }}
                                                @endif
                                            </p>
                                            <div class="invalid-feedback">
                                                @error('pay_total')
                                                    {{ $message }}
                                                    @enderror
                                                </div>
                                        </td>
                                    </tr>
                                    {{-- <tr>
                                        <td colspan="3" class="text-end fw-bold">Change</td>
                                        <td colspan="2"><input type="number" class="form-control" disabled></td>
                                    </tr> --}}
                                </table>
                                <div class="form-group text-end">
                                    <button type="submit" class="btn btn-sm btn-primary">Checkout</button>
                                    <button type="reset" class="btn btn-sm btn-danger">Reset</button>
                                </div>
                            </form>
                            @else
                            <h3 class="text-center">Add Product First!</h3>
                            @if (Session::has('details'))
                                 @include('Transaction.modal_invoice', ['details' => Session::get('details')])
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@if (Session::has('details'))
    <script>
        $(document).ready(function(){
            $("#invoiceModal").modal('show');
        })
    </script>
@endif
@endsection
