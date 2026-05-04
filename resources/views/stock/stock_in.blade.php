@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-3">Stock Management System</h2>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- ================= STOCK IN FORM ================= --}}
    <div class="card p-3 mb-4">

        <h4>Stock In Form</h4>

        <form id="stockInForm">

            <label>Product</label>
            <select class="form-control" id="product_id">
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>

            <label class="mt-2">Quantity</label>
            <input type="number" class="form-control" id="quantity">

            <label class="mt-2">Remarks</label>
            <input type="text" class="form-control" id="remarks">

            <button class="btn btn-primary mt-3">Submit Stock In</button>

        </form>

        <div id="msg" class="mt-2"></div>

    </div>

    {{-- ================= STOCK OUT FORM ================= --}}
    <div class="card p-3 mb-4">

        <h4>Stock Out Form</h4>

        <form id="stockOutForm">

            <label>Product</label>
            <select class="form-control" id="out_product_id">
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>

            <label class="mt-2">Quantity</label>
            <input type="number" class="form-control" id="out_quantity">

            <label class="mt-2">Remarks</label>
            <input type="text" class="form-control" id="out_remarks">

            <button class="btn btn-danger mt-3">Submit Stock Out</button>

        </form>

        <div id="out_msg" class="mt-2"></div>

    </div>

    {{-- ================= STOCK TABLE ================= --}}
    <div class="card p-3">

        <h4>Stock Transactions</h4>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th>Type</th>
                    <th>Quantity</th>
                    <th>Remarks</th>
                </tr>
            </thead>

            <tbody>
                @foreach($stocks as $stock)
                    <tr>
                        <td>{{ $stock->id }}</td>
                        <td>{{ $stock->product->name ?? 'N/A' }}</td>
                        <td>
                            @if($stock->type == 'in')
                                <span class="text-success">IN</span>
                            @else
                                <span class="text-danger">OUT</span>
                            @endif
                        </td>
                        <td>{{ $stock->quantity }}</td>
                        <td>{{ $stock->remarks }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>

</div>

{{-- ================= SCRIPTS (AJAX BOTH IN + OUT) ================= --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function(){

    // ================= STOCK IN AJAX =================
    $('#stockInForm').submit(function(e){
        e.preventDefault();

        $.ajax({
            url: "{{ route('stock.in') }}",
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                product_id: $('#product_id').val(),
                quantity: $('#quantity').val(),
                remarks: $('#remarks').val()
            },

            success: function(response){
                $('#msg').html("<div class='alert alert-success'>" + response.message + "</div>");
                $('#stockInForm')[0].reset();
                location.reload();
            },

            error: function(){
                $('#msg').html("<div class='alert alert-danger'>Error Occurred</div>");
            }
        });
    });

    // ================= STOCK OUT AJAX =================
    $('#stockOutForm').submit(function(e){
        e.preventDefault();

        $.ajax({
            url: "{{ route('stock.out') }}",
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                product_id: $('#out_product_id').val(),
                quantity: $('#out_quantity').val(),
                remarks: $('#out_remarks').val()
            },

            success: function(response){
                $('#out_msg').html("<div class='alert alert-success'>" + response.message + "</div>");
                $('#stockOutForm')[0].reset();
                location.reload();
            },

            error: function(){
                $('#out_msg').html("<div class='alert alert-danger'>Error Occurred</div>");
            }
        });
    });

});
</script>

@endsection