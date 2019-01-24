<p>
    <!-- {{--$greeting--}} <-- Comment, 아예 출력이 안됨.. -->
    {{ $greeting }} {{ $name }}. Welcome Back~

    @extends('master') {{--상속--}}

    @section('style')
        <style>
            body {background: red;}
        </style>
    @stop

    @section('content')
     Your content here!!
    @stop

    @section('script')
        <script>
            alert('Hello Blade~ ^^/');
        </script>
    @stop
</p>
