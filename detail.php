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
    SessionMeetRoom = "";
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
    if (isset($_GET['Reserv'])) {
        $param1 = $_GET['Reserv'];
    }
    ?>

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
                    <div class='row'>
                        <div class="col-lg-12">
                            <a href="Index.php" class="btn btn-link ml-1 "><i class="fas fa-caret-left"></i> กลับสู่หน้าหลัก</a>
                        </div>
                    </div>
                    <div class='row'>
                        <!-- <div class="col-lg"></div> -->
                        <div class="col-lg-8">


                            <div class=" ">
                                <div class="card mb-4 bg-gradient-Mysite-card-calendar  ">
                                    <div class="card-body">
                                        <h1 class="h3 pt-2 text-gray-800"> <i class="far fa-calendar-alt"></i> <span id="txtHeader"></span></h1>
                                        <!-- <h6 class="bg-gradient-Mysite-Text text-gray-500">Testing</h4> -->
                                        <div>
                                            <div class="row">
                                                <div class="col">
                                                    <input type="hidden" name="txtMeetingRoom" id="txtMeetingRoom" />
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class='col-12 bg-gradient-Mysite-calendar'>
                                                <fieldset>
                                                    <div class="form-row mb-2">
                                                        <div class=" col-md-6 ">
                                                            <div class=row>
                                                                <div class="col-md-3 from-group">
                                                                    <label for="txtRoomID">RoomID</label>
                                                                    <input type="text" name="txtRoomID" id="txtRoomID" class="form-control-plaintext " value="TEST" readonly />
                                                                </div>
                                                                <div class="col-md-9 from-group">
                                                                    <label for="txtRoomName"><i class="far fa-handshake"></i> ห้องประชุม</label>

                                                                    <input type="text" name="txtRoomName" id="txtRoomName" class="form-control-plaintext " value="TEST" readonly />

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" col-md-6">
                                                            <div class=row>
                                                                <div class="col-md">
                                                                    <label for="txtLocation"><i class="far fa-building"></i> สถานที่ตั้ง</label>
                                                                    <input type="text" name="txtLocation" id="txtLocation" class="form-control-plaintext " value="TEST" readonly />
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row mb-2">
                                                        <div class=" col-md-6">
                                                            <div class=row>
                                                                <div class="col-md">
                                                                    <label for="txtMeetingTopic"><i class="fas fa-quote-left "></i> หัวข้อการประชุม</label>
                                                                    <input type="text" name="txtMeetingTopic" id="txtMeetingTopic" class="form-control-plaintext " value="TEST" readonly />
                                                                </div>
                                                            </div>
                                                            <div class=row>
                                                                <div class="col-md from-group">
                                                                    <div class=row>
                                                                        <div class="col-md">
                                                                            <label for="txtDescription"><i class="far fa-comment-dots"></i> คำอธิบาย</label>
                                                                            <textarea type="text" name="txtDescription" id="txtDescription" style="height: 151px;" class="form-control-plaintext " value="TEST" readonly></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class=row>
                                                                        <div class="col-md-6">

                                                                            <label for="txtTotalPeople"><i class="fas fa-users"></i> จำนวนผู้เข้าร่วมประมาณ</label>
                                                                            <input type="number" name="txtTotalPeople" id="txtTotalPeople" class="form-control-plaintext " value="2" readonly />

                                                                        </div>
                                                                        <div class="col-md-6">

                                                                            <label for="txtcolor"><i class="fas fa-users"></i> สี</label>
                                                                            <input type="color" name="txtcolor" id="txtcolor" class="form-control" value="TEST" readonly />

                                                                        </div>
                                                                    </div>
                                                                    <div class=row>
                                                                        <div class="col-md-7 from-group">
                                                                            <label for="txtBookerName"><i class="fas fa-user-edit"></i> ชื่อผู้จอง</label>
                                                                            <input type="text" name="txtBookerName" id="txtBookerName" class="form-control-plaintext " value="TEST" readonly />
                                                                        </div>
                                                                        <div class="col-md-5 from-group">
                                                                            <label for="txtBookerPhone"><i class="fas fa-phone-square-alt"></i> เบอร์โทรติดต่อ</label>
                                                                            <input type="text" name="txtBookerPhone" id="txtBookerPhone" class="form-control-plaintext " value="TEST" readonly />
                                                                        </div>
                                                                        <div class="col-md-12 from-group">
                                                                            <label for="txtGroupID"><i class="fas fa-users"></i> กลุ่มงาน</label>
                                                                            <input type="text" name="txtGroupID" id="txtGroupID" class="form-control-plaintext " value="TEST" readonly />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class=" col-md-6 ">
                                                            <div class="row ">
                                                                <div class="col-md-6 from-group">
                                                                    <label for="txtStartTimeDetail"><i class="fas fa-calendar-alt"></i> วัน/เวลา เริ่มการประชุม</label>
                                                                    <div class="input-group mb-2">
                                                                        <input type="text" name="txtStartTimeDetail" id="txtStartTimeDetail" class="form-control-plaintext " value="TEST" readonly />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 from-group">
                                                                    <label for="txtEndtimeDetail"><i class="fas fa-calendar-alt"></i> วัน/เวลา สิ้นการประชุม</label>

                                                                    <div class="input-group mb-2">
                                                                        <input type="text" name="txtEndtimeDetail" id="txtEndtimeDetail" class="form-control-plaintext " value="TEST" readonly />
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <label for="">ภาพห้องประชุม</label>
                                                                    <div class="card border-0 ">
                                                                        <div class="card-body">
                                                                            <img src="lib\Mysite\img\meetingRoom\R00000.gif" loop="infinite" class="img-fluid btn" alt="...">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- <a href="Index.php" class="btn btn-link ">กลับสู่หน้าหลัก</a> -->
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="col-lg">

                            <div class="card">
                                <div class="card-body">
                                    <div id='calendar2'></div>
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
    <script type="text/javascript">
        SessionReserv = "<?php echo $param1; ?>";
        GetEventDetail(SessionReserv);
        GetCalendar();
        // alert(SessionReserv);
    </script>
    <!-- Modal -->

</body>

</html>