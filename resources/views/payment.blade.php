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
    <p>{{$order->order_status}}</p>
    <p>{{$order->order_no}}</p>
    @if (isset($order->product_id))
    <p>{{$order->product_name}} that costs {{$order->total_price}} will be shipped to :{{$order->address}} only after you pay</p>
    <form action="{{route('payment.order',['id'=>$order->id])}}" method="post">
        @csrf
        <button type="submit">Pay Now</button>
    </form>
    @else
        @if ($order->order_status === 'Failed')
        <p>Your Balance Top Up has failed, suggest Top Up when 9 AM to 5 PM for 90% Success Rate</p>
        <a href="{{route('order.history')}}">To History Order</a>    
        @else
        <p>Your mobile phone number  {{$order->phone}} will receive Rp {{$order->value}}</p>
        <form action="{{route('payment.order',['id'=>$order->id])}}" method="post">
            @csrf
            <button type="submit">Pay Now</button>
        </form>    
        @endif
    @endif
</body>
</html>