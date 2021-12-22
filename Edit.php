<?php
include("conn/dbConn.php");
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
    SessionMeetRoom = "";
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

                                        <h1 class="h3 pt-2 text-gray-800"> <i class="far fa-calendar-alt"></i> <span id="txtHeader">asdasd</span></h1>

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
                                                <form name="formReservation" id="formReservation" method="post" onSubmit=" doSubmit(); return false;">

                                                    <div class=" ">

                                                        <fieldset disabled>
                                                            <div class="form-row mb-2">

                                                                <div class=" col-md-6 ">
                                                                    <div class=row>
                                                                        <div class="col-md-3 from-group">
                                                                            <label for="txtRoomID">RoomID</label>
                                                                            <input type="text" name="txtRoomID" id="txtRoomID" class="form-control input-Mysite" value="<?php echo ($param1 == null ? "" : $param1); ?>" readonly />
                                                                            <!-- <input type="text" class="form-control" id="txtRoomID" name="txtRoomID" role="$_SERVER" value="<?php echo ($param1 == null ? "" : $param1); ?>" disabled> -->
                                                                        </div>
                                                                        <div class="col-md-9 from-group">
                                                                            <label for="txtRoomName"><i class="far fa-handshake"></i> ห้องประชุม</label>
                                                                            <!-- <input type="text" class="form-control" id="txtRoomName"> -->

                                                                            <select name="txtRoomName" id="txtRoomName" class="form-control input-Mysite" <?php if ($param1 <> "") {
                                                                                                                                                                echo "disabled =disabled";
                                                                                                                                                            }; ?> onchange="TestChange(this.value)" required>
                                                                                <option selected value="">Choose...</option>

                                                                                <?php
                                                                                while ($obj1 = mysqli_fetch_object($resultAll)) {
                                                                                    if ($param1 == $obj1->RoomID) {
                                                                                        echo "<option selected value='" . $obj1->RoomID . "'>" . $obj1->RoomName . "</option>";
                                                                                    } else {
                                                                                        echo "<option value='" . $obj1->RoomID . "'>" . $obj1->RoomName . "</option>";
                                                                                    }
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class=" col-md-6">
                                                                    <div class=row>
                                                                        <div class="col-md">
                                                                            <label for="txtLocation"><i class="far fa-building"></i> สถานที่ตั้ง</label>
                                                                            <input type="text" class="form-control input-Mysite" name="txtLocation" id="txtLocation" value="<?php echo ($ObjResult == null ? "" :  $ObjResult["Location"]);  ?>" <?php if ($param1 <> "") {
                                                                                                                                                                                                                                                        echo "disabled =disabled";
                                                                                                                                                                                                                                                    }; ?> />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-row mb-2">
                                                                <div class=" col-md-6">
                                                                    <div class=row>
                                                                        <div class="col-md">
                                                                            <label for="txtMeetingTopic"><i class="fas fa-quote-left "></i> หัวข้อการประชุม</label>
                                                                            <input type="text" class="form-control input-Mysite" name="txtMeetingTopic" id="txtMeetingTopic" value="" autocomplete="off" required />
                                                                        </div>
                                                                    </div>
                                                                    <div class=row>
                                                                        <div class="col-md from-group">
                                                                            <div class=row>
                                                                                <div class="col-md">
                                                                                    <label for="txtDescription"><i class="far fa-comment-dots"></i> คำอธิบาย</label>
                                                                                    <textarea type="text" class="form-control input-Mysite" name="txtDescription" id="txtDescription" style="height: 151px;" value=""></textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class=row>
                                                                                <div class="col-md-6">

                                                                                    <label for="txtTotalPeople"><i class="fas fa-users"></i> จำนวนผู้เข้าร่วมประมาณ</label>
                                                                                    <input type="number" class="form-control input-Mysite" name="txtTotalPeople" id="txtTotalPeople" value="0" min="2" />

                                                                                </div>
                                                                                <div class="col-md-6">

                                                                                    <label for="txtcolor"><i class="fas fa-users"></i> สี</label>
                                                                                    <input type="color" class="form-control input-Mysite" name="txtcolor" id="txtcolor" disabled />

                                                                                </div>
                                                                            </div>
                                                                            <div class=row>
                                                                                <div class="col-md-7 from-group">
                                                                                    <label for="txtBookerName"><i class="fas fa-user-edit"></i> ชื่อผู้จอง</label>
                                                                                    <input type="text" class="form-control input-Mysite" name="txtBookerName" id="txtBookerName" value="" required />
                                                                                </div>
                                                                                <div class="col-md-5 from-group">
                                                                                    <label for="txtBookerPhone"><i class="fas fa-phone-square-alt"></i> เบอร์โทรติดต่อ</label>
                                                                                    <input type="text" class="form-control input-Mysite" name="txtBookerPhone" id="txtBookerPhone" required />
                                                                                </div>
                                                                                <div class="col-md-12 from-group">
                                                                                    <label for="txtGroupID"><i class="fas fa-users"></i> กลุ่มงาน</label>
                                                                                    <input type="text" class="form-control input-Mysite" name="txtGroupID" id="txtGroupID" required />
                                                                                </div>
                                                                            </div>


                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class=" col-md-6 ">
                                                                    <div class="row ">
                                                                        <div class="col-md-6 from-group">
                                                                            <label for="txtStartTime"><i class="fas fa-calendar-alt"></i> วัน/เวลา เริ่มการประชุม</label>
                                                                            <div class="input-group mb-2">
                                                                                <input type="text" class="form-control   input-Mysite" name="txtStartTime" id="txtStartTime" autocomplete="off" required />
                                                                                <!-- <div class="input-group-append">
                                                 <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                             </div> -->
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6 from-group">
                                                                            <label for="txtEndtime"><i class="fas fa-calendar-alt"></i> วัน/เวลา สิ้นการประชุม</label>

                                                                            <div class="input-group mb-2">
                                                                                <input type="text" class="form-control   input-Mysite" name="txtEndtime" id="txtEndtime" autocomplete="off" required />
                                                                                <!-- <div class="input-group-append">
                                                 <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                             </div> -->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <label for="">ภาพห้องประชุม</label>
                                                                            <div class="card border-0    ">
                                                                                <div class="card-body">
                                                                                    <img src="lib\Mysite\img\meetingRoom\R00000.jpg" loop="infinite" class="img-fluid "    alt="...">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <input type="hidden" name="action" id="ReservId" value="" />
                                                            <input type="hidden" name="action" id="action" value="Reservation" />
                                                            <div class="">
                                                                <button type="submit" name="btnsubmit" id="btnsubmit" class="btn btn-mysite-blue  ">
                                                                    <i class="fas fa-edit"></i> แก้ไขข้อมูลการจอง
                                                                </button>
                                                                <button type="button" name="btnCancel" id="btnCancel" onclick=" doCancal(); return false;" class="btn btn-mySite-red  " >
                                                                    <i class="fas fa-trash"></i> ยกเลิกการจอง
                                                                </button>
                                                            </div>
                                                            <!-- <a href="Index.php" class="btn btn-link btn-sm ">กลับสู่หน้าหลัก</a>  -->
                                                        </fieldset>
                                                    </div>

                                                    <!-- <div class="modal-footer">
                                                    
                                                    </div> -->
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg">
                            <div class="row mb-2">
                                <div class="col-lg">
                                    <div class="card bg-gradient-Mysite-card-calendar">
                                        <div class="card-body">
                                            <div id='calendar2'></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-lg">
                                    <div class="card border-left-success shadow h-100 py-2 bg-gradient-Mysite-card-calendar">
                                        <div class="card-body">
                                            <div class="row no-gutters align-items-center">
                                                <div class="col mr-2">
                                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                    reservation History</div>
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                                                </div>
                                                <div class="col-auto">
                                                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
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
        $('#txtStartTime').datepicker({
    language: 'en',
    dateFormat: 'yyyy-mm-dd',
    timeFormat: 'hh:ii',
    minView: 'days',
    view: 'days',
    timepicker: true,
    autoClose: false,
    minDate: new Date(),
    onSelect: function onSelect(fd, date) {
      $('#txtEndtime').datepicker({ minDate: date });
    },
    onHide: function (fx, animationCompleted) {

      if (!animationCompleted) {
        checkDateDuplicateG($('#txtStartTime').val(), "Start");



      }
    },
  }).data('datepicker');


  $('#txtEndtime').datepicker({
    language: 'en',
    dateFormat: 'yyyy-mm-dd',
    timeFormat: 'hh:ii',
    minView: 'days',
    view: 'days',
    timepicker: true,
    autoClose: false,
    minDate: new Date(),
    onSelect: function onSelect(fd, date) {
      $('#txtStartTime').datepicker({ maxDate: date });
    },
    onHide: function (fx, animationCompleted) {

      if (!animationCompleted) {
        checkDateDuplicateG($('#txtEndtime').val(), "End");
      }
    },
  }).data('datepicker');

        GetCalendar();
        $("fieldset").attr("disabled", false);



        // alert(SessionReserv);
    </script>
    <!-- Modal -->

</body>

</html>