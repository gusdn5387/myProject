<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <title>Laravel 5 Essential</title>
    @yield('style')
    @yield('script')
</head>
<body>
    @yield('content') {{--양도하다, 넘겨주다--}}
    @include('footer')
</body>
</html>