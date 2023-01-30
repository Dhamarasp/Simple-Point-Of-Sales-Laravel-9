@extends('layouts.app')
@section('title', "Home")

@section('content')
@include('layouts.msg')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <p>Hai, Selamat Datang <b>{{ Auth::user()->name }}</b></p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
