@extends('layout.dashboard')
@section('title', 'Stock')
@section('content')
@if (session('success'))
    <div class="alert alert-success alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            <b>Success:</b>
            {{ session('success') }}
        </div>
    </div>
@endif
@if (session('fail'))
    <div class="alert alert-danger alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            <b>Fail:</b>
            {{ session('fail') }}
        </div>
    </div>
@endif
@if (session('err'))
    <div class="alert alert-danger alert-dismissible show fade">
        <div class="alert-body">
            <button class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
            <b>Error:</b>
            {{ session('err') }}
        </div>
    </div>
@endif
<div class="p-2">
    <h4>Dashboard</h4>
    <h6 class="font-weight-light">Dashboard / Stock / <span class="font-weight-bold"> Stock History </span></h6>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Tabel Stok</h4>
                <div class="card-header-form">
                    <div class="input-group">
                        <div class="input-group-btn">
                            <button class="btn btn-primary" type="button" data-toggle="modal"
                                data-target="#addStockModal"><i class="fas fa-plus"></i> Tambah Produk Baru</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>Staff</th>
                            <th>Product</th>
                            <th>Total Stock</th>
                            <th>Description</th>
                            <th>status</th>
                            <th>Date</th>
                        </tr>
                        @forelse ($historys as $history)
                            <tr>
                                <td>{{ $history->user->name }}</td>
                                <td>{{ $history->stock->namaProduk ?? ''}}</td>
                                <td>{{ $history->total_stock}}</td>
                                <td>{{ $history->description }}</td>
                                <td>{{ $history->status }}</td>
                                <td> ff </td>
                            </tr>

                        @empty
                            <tr>
                                <td colspan="4" class="text-center">Belum ada data</td>
                            </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
