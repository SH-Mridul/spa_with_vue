<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>SPA</title>
        <link rel='stylesheet' href="{{ asset('css/app.css') }}">
        <link href="{{asset('alertify/css/alertify.min.css')}}" rel="stylesheet" />
    </head>
    <body>
        
        <div id="app">
            <app-header class="mb-3"></app-header>
            <router-view></router-view>
        </div>
    </body>
    <script src="{{asset('alertify/alertify.min.js')}}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    
</html>
