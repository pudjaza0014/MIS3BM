<?php
session_start();
session_destroy();
include("conn/dbConn.php");
$ObjRun = new Connetions();


$resultAll = $ObjRun->getDepartment();






$strErr = $_GET["strErr"];

if ($strErr <> null) {
    $strErr = "ลงทะเบียนไม่สำเร็จ กรุณาตรวจสอบข้อมูลอีกครั้ง";
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
                            <div class="col-lg-6 d-none d-lg-block bg-register-Mysite-image"></div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">สร้างบัญชีใหม่!</h1>
                                    </div>
                                    <form name="form1" method="post" action="controller/TestingController.php" class="user">
                                        <div class="form-group ">
                                            <input type="text" class="form-control input-Mysite" id="txtUsername" name="txtUsername" placeholder="ชื่อผู้ใช้" required>
                                        </div>
                                        <div class="form-group ">
                                            <input type="password" class="form-control input-Mysite" id="txtPassword" name="txtPassword" placeholder="รหัสผ่าน" required>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" class="form-control input-Mysite" id="txtName" name="txtName" placeholder="คำนำหน้า+ชื่อ" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control input-Mysite" id="txtSurName" name="txtSurName"  placeholder="นามสกุล" required>
                                            </div>
                                        </div>
                                        <div class="form-group ">

                                            <!-- <input type="text" class="form-control input-Mysite" id="exampleFirstName" placeholder="กลุ่มงาน" required> -->
                                            <select name="txtGroup" id="txtGroup" class="form-control input-Mysite" <?php if ($param1 <> "") {
                                                                                                                                echo "disabled =disabled";
                                                                                                                            }; ?> onchange="TestChange(this.value)" required>
                                                <option selected value="">เลือก...</option>

                                                <?php
                                                while ($obj1 = mysqli_fetch_object($resultAll)) {

                                                    echo "<option value='" . $obj1->DepartmentID . "'>" . $obj1->DepartmentName . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group ">
                                            <input type="text" class="form-control input-Mysite" id="txtTel" name="txtTel" minlength="10" maxlength="10" placeholder="เบอร์โทร" required>
                                        </div>

                                        <!-- <a href="login.html" class="btn btn-primary btn-user btn-block">
                                            Register Account
                                        </a> -->
                                        <div class='text-center'> <label class="  small text-danger "><?php echo $strErr; ?></label>
                                        <input type="hidden" name="action" value="regis" />
                                        <button type="submit" class="btn btn-mysite-blue btn-block">ลงทะเบียน</button>
                                        <hr>
                                    </form>
                                    <div class="text-center">
                                        <a class="small" href="login.php">มีบัญชีอยู่แล้ว? ไปหน้าเข้าสู่ระบบ!</a>
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