@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-4">Stock Out Form</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ url('/stock-out') }}" method="POST">
        @csrf

        <!-- Product -->
        <div class="mb-3">
            <label>Product</label>
            <select name="product_id" class="form-control" required>
                <option value="">Select Product</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">
                        {{ $product->name }} (Stock: {{ $product->stock }})
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Quantity -->
        <div class="mb-3">
            <label>Quantity</label>
            <input type="number" name="quantity" class="form-control" required>
        </div>

        <!-- Remarks -->
        <div class="mb-3">
            <label>Remarks</label>
            <textarea name="remarks" class="form-control"></textarea>
        </div>

        <!-- Submit -->
        <button type="submit" class="btn btn-danger">
            Remove Stock
        </button>

    </form>

</div>

@endsection