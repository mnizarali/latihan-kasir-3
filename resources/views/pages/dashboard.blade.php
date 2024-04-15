@extends('layout.dashboard')
@section('title', 'Dashboard')
@section('content')
<!-- Main Content -->
<div class="p-2">
    <h4>Dashboard</h4>
    <h6 class="font-weight-light">Dashboard / <span class="font-weight-bold"> Home </span></h6>
</div>
<section class="section pt-3">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Account</h4>
                    </div>
                    <div class="card-body">
                        {{ $countUser}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Account</h4>
                    </div>
                    <div class="card-body">
                        {{ $countUser}}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6 col-12">
            <div class="card card-statistic-1">
                <div class="card-icon bg-primary">
                    <i class="far fa-user"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Account</h4>
                    </div>
                    <div class="card-body">
                        {{ $countUser}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection