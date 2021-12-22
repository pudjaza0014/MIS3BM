<?php
session_start(); 
 
$ssID = null;
if (count($_SESSION) == 0) {
    header("location:login.php");
    exit;
}else{ 
    $ssID = $_SESSION["Username"]; 
}
?>

<script type="text/javascript">
 Sessionvalue = "<?php echo $ssID; ?>";
alert(Sessionvalue);
</script>
