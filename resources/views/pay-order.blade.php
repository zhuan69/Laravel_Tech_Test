<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @include('header')
    <form action="{{route('payment.order',['id'=>$order->id])}}" method="post">
        @csrf
        <input type="text" hidden name="id" value="{{$order->id}}">
        Order No : <input type="text" readonly placeholder="{{$order->order_no}}">
        <button type="submit">Pay Now</button>
    </form>
</body>
</html>