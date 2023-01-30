@extends('layouts.app')
@section('title', "Category")

@section('content')
<div class="container">
    @include('layouts.msg')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Category</h4>
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
                            <td>Category Name</td>
                            <td>Action</td>
                        </thead>
                        @foreach ($categories as $key => $kategori)
                        <tr class="align-middle text-center">
                            <td>{{ $categories->firstItem() +$key }}</td>
                            <td>{{ $kategori->name }}</td>
                            <td>
                                <a href="" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#categoryModal-{{ $kategori->id }}">Edit</a>
                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#modalHapus-{{ $kategori->id }}">Delete</button>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Add Category</h4>
                </div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    <form class="" action="{{ route('category.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <h5><b>Category Name</b></h5>
                            <input class="form-control @error('name') is-invalid @enderror" type="text"
                                value="{{ old('name') }}" name="name" id="name">
                            <div class="invalid-feedback">
                                @error('name')
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

@include('Category.edit')
@include('Category.delete')
@endsection
