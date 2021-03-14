<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1 style="color: red;">{{ $details['title'] }}</h1>
    <h2>Hellow <span style="color: cyan;">{{ $details['name'] }}</span> !</h2>
    <p>{{ $details['body'] }}</p>
    <p style="color: cyan">Thank You</p>
    <a href="{{ route('homepage') }}" style="color: blue">Go to website</a>

</body>
</html>
