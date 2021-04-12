<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
</head>
<body>
    <h2 style="color: rgb(0, 255, 255);">Password reset link</h2>
    <h2>Dear <span style="color: cyan;">User</span> ,</h2>
    <p>You requested for password reset, please click bellow link to reset your password</p>
    <a href="{{ url('/password/forgot/'.$token.'/'.$email) }}" style="margin-top: 5px;margin-bottom: 5px;color:brown">reset link</a>
    <p style="color: cyan">Thank You</p>
    <a href="http://127.0.0.1:8000/" style="color: blue">Go to website</a>
</body>
</html>
