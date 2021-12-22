<?php
session_start();
include("../conn/dbConn.php");

if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'login':
            $strUserName = $_POST['txtUserName'];
            $strPassword = $_POST['txtPassword'];
            login($strUserName, $strPassword);
            break;
        case 'Reservation':
            Reservation();
            break;
        case 'regis':

$strUsername =$_POST['txtUsername'];
$strPassword =$_POST['txtPassword'];
$strName =$_POST['txtName'];
$strsurname =$_POST['txtSurName'];
$strGroup =$_POST['txtGroup'];
$strTel =$_POST['txtTel'];






            regis($strUsername,$strPassword,$strName,$strsurname,$strGroup,$strTel);
            break;
    }
}

function Login($strUserName, $strPassword)
{
    try {

        $ObjRun = new Connetions();
        $results = $ObjRun->getOperator($strUserName, $strPassword);
        if ($results <> null) {
            $rescnt = mysqli_num_rows($results);

            $ObjResult = ($rescnt > 0 ? mysqli_fetch_array($results) : null);
            if ($ObjResult <> null) {

                $_SESSION["Username"] = $ObjResult["Username"];
                header("location:../Index.php");
            } else {
                header("location:../login.php?strErr=1");
            }
        } else {
            echo "error";
        }
    } catch (Exception $e) {
        echo '<h1>Caught exception: ' .  $e->getMessage() . "</h1> \n";
    }
}

function GetRoomDetail($strRoomID)
{
    try {
    } catch (Exception $e) {
    }
}






// function Reservation($txtRoomID, $txtRoomName, $txtLocation, $txtMeetingTopic, $txtDescription, $txtTotalPeople, $txtBookerName, $txtBookerPhone, $txtGroupID, $txtStartTime, $txtEndtime)
function Reservation()
{
    date_default_timezone_set("Asia/Bangkok");
    $arr = array(
        //  "ReservationID" => $_POST["txtRoomID"],
        "RoomID"        => $_POST["txtRoomID"],
        "MeetingTopic"  => $_POST["txtMeetingTopic"],
        "Description"   => $_POST["txtDescription"],
        "StartTime"     => $_POST["txtStartTime"],
        "EndTime"       => $_POST["txtEndtime"],
        "TotalPeople"   => $_POST["txtTotalPeople"],
        "BookerUsername" => $_SESSION["Username"],
        "BookerName"    => $_POST["txtBookerName"],
        "BookerPhone"   => $_POST["txtBookerPhone"],
        "GroupID"       => $_POST["txtGroupID"],
        "BookingDate"   =>  date("Y-m-d H:i:s")
    );

    testarr($arr);
}



function testarr($arr)
{
    echo $arr["BookerUsername"];
    header("location:../Index.php");
}




function regis($strUsername,$strPassword,$strName,$strsurname,$strGroup,$strTel)
{
    try {

        $ObjRun = new Connetions();
        $results = $ObjRun->regis($strUsername,$strPassword,$strName,$strsurname,$strGroup,$strTel);

        $rescnt = mysqli_num_rows($results);

        $ObjResult = NULL;

        if ($rescnt > 0) {
            $ObjResult = mysqli_fetch_array($results);
            $strCnt = $ObjResult[0];
            // echo ($strCnt > 0 ? "OK" : "");



            if ($ObjResult <> null) {

                $_SESSION["Username"] = $ObjResult["Username"];
                header("location:../login.php");
            } else {
                header("location:../register.php?strErr=1");
            }
        }



        // if ($results <> null) {
        //     $rescnt = mysqli_num_rows($results);

        //     $ObjResult = ($rescnt > 0 ? mysqli_fetch_array($results) : null);
        //     if ($ObjResult <> null) {

        //         $_SESSION["Username"] = $ObjResult["Username"];
        //         header("location:../Index.php");
        //     } else {
        //         header("location:../Login.php?strErr=1");
        //     }
        // } else {
        //     echo "error";
        // }
    } catch (Exception $e) {
        echo '<h1>Caught exception: ' .  $e->getMessage() . "</h1> \n";
    }
}
