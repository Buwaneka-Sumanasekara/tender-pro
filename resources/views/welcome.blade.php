<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="css/plugins/dataTables/datatables.min.css" rel="stylesheet">
        <link href="css/plugins/select2/select2.min.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <link href="css/sweetalert.css" rel="stylesheet">
        <link href="css/plugins/datapicker/datepicker3.css" rel="stylesheet">

    </head>
    <body >


        <body class="gray-bg">
            <div class="middle-box  loginscreen animated fadeInDown">
                <div>


                    <div class="ibox">
                        <div class="ibox-content">
                                <img src="img/logo.jpg" style="width: 100%;height: 100%">
                            <form action="adminLogin" method="POST">
                                {{ csrf_field() }}
                                <div class="form-group"><label>Email</label> <input type="text" placeholder="Enter email"
                                        class="form-control" name="username"></div>
                                <div class="form-group"><label>Password</label> <input type="password" placeholder="Password"
                                        class="form-control" name="password"></div>
                                <div>
                                    <button class="btn btn-sm btn-primary btn-block  m-t-n-xs" type="submit"><strong>Log
                                            in</strong></button><br>


                                </div>

                                <div>
                                    <button type="button" class="btn btn-sm btn-danger btn-block" data-toggle="modal"
                                        data-target="#forgetpass">Reset Password</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <center>
                        <p class="m-t"> <small>@ Richvil Bakers ePortal | 2019 </small> </p>
                    </center>
                </div>
            </div>




            <!-- Modal -->
            <div class="modal fade" id="forgetpass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-sm" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">Forgot Password</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group"><label>Email</label>
                                <input type="email" placeholder="Enter email" class="form-control" name=''>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning">Change Password</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

        </body>







        <!-- Mainly scripts -->
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


</html>
