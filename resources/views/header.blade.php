<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <nav>
        <ul>
            <li>{{\Auth::user()->name}}</li>
            <li>Unpaid Order</li>
            <li><a href="{{route('product.page')}}">Product</a></li>
            <li><a href="{{route('topup.page')}}">Top Up Balance</a></li>
            <li><a href="{{route('order.history')}}">Order History</a></li>
        </ul>
    </nav>
</body>
</html>