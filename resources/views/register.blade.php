<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{route('register.user')}}" method="post">
        @csrf
    <input type="email" name="email" id="" placeholder="Email">
    <input type="text" name="name" id="" placeholder="Name">
    <input type="password" name="password" id="" placeholder="password">
    <button type="submit">Submit</button>
    </form>
</body>
</html>