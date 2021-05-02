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

        <script src="js/jquery-3.1.1.min.js"></script>
        <script src="js/bootstrap.min.js"></script>

    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @include('include.header')
                </div>
            </div>
            <div class="row">
                <div  class="col-3">
                    <nav class="navbar-default navbar-static-side" role="navigation">
                    <div class="sidebar-collapse">
                        <ul class="nav metismenu" id="side-menu">
                            <li class="nav-header" >
                                <center>
                                    <div> <i class="fa fa-desktop text-white fa-3x py-2" ></i></div>

                                    @if(session()->get(config("global.session_user_obj"))->um_user_role_id === config("global.user_role_admin"))
                                    <strong class="text-white">Admin Dashboard</strong>
                                    @else
                                    <strong class="text-white">My Account</strong>
                                    @endif

                                </center>
                            </li>

                            <?php
                            $ar_per=json_decode(session()->get(config("global.session_permissions")),true);

                            ?>

                              @foreach ($ar_per as $permission)
                              <li>
                                <a href="/account/{{$permission["url_path"] }}"><i class="fa fa-folder-o"></i><span class="nav-label">{{$permission["tab_name"] }}</span></a>
                              </li>
                              @endforeach






                        </ul>

                    </div>
                </nav>

                </div>

                <div class="col-9">
                    @yield('content')
                </div>
            </div>
        </div>
    </body>
</html>

