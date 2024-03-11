<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h2>Hello {{$order->fullname}}</h2>
    <h3>Thank You for ordering from us</h3>
    <h3>Order Status :{{$order->status_message}}</h3>
    
    Thank You,
    Admin
</body>
</html>