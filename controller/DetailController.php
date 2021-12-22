<?php
session_start();
include("../conn/dbConn.php");

if (isset($_POST['id'])) {
    $param = $_POST["param"];
    switch ($_POST['id']) {
        case 'TestChange':
            TestChange($param);
            break;
        case 'GetOPDetail':
            GetOPDetail($param);
            break;
        case 'SummitReserv':
            SummitReserv($param);
            break;
        case 'getEventCalendar':
            getEventCalendar($param);
            break;
        case 'GetEventDetail':
            GetEventDetail($param);
            break;
        case 'checkDateDup':
            checkDateDup($param);
            break;
        case 'DelReserv':
            DelReserv($param);
            break;
        case 'Commentweb':
            Commentweb($param);
            break;
    }
}


function TestChange($param)
{
    try {
        $ObjRun = new Connetions();
        $results = $ObjRun->getMeetingRoom($param);
        if ($results <> null) {
            $rescnt = mysqli_num_rows($results);

            $ObjResult = ($rescnt > 0 ? mysqli_fetch_array($results) : null);
            if ($ObjResult <> null) {

                $result[] = array(
                    "Roomid" => $ObjResult["RoomID"],
                    "Location" => $ObjResult["Location"]
                );
            }
        } else {
            echo "error";
        }
    } catch (Exception $e) {
    }
    echo json_encode($result);
}


function GetOPDetail($param)
{
    try {
        $ObjRun = new Connetions();
        $results = $ObjRun->getOperatorUserName($param);
        if ($results <> null) {
            $rescnt = mysqli_num_rows($results);

            $ObjResult = ($rescnt > 0 ? mysqli_fetch_array($results) : null);
            if ($ObjResult <> null) {

                $result[] = array(
                    "Name" => $ObjResult["Name"] . " " . $ObjResult["SurName"],
                    "phone" => $ObjResult["phone"],
                    "group" => $ObjResult["DepartmentName"],
                    "color" => $ObjResult["DepartmentColor"],


                );
            }
        } else {
            echo "error";
        }
    } catch (Exception $e) {

        echo ":" . $e;
    }
    echo json_encode($result);
}

function SummitReserv($param)
{
    try {
        $ObjRun = new Connetions();
        $results = $ObjRun->InsReservetion($param);
        //echo "OK The meeting room has been reserved.";
        $rescnt = mysqli_num_rows($results);

        $ObjResult = NULL;

        if ($rescnt > 0) {
            $ObjResult = mysqli_fetch_array($results);

            echo $ObjResult[0];
        }

        // echo $ObjResult[0];
    } catch (Exception $e) {

        echo $e . "XXXXXXXXX";
    }
};

function getEventCalendar($param)
{
    try {

        $ObjRun = new Connetions();
        $results = $ObjRun->getEventCalendar($param);
        if ($results <> null) {
            $rescnt = mysqli_num_rows($results);

            $rows = array();
            while ($row = $results->fetch_assoc()) {
                $rows[] = array(
                    "id" => $row["ReservationID"],
                    "title" =>   $row["Title"],
                    "start" => $row["StartTime"],
                    "end" => $row["EndTime"],
                    "color" => $row["EventColor"],
                    "description" => $row["RoomName"],
                    "display" => "block"
                );
            }
        } else {
            echo "error";
        }
    } catch (Exception $e) {

        echo $e;
    }
    echo json_encode($rows);
};
function GetEventDetail($param)
{
    try {
        $ObjRun = new Connetions();
        $results = $ObjRun->getEventDetail($param);
        if ($results <> null) {
            $rescnt = mysqli_num_rows($results);

            $ObjResult = ($rescnt > 0 ? mysqli_fetch_array($results) : null);
            if ($ObjResult <> null) {

                $result[] = array(
                    "id" => $ObjResult["ReservationID"],
                    "RoomID" => $ObjResult["RoomID"],
                    "RoomIDText" => $ObjResult["RoomName"],
                    "RoomIDLocation" => $ObjResult["Location"],
                    "MeetingTopic" => $ObjResult["MeetingTopic"],
                    "Description" => $ObjResult["Description"],
                    "StartTime" => $ObjResult["StartTime"],
                    "EndTime" => $ObjResult["EndTime"],
                    "TotalPeople" => $ObjResult["TotalPeople"],
                    "EventColor" => $ObjResult["EventColor"],
                    "BookerUsername" => $ObjResult["BookerUsername"],
                    "BookerName" => $ObjResult["BookerName"],
                    "BookerPhone" => $ObjResult["BookerPhone"],
                    "GroupID" => $ObjResult["GroupID"],
                    "BookingDate" => $ObjResult["BookingDate"]
                );
            }
        } else {
            echo "error";
        }
    } catch (Exception $e) {

        echo $e;
    }
    echo json_encode($result);
};


function checkDateDup($param)
{
    try {
        $ObjRun = new Connetions();
        $results = $ObjRun->checkDateDup($param);
        //echo "OK The meeting room has been reserved.";
        $rescnt = mysqli_num_rows($results);

        $ObjResult = NULL;

        if ($rescnt > 0) {
            $ObjResult = mysqli_fetch_array($results);
            $strCnt = $ObjResult[0];
            echo ($strCnt > 0 ? "เวลานี้มีผู้ใช้งานจองห้องประชุมแล้ว" : "");
        }

        // echo $ObjResult[0];
    } catch (Exception $e) {

        echo $e;
    }
};
function DelReserv($param)
{
    try {
        $ObjRun = new Connetions();
        $results = $ObjRun->DelReserv($param);
        //echo "OK The meeting room has been reserved.";
        $rescnt = mysqli_num_rows($results);

        $ObjResult = NULL;

        if ($rescnt > 0) {
            $ObjResult = mysqli_fetch_array($results);
            $strCnt = $ObjResult[0];
            echo ($strCnt > 0 ? "ลบข้อมูลไม่สำเร็จ" : "");
        }

        // echo $ObjResult[0];
    } catch (Exception $e) {

        echo $e;
    }
};
function Commentweb($param)
{
    try {
        $ObjRun = new Connetions();
        $results = $ObjRun->Commentweb($param);
        //echo "OK The meeting room has been reserved.";
        $rescnt = mysqli_num_rows($results);

        $ObjResult = NULL;

        if ($rescnt > 0) {
            $ObjResult = mysqli_fetch_array($results);
            $strCnt = $ObjResult[0];
            echo ($strCnt > 0 ? "" : "Wrong");
        }

        // echo $ObjResult[0];
    } catch (Exception $e) {

        echo $e;
    }
};
