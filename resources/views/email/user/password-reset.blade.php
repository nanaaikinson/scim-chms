<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Password Reset</title>
</head>
<body>
<p>Hello {{ $data->first_name }},</p>
<p>We've received a request to reset your password. </p>
<p>New Password: <strong>{{ $data->password }}</strong></p>
<p>Thanks, <br> SCIM Administrator</p>
</body>
</html>
