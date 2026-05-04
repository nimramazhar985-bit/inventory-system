@extends('layouts.app')

@section('content')

<h2>Stock Report</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Product</th>
            <th>Type</th>
            <th>Quantity</th>
            <th>Date</th>
        </tr>
    </thead>

    <tbody>
        @foreach($transactions as $t)
        <tr>
            <td>{{ $t->product