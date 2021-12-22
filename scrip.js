
var calendarEl = document.getElementById('calendar');
var calendar = new FullCalendar.Calendar(calendarEl, {
  //themeSystem: 'bootstrap',
  height: 590,
  selectable: true,
  headerToolbar: {
    left: 'prev,next today',
    center: 'title',
    right: 'dayGridMonth,timeGridWeek,timeGridDay'

  },
  timeZone: 'local',
  locale: 'th',
  dateClick: function (info) {
    try {
      if (SessionMeetRoom == "") {
        //if ($("#txtRoomID").val() == "") {
        $("#txtRoomID").val("");
        $("#txtRoomName").val("").change();
        $("#txtLocation").val("");
      }
      $("#txtMeetingTopic").val("");
      $("#txtDescription").val("");
      $("#txtTotalPeople").val(0);
      // $("#txtStartTime").val(convertFormatDate(info.dateStr));
      // $("#txtEndtime").val(convertFormatDate(info.dateStr + " 16:30"));
      var infodate = new Date(info.dateStr);
      var infoEnd = new Date((info.dateStr.length < 11 ? info.dateStr + " 16:00" : info.dateStr));


      var dateNow = new Date();


      if (Sessionvalue == "") {                                               // Check [SESSION]
        Swal.fire({
          icon: 'info',
          title: 'Oops...',
          html: 'หากต้องการจองกรุณา<a href="login.php">เข้าสู่ระบบ</a>ก่อน',
          footer: '<a href="login.php">ไปที่หน้า Login</a>'
        });
        return false;
      } else {
        $('#txtStartTime').datepicker().data('datepicker').selectDate(infodate);
        $("#txtEndtime").datepicker().data('datepicker').selectDate(infoEnd);

        OpeDetail(Sessionvalue);
      }
      $("#txtBookerName").val(Sessionvalue);
      if (infodate < dateNow) {
        Swal.fire({
          icon: 'info',
          title: 'Oops...',
          text: 'ไม่สามารถจองย้อนหลังได้!',
          //footer:
        });
        return false;
      } else {
        $("fieldset").attr("disabled", false);
        $('#staticBackdrop').modal('show');
        $("#txtMeetingTopic").focus();
      }
    } catch (e) {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Something went wrong! :' + e.message,
      });
    }
  },
  // select: function (info) {
  //   try {

  //     if ($("#txtRoomID").val() == "") {
  //       $("#txtRoomID").val("");
  //       $("#txtRoomName").val("").change();
  //       $("#txtLocation").val("");
  //     }
  //     $("#txtMeetingTopic").val("");
  //     $("#txtDescription").val("");
  //     $("#txtTotalPeople").val(0);
  //     var infoStart = new Date(info.startStr);
  //     // var infoEnd = new Date(info.endStr + " 16:30");
  //     var infoEnd = new Date((info.endStr.length < 11 ? info.endStr + " 16:30" : info.endStr));


  //     infoEnd.setDate(infoEnd.getDate() - 1);
  //     var dateNow = new Date();

  //     if (Sessionvalue == "") {                                               // Check [SESSION]
  //       Swal.fire({
  //         icon: 'info',
  //         title: 'Oops...',
  //         text: 'หากต้องการจอง กรุณา Login เข้าสู่ระบบก่อน',
  //       });
  //       return false;
  //     } else {
  //       $('#txtStartTime').datepicker().data('datepicker').selectDate(infoStart);
  //       $("#txtEndtime").datepicker().data('datepicker').selectDate(infoEnd);

  //       $("fieldset").attr("disabled", false);
  //       OpeDetail(Sessionvalue);
  //     }

  //     $("#txtBookerName").val(Sessionvalue);
  //     if (infoStart < dateNow) {
  //       Swal.fire({
  //         icon: 'error',
  //         title: 'Oops...',
  //         text: 'Something went wrong!',
  //       });
  //       return false;
  //     } else {

  //       $('#staticBackdrop').modal('show');
  //       $("#txtMeetingTopic").focus();
  //     }
  //   } catch (e) {
  //     Swal.fire({
  //       icon: 'error',
  //       title: 'Oops...',
  //       text: 'Something went wrong! :' + e.message,
  //     });
  //   }
  // },
  events: GetEvents(),
  eventClick: function (info) {
    var params = info.event.id;
    gotoPath(params);
  },
});

function gotoPath(params) {
  try {
    var id1 = "GetEventDetail";
    $.ajax({
      url: 'controller/DetailController.php',
      type: 'POST',
      data: { id: id1, param: params },
      success: function (data) {

        console.log(data); // Inspect this in your console
        var obj = JSON.parse(data);
        var result = obj[0];
        var infoStart = new Date(result.StartTime);
        var infoEnd = new Date(result.EndTime);
        var dateNow = new Date();
        if (result.BookerUsername != Sessionvalue || dateNow > infoEnd) {
          window.location.href = "detail.php?Reserv=" + params;
        } else {
          window.location.href = "Edit.php?Reserv=" + params;
        }
      }
    });
  } catch (e) {
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Something went wrong! :' + e.message,
    });
  }
};








function GetCalendar() {
  var calendarEl2 = document.getElementById('calendar2');
  var calendar2 = new FullCalendar.Calendar(calendarEl2, {
    selectable: true,
    timeZone: 'local',
    locale: 'th',
    headerToolbar: {
      left: '',
      center: 'title',
      right: ''
    },
    events: GetEvents2(),
    eventClick: function (info) {
      var params = info.event.id;
      gotoPath(params);
    },
  });
  calendar2.render();


  function GetEvents2() {
    try {
      var id1 = "getEventCalendar";
      var param = "";
      $.ajax({
        url: 'controller/DetailController.php',
        type: 'POST',
        data: { id: id1, param: param },
        success: function (data) {
          var eventSources = calendar2.getEventSources();
          var len = eventSources.length;
          for (var i = 0; i < len; i++) {
            eventSources[i].remove();
          }
          var obj = JSON.parse(data);
          calendar2.addEventSource(obj);
          GetEventDetail(SessionReserv);
        }
      });
    } catch (e) {
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Something went wrong! :' + e.message,
      });
    }
  }

}


































//==== EVENT ALL GET ====//
function GetEvents() {
  try {
    var id1 = "getEventCalendar";



    var param1 = "";

    // if (SessionMeetRoom != "") {
    //   // var obj = JSON.parse(SessionMeetRoom);
     
      param1 = SessionMeetRoom;
      //   // console.log = SessionMeetRoom;
      //   // console.log =obj[0];
      // }
     
    //alert(param);

    $.ajax({
      url: 'controller/DetailController.php',
      type: 'POST',
      data: { id: id1, param: param1 },
      success: function (data) {

        var eventSources = calendar.getEventSources();
        len = eventSources.length;
        for (var i = 0; i < len; i++) {
          eventSources[i].remove();
        }


        // alert(data);

        if (data != null) {
          var obj = JSON.parse(data);
          calendar.addEventSource(obj);
        }
      }
    });
  } catch (e) {
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Something went wrong! xxxxx:' + e.message,
    });
  }
}




//==== EVENT DETAIL ====//
function GetEventDetail(param) {
  try {
    var id1 = "GetEventDetail";
    $.ajax({
      url: 'controller/DetailController.php',
      type: 'POST',
      data: { id: id1, param: param },
      success: function (data) {

        console.log(data); // Inspect this in your console
        var obj = JSON.parse(data);
        var result = obj[0];

        var infoStart = new Date(result.StartTime);
        var infoEnd = new Date(result.EndTime);
        var dateNow = new Date();


        if (result.BookerUsername != Sessionvalue || dateNow > infoEnd) {
          // $("fieldset").attr("disabled", true); 
          $("#txtHeader").text(result.RoomIDText);



          $('#txtStartTimeDetail').val(result.StartTime);
          $("#txtEndtimeDetail").val(result.EndTime);

          $("#txtRoomID").val(result.RoomID);
          $("#txtRoomName").val(result.RoomIDText);
          $("#txtLocation").val(result.RoomIDLocation);


          $("#ReservId").val(result.id);
          $("#txtMeetingTopic").val(result.MeetingTopic);
          $("#txtDescription").val(result.Description);
          $("#txtTotalPeople").val(result.TotalPeople);
          $("#txtcolor").val(result.EventColor);
          $("#txtBookerName").val(result.BookerName);
          $("#txtBookerPhone").val(result.BookerPhone);
          $("#txtGroupID").val(result.GroupID);

        } else {
          console.log(result.RoomIDText);
          $("#txtHeader").text(result.RoomIDText);

          $("fieldset").attr("disabled", false);
          $('#txtStartTime').datepicker().data('datepicker').selectDate(infoStart);
          $("#txtEndtime").datepicker().data('datepicker').selectDate(infoEnd);
          $("#txtRoomName").val(result.RoomID).change();
          $("#ReservId").val(result.id);
          $("#txtMeetingTopic").val(result.MeetingTopic);
          $("#txtDescription").val(result.Description);
          $("#txtTotalPeople").val(result.TotalPeople);
          $("#txtcolor").val(result.EventColor);
          $("#txtBookerName").val(result.BookerName);
          $("#txtBookerPhone").val(result.BookerPhone);
          $("#txtGroupID").val(result.GroupID);
        }
        // console.log(result.id);
        // console.log(Sessionvalue);




      }
    });
  } catch (e) {
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Something went wrong! :' + e.message,
    });
  }
}
//==== EVENT DELETE ====//
function ClearEvents() {
  try {


    var eventSources = calendar.getEventSources();
    var len = eventSources.length;
    for (var i = 0; i < len; i++) {
      eventSources[i].remove();
    }
  } catch (e) {
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: 'Something went wrong! :' + e.message,
    });
  }


}


document.addEventListener('DOMContentLoaded', function () {
  if (Sessionvalue != "") {
    // Check [SESSION]
    Swal.fire({
      position: 'top-end',
      icon: 'success',
      title: 'สวัสดี',
      showConfirmButton: false,
      timer: 1000
    });

  } else {

  }
  calendar.render();
  $("#txtRoomName").on("change", function () {

    $("#txtRoomName").on("change", function () {
      $("#action").val("GetRoomDetail");

    });
  });

});

$(document).ready(function () {
  // var datePickersSE;
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



});

function convertFormatDate(strDate) {
  var dateTemp = new Date(strDate);
  var strResult = dateTemp.getFullYear().toString() + "-" + ("0" + (dateTemp.getMonth() + 1)).slice(-2).toString() + "-" + ("0" + dateTemp.getDate()).slice(-2).toString() + " " + dateTemp.toLocaleTimeString('fr-FR', { hour: '2-digit', minute: '2-digit' });
  return strResult;
}

function checkDateDuplicateG(param1, control) {
  $(".datepikers").removeClass("border border-danger");

  try {
    var con = (control == "End" ? "#txtEndtime" : "#txtStartTime");
    param1 = convertFormatDate(param1);
    var arr = {
      "param": param1,
      "control": control,
      "id": $("#ReservId").val(),
      "RoomID": $("#txtRoomID").val()
    };
    var param = arr;


    var id1 = "checkDateDup";
    $.ajax({
      url: 'controller/DetailController.php',
      type: 'POST',
      data: { id: id1, param: param },
      success: function (data) {
        console.log(data); // Inspect this in your console

        if (data != "") {
          Swal.fire({
            icon: 'warning',
            title: 'Oops...',
            text: '' + data,
          }).then((result) => {
            return false;
          });

          return false;

        } else {

          $(con).removeClass("border border-danger");

        }
      }
    });


  } catch {
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: '' + ex.message,
    });
    return false;
  }
}




function checkDateDuplicate(param1, control) {
  $(".datepikers").removeClass("border border-danger");

  try {
    var isModelOpen = $('#staticBackdrop').hasClass('show');
    if (isModelOpen) {
      var con = (control == "End" ? "#txtEndtime" : "#txtStartTime");
      param1 = convertFormatDate(param1);
      var arr = {
        "param": param1,
        "control": control,
        "id": $("#ReservId").val(),
        "RoomID": $("#txtRoomID").val()
      };
      var param = arr;


      var id1 = "checkDateDup";
      $.ajax({
        url: 'controller/DetailController.php',
        type: 'POST',
        data: { id: id1, param: param },
        success: function (data) {
          console.log(data); // Inspect this in your console

          if (data != "") {
            Swal.fire({
              icon: 'warning',
              title: 'Oops...',
              text: '' + data,
            }).then((result) => {
              return false;
            });

            return false;

          } else {

            $(con).removeClass("border border-danger");

          }
        }
      });
    } else {


      return;
    }

  } catch {
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: '' + ex.message,
    });
    return false;
  }
}


function TestChange(param) {
  try {
    if ($("#txtRoomName").val() == "") {
      $("#txtRoomID").val("");
      $("#txtLocation").val("");
      return false;
    }
    var id1 = "TestChange";
    $.ajax({
      url: 'controller/DetailController.php',
      type: 'POST',
      data: { id: id1, param: param },
      success: function (data) {
        console.log(data); // Inspect this in your console
        var obj = JSON.parse(data);
        $("#txtRoomID").val(obj[0].Roomid);
        $("#txtLocation").val(obj[0].Location);
      }
    });
  } catch (ex) {
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: '' + ex.message,
    });
    return false;
  }
}
function OpeDetail(param) {
  try {
    var id1 = "GetOPDetail";
    $.ajax({
      url: 'controller/DetailController.php',
      type: 'POST',
      data: { id: id1, param: param },
      success: function (data) {
        console.log(data); // Inspect this in your console
        var obj = JSON.parse(data);
        $("#txtBookerName").val(obj[0].Name);
        $("#txtBookerPhone").val(obj[0].phone);
        $("#txtGroupID").val(obj[0].group);
        $("#txtcolor").val(obj[0].color);
      }
    });
  } catch (ex) {
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: '' + ex.message,

    });
    return false;
  }
}

function doSubmit() {
  try {
    Swal.fire({
      title: 'คุณแน่ใจแล้วใช่หรือไม่ ?',
      // text: "หากเลยเวลาการเริ่มประชุมแล้ว ข้อมูลจะไม่สามารถแก้ไขได้!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#0071e3',
      cancelButtonColor: '#d90c3d',
      confirmButtonText: 'ใช่ ฉันแน่ใจ',

    }).then((result) => {
      if (result.isConfirmed) {
        var id1 = "SummitReserv";
        var arr = {
          "id": $("#ReservId").val(),
          "RoomID": $("#txtRoomID").val(),
          "MeetingTopic": $("#txtMeetingTopic").val(),
          "Description": $("#txtDescription").val(),
          "TotalPeople": $("#txtTotalPeople").val(),
          "BookerName": $("#txtBookerName").val(),
          "BookerPhone": $("#txtBookerPhone").val(),
          "GroupID": $("#txtGroupID").val(),
          "StartTime": $("#txtStartTime").val(),
          "EndTime": $("#txtEndtime").val(),
          "Color": $("#txtcolor").val(),
          "BookerUsername": Sessionvalue
        };
        var param = arr;
        $.ajax({
          url: 'controller/DetailController.php',
          type: 'POST',
          data: { id: id1, param: param },
          success: function (data) {
            var icons, titles, texts;
            if (data == '1') {
              icons = "success";
              titles = "สำเร็จ"
              texts = "ห้องประชุมถูกจองเรียบร้อยแล้ว.";
            } else {
              icons = "error";
              titles = "Oops..."
              texts = data;

            }
            Swal.fire({
              icon: icons,
              title: titles,
              text: texts,

            }).then((result) => {
              if (data == '1') {
                location.reload();
              } else {
                return false;
              }

            });
          }
        });
      }
    });
  } catch (ex) {
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: '' + ex.message,
    });
  }
}

function doCancal() {
  try {
    Swal.fire({
      title: 'คุณแน่ใจแล้วใช่หรือไม่ ?',
      text: "ข้อมูลจะถูกลบออกจากระบบ",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#0071e3',
      cancelButtonColor: '#d90c3d',
      confirmButtonText: 'ใช่ ฉันแน่ใจ'

    }).then((result) => {
      if (result.isConfirmed) {

        var id1 = "DelReserv";
        var arr = {
          "id": $("#ReservId").val(),
          "BookerUsername": Sessionvalue
        };
        var param = arr;
        console.log(param);
        $.ajax({
          url: 'controller/DetailController.php',
          type: 'POST',
          data: { id: id1, param: param },
          success: function (data) {
            var icons, titles, texts;
            if (data == '') {
              icons = "success";
              titles = "สำเร็จ"
              texts = "การจองห้องประชุมถูกยกเลิกเรียบร้อยแล้ว.";
            } else {
              icons = "error";
              titles = "Oops..."
              texts = data;

            }
            Swal.fire({
              icon: icons,
              title: titles,
              text: texts,
            }).then((result) => {
              if (data == '') {
                window.location.href = "Index.php";
              } else {
                return false;
              }

            });
          }
        });
      }
    });
  } catch (ex) {
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: '' + ex.message,
    });
  }
}


function doComment() {
  try {
    var id1 = "Commentweb";
    var arr = {
      "comment": $("#txtComment").val(),
      "name": $("#txtComment").val()
    };
    var param = arr;
    console.log(param);
    $.ajax({
      url: 'controller/DetailController.php',
      type: 'POST',
      data: { id: id1, param: param },
      success: function (data) {
        var icons, titles, texts;
        if (data == '') {
          icons = "success";
          titles = "ขอบคุณครับ"
          texts = "ขอบคุณที่เป็นส่วนหนึ่งในการพัฒนาระบบ";
        } else {
          icons = "error";
          titles = "Oops..."
          texts = data;

        }
        Swal.fire({
          icon: icons,
          title: titles,
          text: texts,

        }).then((result) => {

          if (data == '') {
            location.reload();
          } else {
            return false;
          }


        });
      }
    });


  } catch (ex) {
    Swal.fire({
      icon: 'error',
      title: 'Oops...',
      text: '' + ex.message,
    });
  }
};