<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Blog') }}</title>
    {{--  Count how many images exists in img/ folder and choose a random one 
          for background.  --}}
    @php
        $files = Storage::allFiles('public/img/');
        $randomNum = rand(1, count($files));
        $pathWithName = 'assets/img/' . $randomNum . '.jpg';
    @endphp

    <style>
        body {
            background-image: url("{{ asset($pathWithName) }}");
            background-color: #cccccc;
        }
    </style>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{--  <link rel="stylesheet"          // Animate.css
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">  --}}

</head>
<body>
    <div id="app">
        @include('inc.navbar')
        <div class="container">
            @include('inc.messages')
            @yield('content')
        </div>
    </div>
    <div class="container text-center">
    <hr/>
</div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script type="text/javascript" src="{!! asset('js/script.js') !!}"></script>
    <script>
        CKEDITOR.replace( 'article-ckeditor' );
    </script>
</body>
</html>
