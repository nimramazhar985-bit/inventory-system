@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">Dashboard</h2>

    <div class="row">

        <!-- Products -->
        <div class="col-md-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-body text-center">
                    <h5>Total Products</h5>
                    <h2>{{ $productsCount }}</h2>
                </div>
            </div>
        </div>

        <!-- Total Stock -->
        <div class="col-md-3">
            <div class="card text-white bg-success mb-3">
                <div class="card-body text-center">
                    <h5>Total Stock</h5>
                    <h2>{{ $totalStock }}</h2>
                </div>
            </div>
        </div>

        <!-- Stock In -->
        <div class="col-md-3">
            <div class="card text-white bg-info mb-3">
                <div class="card-body text-center">
                    <h5>Stock In</h5>
                    <h2>{{ $stockIn }}</h2>
                </div>
            </div>
        </div>

        <!-- Stock Out -->
        <div class="col-md-3">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body text-center">
                    <h5>Stock Out</h5>
                    <h2>{{ $stockOut }}</h2>
                </div>
            </div>
        </div>

    </div>

    <!-- Low Stock Alert -->
    <div class="card mt-4">
        <div class="card-header bg-warning">
            Low Stock Alert
        </div>
        <div class="card-body">
            <h4>{{ $lowStock }} Products are low in stock</h4>
        </div>
    </div>

</div>

@endsection