<?php
session_start();
session_destroy();

$strErr = $_GET["strErr"];

if ($strErr <> null) {
    $strErr = "Username หรือ Password ไม่ถูกต้อง!!";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->

    <link href="lib/sb-admin-2/css/sb-admin-2.css" rel="stylesheet">

    <link href='progress_style.css' rel='stylesheet' />
    <link href='lib/Mysite/mysite.css' rel='stylesheet' />
</head>
<!-- <div class='progress' id="progress_div">
    <div class='bar' id='bar1'></div>
    <div class='percent' id='percent1'></div>
</div>
<input type="hidden" id="progress_width" value="0"> -->

<body class="bg-gradient-Mysite-Login">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5 bg-gradient-Mysite-card-Login">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block p-4 ">
                                <img src="lib\Mysite\img\logo.png" >
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">เข้าสู่ระบบ</h1>
                                    </div>
                                    <form name="form1" method="post" action="controller/TestingController.php" class="user">
                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="txtUserName" name="txtUserName" role="$_SERVER" placeholder="ชื่อผู้ใช้..." autocomplete="off" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="txtPassword" name="txtPassword" role="$_SERVER" placeholder="รหัสผ่าน" autocomplete="off" required>
                                            </div><div class='text-center'> <label class="  small text-danger "><?php echo $strErr; ?></label>
                                        </div> 
                                        <input type="hidden" name="action" value="login" />
                                        <button type="submit" name="btnsubmit" id="btnsubmit" class="btn btn-outline-primary btn-user btn-block">
                                        เข้าสู่ระบบ
                                        </button>
                                     </form>
                                    <hr>

                                    <!-- <div class="text-center">
                                        <a class="small" href="forgot-password.html">Forgot Password?</a>
                                    </div>-->
                                    <div class="text-center">
                                        <a class="small" href="register.php">สร้างบัญชีใหม่!</a>
                                    </div> 
                                    <div class="text-center">
                                        <a class="small" href="Index.php">กลับสู่หน้าหลัก</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <style>
       
    </style>
    <!-- Bootstrap core JavaScript-->
    <script src="lib/sb-admin-2vendor/jquery/jquery.min.js"></script>
    <script src="lib/sb-admin-2vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="lib/sb-admin-2vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="lib/sb-admin-2js/sb-admin-2.min.js"></script>
    <script src='scrip.js'></script>
    <script src='progress.js'></script>
</body>

</html>