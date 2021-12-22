 <?php
    try {
        $ObjRun = new Connetions();
        $results = $ObjRun->getMeetingRoom($param1);
        $rescnt = mysqli_num_rows($results);
        $ObjResult = ($rescnt > 0 ? mysqli_fetch_array($results) : null);
 
        $resultAll = $ObjRun->getMeetingRoomAll();
    } catch (Exception $e) {
        $strerr = 'Caught exception: ' .  $e->getMessage() . "\n";
    }
    ?>

 <!-- Modal -->
 <div class="modal fade " id="staticBackdrop" name="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
     <div class="modal-dialog modal-xl">
         <div class="modal-content">
             <form name="formReservation" id="formReservation" method="post" onSubmit=" doSubmit(); return false;">
                 <div class="modal-header bg-gradient-Mysite-header-modal"> 
                     <h3 class="modal-title   " id="staticBackdropLabel"><i class="far fa-calendar-alt"></i> <?php echo ($ObjResult == null ? "จองห้องประชุม" : $ObjResult["RoomName"]);   ?> </h3>
                    
                     <?php while ($obj = mysqli_fetch_object($results)) {
                            echo $obj->RoomName;
                        } ?>
                     <button type="button" class="close  " data-dismiss="modal" aria-label="Close">
                         <span aria-hidden="true" class="H1">&times;</span>
                     </button>
                 </div>
                 <div class="modal-body  "> 

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
                                             <input type="text" class="form-control datepikers input-Mysite" name="txtStartTime" id="txtStartTime" autocomplete="off" required />
                                             <!-- <div class="input-group-append">
                                                 <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                             </div> -->
                                         </div>
                                     </div>
                                     <div class="col-md-6 from-group">
                                         <label for="txtEndtime"><i class="fas fa-calendar-alt"></i> วัน/เวลา สิ้นการประชุม</label>

                                         <div class="input-group mb-2">
                                             <input type="text" class="form-control datepikers input-Mysite" name="txtEndtime" id="txtEndtime" autocomplete="off" required />
                                             <!-- <div class="input-group-append">
                                                 <div class="input-group-text"><i class="fas fa-calendar-alt"></i></div>
                                             </div> -->
                                         </div>
                                     </div>
                                 </div>
                                 <div class="row">
                                     <div class="col-md-12">
                                         <label for="">ภาพห้องประชุม</label>
                                         <div class="card  ">
                                             <div class="card-body">
                                                 <img src="lib\Mysite\img\meetingRoom\<?php echo ($ObjResult == null ? "R00000.gif" :  $ObjResult["Image"]); ?>" loop="infinite" class="img-fluid" alt="...">
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <input type="hidden" name="action" id="ReservId" value="" />
                         <input type="hidden" name="action" id="action" value="Reservation" />
                     <button type="submit" name="btnsubmit" id="btnsubmit" class="btn btn-primary  ">
                         จองห้องประชุม
                     </button>
                     </fieldset>
                    
                     <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button> -->
                     <!-- <button type="submit" class="btn btn-primary">Sign in</button> -->

                 </div>

                 <div class="modal-footer"> 
                 </div>
             </form>
         </div>
     </div>
 </div>