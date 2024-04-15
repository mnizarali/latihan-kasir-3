@extends('layout.dashboard')
@section('title', 'Invoice')
@section('content')
<div class="p-2"> 
    <h6 class="font-weight-light">Pembelian / <span class="font-weight-bold"> Confirm Payment </span></h6>
</div>
    <section class="section">
        <div class="section-body">
            <div class="card">
                <div class="card-header">
                    <h4>Informasi Pribadi</h4>
                </div>
                <div class="card-body d-flex flex-column justify-content-center">
                    <div class="row w-100 mb-3">
                        <div class="col-sm-6 col-12">
                            <b>Nama</b>
                        </div>
                        <div class="col-sm-6 col-12">
                            : {{ $nama }}
                        </div>
                    </div>
                    <div class="row w-100 mb-3">
                        <div class="col-sm-6 col-12">
                            <b>Alamat</b>
                        </div>
                        <div class="col-sm-6 col-12">
                            : {{ $alamat == null ? '-' : $alamat }}
                        </div>
                    </div>
                    <div class="row w-100 mb-3">
                        <div class="col-sm-6 col-12">
                            <b>No Phone</b>
                        </div>
                        <div class="col-sm-6 col-12">
                            : {{ $telp }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <h4>Informasi Penjualan</h4>
                </div>
                <div class="card-body d-flex flex-column justify-content-center">
                    <div class="row w-100 mb-3">
                        <div class="col-sm-6 col-12">
                            <b>Produk yang dibeli:</b>
                        </div>
                        <div class="col-sm-6 col-12 d-none d-sm-flex flex-column">
                            <b>Harga:</b>
                        </div>
                    </div>
                    @php
                        $totalPrice = 0;
                    @endphp
                    @foreach ($produks as $produk)
                        <div class="row w-100 mb-3">
                            <div class="col-sm-6 col-12">
                                - {{ $produk->namaProduk }} (Rp{{ number_format($produk->harga, 2, ',', '.') }})
                            </div>
                            <div class="col-sm-6 col-12">
                                @foreach ($products as $p)
                                    @if ($p['kode'] == $produk->kode)
                                        @php
                                            $price = $p['qty'] * $produk->harga;
                                            $totalPrice += $price;
                                            $harga = $produk->harga;
                                        @endphp
                                        {{ $p['qty'] }} x (Rp{{ number_format($harga, 2, ',', '.') }})
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endforeach

                    <div class="row w-100 mb-3">
                        <div class="col-sm-6 col-12">
                            <b>Total Dibayar:</b>
                        </div>
                        <div class="col-sm-6 col-12">
                            Rp{{ number_format($totalPrice, 2, ',', '.') }}
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <form action="" method="post">
                        @csrf
                        <a href="{{ route('dashboard.pembelian.direct') }}"  class="btn btn-success">Return to Menu</a>
                        <a href="{{ route('dashboard.pembelian.invoice') }}" target="_blank" class="btn btn-danger">Cetak Struk</a>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
