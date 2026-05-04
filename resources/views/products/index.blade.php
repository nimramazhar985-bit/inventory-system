<h1>Products Page</h1>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
    </tr>

    @foreach($products as $product)
    <tr>
        <td>{{ $product->id }}</td>
        <td>{{ $product->name }}</td>
    </tr>
    @endforeach
</table>