<?php
class Connetions
{


    public function  getMeetingRoom($paramSQL)
    {
        try {
            $strSQL = "SELECT * FROM `meetingroommaster` WHERE RoomID ='" . $paramSQL . "' ";
            $connS = new Connetions;
            $Results = $connS->GetQuery($strSQL);

            return $Results;
        } catch (Exception $e) {
            throw $e;
        }
    }
    public function  getMeetingRoomAll()
    {
        try {
            $strSQL = "SELECT * FROM `meetingroommaster`";
            $connS = new Connetions;
            $Results = $connS->GetQuery($strSQL);

            return $Results;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function  getOperator($strUserName, $strPassword)
    {
        try {
            $strSQL = "SELECT * FROM `Operator` WHERE Username = '" . $strUserName . "' and Password = '" . $strPassword . "'";
            $connS = new Connetions;
            $Results = $connS->GetQuery($strSQL);
            return $Results;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function  getOperatorUserName($strUserName)
    {
        try {
            $strSQL = "SELECT * FROM `vewOperator` WHERE Username = '" . $strUserName . "'";
            $connS = new Connetions;
            $Results = $connS->GetQuery($strSQL);
            return $Results;
        } catch (Exception $e) {
            throw $e;
        }
    }


    public function  InsReservetion($param)
    {
        $strSQL = "";
        try {

            $ReservID = ($param["id"] == "" ? date("YmdHis") : $param["id"]);
            $Operator = ($param["id"] == "" ? "Ins" : "Upd");
            $strSQL = "CALL sprTest('" . $Operator . "','" . $ReservID . "','" . $param["RoomID"] . "','" . $param["MeetingTopic"] . "','" . $param["Description"] . "','" . $param["StartTime"] . "','" . $param["EndTime"] . "','" . $param["TotalPeople"] . "','" . $param["Color"] . "','" . $param["BookerUsername"] . "','" . $param["BookerName"] . "','" . $param["BookerPhone"] . "','" . $param["GroupID"] . "',CURRENT_TIMESTAMP(),@iResult);";
            $connS = new Connetions;
            $Results = $connS->GetQuery($strSQL);

            return $Results;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function  getEventCalendar($param)
    {
        try {


            // $param = '';
            $strSQL = "SELECT * FROM `vewMeetingReservation`  ".($param!=""?"Where RoomID = '" . $param . "'":"");
            if ($param != "") {
            //    $strSQL =$strSQL + " Where RoomID = '" . $param . "'";
            }


            $connS = new Connetions;
            $Results = $connS->GetQuery($strSQL); 
            return $Results;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function  getEventDetail($param)
    {
        try {
            $strSQL = "SELECT * FROM `vewMeetingReservation` WHERE ReservationID ='" . $param . "'";
            $connS = new Connetions;
            $Results = $connS->GetQuery($strSQL);
            return $Results;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function  getDepartment()
    {
        try {
            $strSQL = "SELECT * FROM `department`";
            $connS = new Connetions;
            $Results = $connS->GetQuery($strSQL);
            return $Results;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function  checkDateDup($param)
    {
        $strSQL = "";
        try {
            $strSQL = "CALL sprCheckDateDup1('" . $param["param"] . "','" . $param["control"] . "','" . $param["id"] . "','" . $param["RoomID"] . "');";
            $connS = new Connetions;
            $Results = $connS->GetQuery($strSQL);

            return $Results;
        } catch (Exception $e) {
            throw $e . $strSQL;
        }
    }



    public function  DelReserv($param)
    {
        $strSQL = "";
        try {
            $strSQL = "CALL sprDelReservation('" . $param["id"] . "','" . $param["BookerUsername"] . "');";
            $connS = new Connetions;
            $Results = $connS->GetQuery($strSQL);

            return $Results;
        } catch (Exception $e) {
            throw $e . $strSQL;
        }
    }



    public function  regis($strUsername, $strPassword, $strName, $strsurname, $strGroup, $strTel)
    {
        $strSQL = "";
        try {
            $strSQL = "CALL sprOperatorRegis('" . $strUsername . "','" . $strPassword . "','" . $strName . "','" . $strsurname . "','" . $strGroup . "','" . $strTel . "');";
            $connS = new Connetions;
            $Results = $connS->GetQuery($strSQL);

            return $Results;
        } catch (Exception $e) {
            throw $e . $strSQL;
        }
    }


public function  Commentweb($param)
    {
        $strSQL = "";
        try {
            $strSQL = "CALL sprCommentWeb('" . $param["comment"] . "','" . $param["name"] . "');";
            $connS = new Connetions;
            $Results = $connS->GetQuery($strSQL);

            return $Results;
        } catch (Exception $e) {
            throw $e . $strSQL;
        }
    }










    public function  getWebMenu($paramSQL)
    {
        try {
            $strSQL = "SELECT * FROM WebManu where Action IN ('All','" . $paramSQL . "') and Disable =0 ORDER BY MenuOrderDesplay,Menulevel ASC";
            $connS = new Connetions;
            $Results = $connS->GetQuery($strSQL);
            return $Results;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function GetQuery($paramSQL)
    {
        try {
            $connS = new Connetions;
            $connn =  $connS->strConn();
            $strSQL = $paramSQL;
            $objQuery = mysqli_query($connn, $strSQL);
            echo mysqli_error($connn);
            // throw $error;
            //$total = mysqli_num_rows($objQuery);
            return $objQuery;
            mysqli_close($connn);
        } catch (Exception $e) {
            // echo 'Caught exception: '.  $e->getMessage(). "\n";
            throw $e;
        }
    }


    public function strConnTest()
    {
        try {
            $connn = mysqli_connect("127.0.0.1", "root", "");
            mysqli_select_db($connn, "db_meetingbooking");
            mysqli_query($connn, "SET character_set_results=utf8");
            return  $connn;
        } catch (Exception $e) {
            // echo 'Caught exception: '.  $e->getMessage(). "\n";
            throw $e;
        }
    }

    public function strConn()
    {
        try {
            $connn = mysqli_connect("122.155.196.46", "hpbogoth_p", "Padmin@samin");
            mysqli_select_db($connn, "db_MeetingBooking");
            mysqli_query($connn, "SET character_set_results=utf8");
            mysqli_set_charset($connn, "utf8");
            return  $connn;
        } catch (Exception $e) {
            // echo 'Caught exception: '.  $e->getMessage(). "\n";
            throw $e;
        }
    }
}
