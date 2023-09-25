<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rubiks Cube - @yield('title')</title>
</head>
<body>
<section>
    <ul>
        <li>Home</li>
        <li>Product</li>
        <li>Information</li>
        <li>Q&A</li>
    </ul>
    <p>This is header</p>
</section>

@yield('content')

<section>
    <p>@2023</p>
    <p>This is footer</p>
</section>

</body>
</html>
