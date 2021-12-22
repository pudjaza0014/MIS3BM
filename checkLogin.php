<?php  
session_start();
include("conn/dbConn.php");

$strUserName = $_POST["txtUserName"];
$strPassword = $_POST["txtPassword"];

 $ObjRun = new Connetions();
 $results = $ObjRun->getOperator($strUserName, $strPassword);
 if ($results <> null) {
     $rescnt = mysqli_num_rows($results);

     $ObjResult = ($rescnt > 0 ? mysqli_fetch_array($results) : null);
     if ($ObjResult <> null) {

         $_SESSION["Username"] = $ObjResult["Username"];
         header("location:Index.php");
     } else { 
         header("location:Login.php?strErr=1");
     }
 } else {
     echo "error";
 }


 ?>