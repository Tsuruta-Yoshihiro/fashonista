<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <!--CSRF Token-->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        {{--各ページごとにtitleタグをいれる@yield--}}
        <title>@yield('title')</title>
        
        <!--Scripts-->
        <script src="{{ secure_asset('js/app.js') }}" defer></script>
        <script scr="{{ secure_asset('js/mypages.js') }}" defer></script>
        
        <!--Fonts-->
        <link rel="dns-prefetch" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
        <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">
        
        <!--Style-->
        <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ secure_asset('css/mypages.css') }}" rel="stylesheet">
    </head>
    <body>
        
        <div id="app">
             @include('nav')
            
            <main class="py-4">
                {{--コンテンツをここに入れるため@yieldで空けておく。--}}
                @yield('content')
            </main>
        </div>
    </body>
</html>