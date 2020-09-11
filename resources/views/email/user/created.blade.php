<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title></title>
</head>

<body>
<p>Hello {{ $data['name'] }}!</p>
<p>An account for you has been created in SCIM's Church Management System.</p>
<p>To get started, click this link <a href="{{ url('/') }}">SCIM Church Management System</a>.</p>
<p>For future reference, your username is your email address and your password is
  <strong>{{ $data['password'] }} </strong>
  until you update your password</p>
<p>Thanks,</p>
<p>SCIM Administrator</p>
</body>

</html>
