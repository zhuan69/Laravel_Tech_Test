<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @include('header')
    <form action="{{route('product.order')}}" method="post">
        @csrf
        <textarea name="product_name" id="" cols="30" rows="10" placeholder="Product"></textarea>
        <textarea name="shipping_address" id="" cols="30" rows="10" placeholder="Shipping Address"></textarea>
        <input type="number" name="price" id="" placeholder="Price">
        <button type="submit">Submit</button>
    </form>
</body>
</html>