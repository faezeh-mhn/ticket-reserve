<html>
<head>
    <meta charset="UTF-8">
    <title>LoginPage</title>
</head>
<body>
{{--<form action="{{route('auth.Login')}}" method="post">--}}
    @csrf
    <input type="text" id="email" name="email">
    <input type="text" id="password" name="password">
    <input type="submit" name="submit" value="submit">
</form>
</body>
</html>
