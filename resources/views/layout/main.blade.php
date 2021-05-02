<!DOCTYPE html>
<html>
    <head>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Tender Pro') }}</title> --}}
    <title>Tender Pro</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="css/plugins/slick/slick.css" rel="stylesheet">
    <link href="css/plugins/slick/slick-theme.css" rel="stylesheet">


   <script src="js/jquery-3.1.1.min.js"></script>
   <script src="js/bootstrap.min.js"></script>
  <!-- <script src="js/popper.min.js"></script>-->
    <!--<script src="js/bootstrap.min.js"></script> -->
   <!-- <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>-->
  
    </head>
    <body>
    <div class="container-fluid">
         <div class="row">
            <div class="col-md-12">
                @include('include.header')
            </div>
         </div>
            @yield('content')
     </div>
     
           

       









        

</body>


</html>
