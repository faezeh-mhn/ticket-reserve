<html>
<head>
    <meta charset="UTF-8">
    <title>LoginPage</title>
</head>
<body>
{{--<form action="{{route('auth.Register')}}" method="post">--}}
    @csrf
    <input type="text" id="email" name="email">
    <input type="text" id="password" name="password">
    <input type="text" id="name" name="name">
    <input type="text" id="lastname" name="lastname">
    <input type="submit" name="submit" value="submit">
</form>
</body>
</html>
