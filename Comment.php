<?php
session_start();
$ssID = null;
if (count($_SESSION) <> 0) {
    $ssID = $_SESSION["Username"];
}

$strTitle = 'ระบบจองห้องประชุม';
$param1 = '';
if (isset($_GET['Reserv'])) {
    $param1 = $_GET['Reserv'];
}
?>

<script type="text/javascript">
    Sessionvalue = "<?php echo $ssID; ?>";
</script>
<!DOCTYPE html>
<html lang="en">

<?php include("head.php"); ?>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include("menu_Sidebar.php");

        $ObjRun = new Connetions();
        $results = $ObjRun->getMeetingRoom($param1);
        $rescnt = mysqli_num_rows($results);
        $ObjResult = ($rescnt > 0 ? mysqli_fetch_array($results) : null);


        $resultAll = $ObjRun->getMeetingRoomAll();


        ?>




        <div class="bg-image"></div>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column bg-gradient-Mysite ">
            <!-- Main Content -->
            <div id="content">
                <?php
                include("header.php")
                ?>
                <!-- Begin Page Content -->
                <div class="container">
                    <!-- Page Heading -->
                    <div class='row'>
                        <div class="col-lg-12">
                            <a href="Index.php" class="btn btn-link ml-1 "><i class="fas fa-caret-left"></i> กลับสู่หน้าหลัก</a>
                        </div>
                    </div>
                    <div class='row'>

                        <!-- <div class="col-lg"></div> -->
                        <div class="col-lg">
                            <div class=" ">
                                <div class="card mb-4 bg-gradient-Mysite-card-calendar  ">
                                    <div class="card-body">

                                    <h1 class="h3 pt-2 text-gray-800"> <i class="far fa-calendar-alt"></i> <span id="txtHeader">ข้อเสนอแนะ</span></h1>

<hr>
                                    <div class="row">
                                        <div class="col-lg-5 d-none d-lg-block bg-comment-Mysite-image"> 
                                        </div>
                                        <div class="col-lg-7">
                                           
                                            <div class="row">
                                                <div class='col-12 bg-gradient-Mysite-calendar'>
                                                    <form name="formReservation" id="formReservation" method="post" onSubmit=" doComment(); return false;">


                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1"><i class="fas fa-comment-dots"></i> คุณอยากจะบอกอะไรเรา..</label>
                                                            <textarea type="text" class="form-control input-Mysite" name="txtComment" id="txtComment" style="height: 151px;" value=""></textarea>

                                                            <small id="emailHelp" class="form-text text-muted">- ข้อเสนอแนะ ติชม website.</small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="exampleInputPassword1">ชื่อ - สกุล</label>
                                                            <input type="text" class="form-control" id="txtName">
                                                        </div>
                                                        <button type="submit" class="btn btn-primary">ส่งข้อความ</button>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- <button onclick="ClearEvents(); ">tst</button> -->

    <!-- Bootstrap core JavaScript-->
    <script src="lib/sb-admin-2/vendor/jquery/jquery.min.js"></script>
    <script src="lib/sb-admin-2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="lib/sb-admin-2/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="lib/sb-admin-2/js/sb-admin-2.min.js"></script>
    <script src="lib/datePicker/datepicker.js"></script>
    <script src='scrip.js'></script>
    <script src='progress.js'></script>
    <script type="text/javascript">
        SessionReserv = "<?php echo $param1; ?>";




        // alert(SessionReserv);
    </script>
    <!-- Modal -->

</body>

</html>