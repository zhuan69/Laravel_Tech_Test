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
   @foreach ($resultHistory as $item)
       @if (isset($item->product_id))
           <div>
               <p>{{$item->order_no}} {{$item->total_price}}</p>
               <p>{{$item->product->product_name}} that cost {{$item->product->price}}</p>
               @if (isset($item->payment))
                   <p>{{$item->shipping_code}}</p>
               @else
                   <a href="{{route('payorder.page',['id'=>$item->id])}}"><button type="submit">Pay Now</button></a>
               @endif
           </div>
       @else
       <div>
        <p>{{$item->order_no}} {{$item->total_price}}</p>
        <p>{{$item->topUpHistory->value}} for number {{$item->topUpHistory->phone_number}}</p>
        <p>{{$item->order_status}}</p>
    </div>
       @endif
   @endforeach
   <div>    
   {{$resultHistory->links()}}
</div>
</body>
</html>