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
        <div class="container">
         <div class="row">
            <div class="col-lg-12">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0"> 
                <div class="navbar-header py-2 px-2">
                    <img alt="LOGO" class="" src="images/logo-only.png" style="width:50px;height:55px" />
                    <strong>Tender Pro</strong>
                </div>
                
                   <ul class="nav navbar-top-links navbar-right">
                    @if(empty(session('logged_user_object')))  
                        <li >
                            <a href="/login">
                                <i class="fa fa-user"></i> &nbsp;Login
                            </a>
                        </li>
                        <li >
                            <a href="/login">
                                <i class="fa fa-user-plus"></i> &nbsp;Register
                            </a>
                        </li>
                    
                    @else
                       <li><i class="fa fa-user-circle-o fa-2x"></i> </li>
                       <li>
                          
                          <span class="m-r-sm text-muted welcome-message"> &nbsp;<strong>{{ session()->get('logged_user_object')->firstname }} {{ session()->get('logged_user_object')->lastname }}</strong></span>
                        </li>   
                        <li>
                            <a href="/user/logout">
                                <i class="fa fa-sign-out"></i>Log out
                            </a>
                        </li>
                    @endif
                    </ul>
                
                </nav>

                <hr>
            </div>
         </div>
            
                @yield('content')
          
        </div>
     
           

       









        

</body>


</html>
