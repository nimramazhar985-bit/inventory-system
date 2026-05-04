@extends('layouts.app')

@section('content')

<div class="container">

    <h2 class="mb-3">Stock Management</h2>

    {{-- ================= STOCK IN FORM (AJAX) ================= --}}
    <div class="card p-3 mb-4">

        <h4>Stock In Form</h4>

        <meta name="csrf-token" content="{{ csrf_token() }}">

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

{{-- ================= AJAX SCRIPT ================= --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function(){

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

                // optional: page reload table refresh
                location.reload();
            },

            error: function(){
                $('#msg').html("<div class='alert alert-danger'>Error Occurred</div>");
            }
        });

    });

});
</script>

@endsection