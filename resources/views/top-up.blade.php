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
    <form action="{{route('topup.post')}}" method="post">
    @csrf
    <input type="text" name="phone_number" placeholder="Number Phone" value="{{$phonePrefix}}" minlength="7" maxlength="12">
    <input type="number" name="price" placeholder="Value">
    <button type="submit">Top Up</button>
    </form>
</body>
</html>