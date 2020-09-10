<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Stom</title>

        <!-- Styles -->
        <link href="{{'/css/bootstrap/bootstrap.min.css'}}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.0/css/all.css">
         <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
         <link href="{{'/css/style.css'}}" rel="stylesheet">
        <link href="{{'/css/simple-sidebar.css'}}" rel="stylesheet">
        <link href="{{'/css/reference.css'}}" rel="stylesheet">
        <link href="{{'/css/login-register.css'}}" rel="stylesheet">
        <link href="{{'/css/font-awesome.min.css'}}" rel="stylesheet">
          <link rel="stylesheet" href="{{'/css/intlTelInput.css'}}">
         <link href="https://cdn.rawgit.com/mdehoog/Semantic-UI/6e6d051d47b598ebab05857545f242caf2b4b48c/dist/semantic.min.css" rel="stylesheet" type="text/css" />

        <!-- Scripts -->
        <script src="{{'/js/jquery.min.js'}}"></script>
        <script src="{{'/js/bootstrap/bootstrap.js'}}"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
        <script src="{{'/js/main.js'}}"></script>
        <script src="{{'/js/statistic.js'}}"></script>
        <script src="{{'/js/reference.js'}}"></script>
        <script src="{{'/js/semantic.min.js'}}"></script>
        <script src="{{'/js/intlTelInput.js'}}"></script>
        <script src="{{'/js/js.js'}}"></script>
        



    </head>
    <body>



        @include('messages')
        @yield('content')



    </body>
</html>
