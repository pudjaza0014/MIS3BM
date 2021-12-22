<?php

include("conn/dbConn.php");
session_start();
$ssID = null;
if (count($_SESSION) <> 0) {
    $ssID = $_SESSION["Username"];
    // $ObjRun = new Connetions();
    // $results = $ObjRun->getOperatorUserName($ssID);
    // $rescnt = mysqli_num_rows($results);
    // $ObjResult = ($rescnt > 0 ? mysqli_fetch_array($results) : null);



}


?>

<script type="text/javascript">
    Sessionvalue = "<?php echo $ssID; ?>";
</script>
<!DOCTYPE html>
<html lang="en">

<?php include("head.php"); ?>
<style>



</style>

<body id="page-top">

    <?php
    $strTitle = 'ระบบจองห้องประชุม';
    $param1 = '';
    if (isset($_GET['MeetRoom'])) {
        $param1 = $_GET['MeetRoom'];
    }

    $strTitle = $param1;

    try {
        $ObjRun = new Connetions();
        $results = $ObjRun->getMeetingRoom($param1);
        $rescnt = mysqli_num_rows($results);
        $ObjResult = ($rescnt > 0 ? mysqli_fetch_array($results) : null);
        $strTitle = ($ObjResult == null ? "ระบบจองห้องประชุม" : $ObjResult["RoomName"]);


 
        $resultAll = $ObjRun->getMeetingRoomAll();
    } catch (Exception $e) {
        $strerr = 'Caught exception: ' .  $e->getMessage() . "\n";
    }






    ?>
    <script type="text/javascript">
        SessionMeetRoom = "<?php echo $param1; ?>";
    </script>
    <style>



    </style>
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include("menu_Sidebar.php"); ?>
        <div class="bg-image"></div>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column bg-gradient-Mysite ">

            <!-- Main Content -->
            <div id="content">
                <?php
                include("header.php")
                ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->

                    <div class="container">
                        <div class="card mb-4 bg-gradient-Mysite-card-calendar  ">
                            <div class="card-body">
                                <h1 class="h3 pt-2 text-gray-800"> <i class="far fa-calendar-alt"></i> <?php echo $strTitle; ?> </h1>
                                <!-- <h6 class="bg-gradient-Mysite-Text text-gray-500">Testing</h4> -->
                                <div>
                                    <div class="row">
                                        <div class="col">
                                            <input type="hidden" name="txtMeetingRoom" id="txtMeetingRoom" value="<?php echo $param1; ?>" />
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class='col-12 bg-gradient-Mysite-calendar'>
                                        <div id='calendar'></div>
                                        <?php
                                        include("deptColorGroup.php")
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div>
                            <div class="cardtest">

                            </div>
                            <span>Testing</span>
                        </div> -->

                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <!-- <span>Copyright &copy; Your Website 2020</span> -->
                        <span>Region Health Office 3</span>
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
    <!-- <script src='progress.js'></script> -->




    <!-- Modal -->
    <?php
    include("modals.php");
    ?>


</body>

</html>