<!DOCTYPE html>
<html>
    <head>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Krishan') }}</title> --}}
    <title>Tender Pro</title>

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
   <link href="css/plugins/select2/select2.min.css" rel="stylesheet">
    <link href="css/plugins/dataTables/datatables.min.css" rel="stylesheet">
    <link href="css/sweetalert.css" rel="stylesheet">
   <link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">





    </head>
    <body>
        <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <div class="row">
                    <img alt="LOGO" class="" src="images/logo-only.png" style="width: 8%;height: 8%;" />

                </div>
                <div class="row d-flex justify-content-end m-r-xs">
                    <p>
                        <button class="btn btn-success " type="button"><i class="fa fa-sign-in"></i>&nbsp;Login</button>
                        <button class="btn btn-success " type="button"><i class="fa fa-user-plus"></i>&nbsp;Register</button>
                    </p>
                </div>
                <hr>
            </div>

        </div>
        </div>
        <div>
            <div>
                @yield('content')
            </div>

        </div>









    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script type="text/javascript" src="js/sweetalert.min.js"></script>
    <!-- Custom and plugin javascript -->
    <script src="js/inspinia.js"></script>
    <!-- Select2 -->
    <script src="js/plugins/select2/select2.full.min.js"></script>
    <!-- Data picker -->
    <script src="js/plugins/datapicker/bootstrap-datepicker.js"></script>
    {{-- data table --}}
    <script src="js/plugins/dataTables/datatables.min.js"></script>
    <script src="js/plugins/dataTables/dataTables.bootstrap4.min.js"></script>
    <script type="text/javascript" src="js/sweetalert.min.js"></script>

    @yield('footer')
</body>

</html>
