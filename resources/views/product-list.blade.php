<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @foreach ($resultIndex as $item)
        <p>{{$item->id}}</p>
        <p>{{$item->product_name}}</p>
        <p>{{$item->price}}</p>
    @endforeach
</body>
</html>