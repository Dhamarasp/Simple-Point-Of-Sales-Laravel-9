@extends('layouts.app')
@section('title', "Item")

@section('content')
<div class="container">
    @include('layouts.msg')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Item</h4>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <table class="table table-striped table-bordered table-responsive">
                        <thead class="text-center fw-bold">
                            <td>No</td>
                            <td>Category</td>
                            <td>Item Name</td>
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
                                <a href="" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#itemModal-{{ $item->id }}">Edit</a>
                                <a href="" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#itemDelete-{{ $item->id }}">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    {{ $items->links() }}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Add Item</h4>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form class="" action="{{ route('item.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="kategori">
                                <h5 class="fw-bold">Category</h5>
                            </label>
                            <select class="form-control form-select" type="text" name="category_id" id="kategori">
                                <option value="" selected disabled>Select Category</option>
                                @foreach ($categories as $kategori)
                                <option @if( $kategori->id == old('category_id') ) selected @endif value="{{ $kategori->id }}">{{ $kategori->name }}</option>    
                                @endforeach
                            </select>
                            <br>

                            <label for="name">
                                <h5 class="fw-bold">Item Name</h5>
                            </label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name">
                            <div class="invalid-feedback">
                                @error('name')
                                    {{ $message }}
                                @enderror
                            </div>
                            <br>
                            <label for="price">
                                <h5 class="fw-bold">Price</h5>
                            </label>
                            <input class="form-control @error('price') is-invalid @enderror" type="number" min="0" name="price" id="price">
                            <div class="invalid-feedback">
                                @error('price')
                                    {{ $message }}
                                @enderror
                            </div>
                            <br>
                            <label for="stock">
                                <h5 class="fw-bold">Stock</h5>
                            </label>
                            <input class="form-control @error('stock') is-invalid @enderror" type="number" min="0" name="stock" id="stock">
                            <div class="invalid-feedback">
                                @error('stock')
                                    {{ $message }}
                                @enderror
                            </div>
                            <br>
                        </div>
                        <div class="d-flex gap-2 align-items-center">
                            <button class="w-50 btn btn-sm btn-success" type="submit">Add</button>
                            <button class="w-50 btn btn-sm btn-danger" type="reset">Reset</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@include('Item.delete')
@include('Item.edit')
@endsection