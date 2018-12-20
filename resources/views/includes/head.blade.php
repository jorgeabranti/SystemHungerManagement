<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Hunger Management</title>
    <!-- Scripts -->
 <!--   <script src="{{ asset('/js/app.js') }}"></script>-->

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="{{ asset('/js/jquery-3.3.1.min.js') }}" type="text/javascript" ></script>
    <script src="{{ asset('/js/bootstrap.min.js') }}" type="text/javascript" ></script> 
    <script src="{{ asset('/js/jquery.scrollTo.min.js') }}" type="text/javascript" ></script>
    <script src="{{ asset('/js/jquery.nicescroll.js') }}" type="text/javascript"></script>
    <script src="{{ asset('/js/jquery.sparkline.js') }}" type="text/javascript" ></script>
    <!-- Styles -->
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style-responsive.css') }}" rel="stylesheet">
    <link href="{{ asset('/glyphicons/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/style.css')}}" rel="stylesheet">
    <link href="{{ asset('/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{ asset('/font-brush-script-mt/css/font-brush-script-mt.css')}}" rel="stylesheet">
    <link href="{{ asset('/css/sidebarmenu.css')}}" rel="stylesheet">
    <link href="{{ asset('/lineicons/style.css')}}" rel="stylesheet"> 
</head>