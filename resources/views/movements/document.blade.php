<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movement Document</title>
</head>
<body>
<h1>Movement Document</h1>

@if (session('success'))
    <p>{{ session('success') }}</p>
@endif

@if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
@endif

<p><strong>Product:</strong> {{ $movement->product->name }}</p>
<p><strong>Quantity:</strong> {{ $movement->quantity }}</p>
<p><strong>From Warehouse:</strong> {{ $movement->from_warehouse }}</p>
<p><strong>To Warehouse:</strong> {{ $movement->to_warehouse }}</p>

<form action="{{ route('movements.document.edit', $movement->id) }}" method="POST">
    @csrf
    <h2>Edit Document</h2>

    <label for="admin_password">Administrator Password:</label>
    <input type="password" name="admin_password" id="admin_password" required>

    <label for="quantity">Quantity:</label>
    <input type="number" name="quantity" id="quantity" value="{{ $movement->quantity }}" required>

    <label for="from_warehouse">From Warehouse:</label>
    <input type="text" name="from_warehouse" id="from_warehouse" value="{{ $movement->from_warehouse }}" required>

    <label for="to_warehouse">To Warehouse:</label>
    <input type="text" name="to_warehouse" id="to_warehouse" value="{{ $movement->to_warehouse }}" required>

    <button type="submit">Submit Changes</button>
</form>
</body>
</html>
