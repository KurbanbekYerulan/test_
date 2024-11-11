<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movement Report</title>
</head>
<body>
<h1>Movement Report by Products and Groups</h1>

<form action="{{ route('movements.report') }}" method="GET">
    <label for="group_id">Filter by Group:</label>
    <select name="group_id" id="group_id">
        <option value="">All Groups</option>
        @foreach($groups as $group)
            <option value="{{ $group->id }}" {{ request('group_id') == $group->id ? 'selected' : '' }}>
                {{ $group->name }}
            </option>
        @endforeach
    </select>

    <label for="product_id">Filter by Product:</label>
    <select name="product_id" id="product_id">
        <option value="">All Products</option>
        @foreach($products as $product)
            <option value="{{ $product->id }}" {{ request('product_id') == $product->id ? 'selected' : '' }}>
                {{ $product->name }}
            </option>
        @endforeach
    </select>

    <button type="submit">Apply Filters</button>
</form>

<table border="1">
    <thead>
    <tr>
        <th>Product Name</th>
        <th>Group Name</th>
        <th>Quantity</th>
        <th>From Warehouse</th>
        <th>To Warehouse</th>
        <th>Moved At</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($movements as $movement)
        <tr>
            <td>{{ $movement->product->name }}</td>
            <td>{{ $movement->product->group->name }}</td>
            <td>{{ $movement->quantity }}</td>
            <td>{{ $movement->from_warehouse }}</td>
            <td>{{ $movement->to_warehouse }}</td>
            <td>{{ $movement->moved_at }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
