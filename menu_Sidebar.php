<?php
try {
    $ObjRun = new Connetions();
    $strPage = basename($_SERVER['PHP_SELF']);


    $results = $ObjRun->getWebMenu($strPage);
} catch (Exception $e) {
    echo 'Caught exception: ',  $e->getMessage(), "\n";
}

?>
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-light sidebar sidebar-light accordion " id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="Index.php">
        <!-- <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div> -->
        <div class="sidebar-brand-icon  ">
        <!-- <i class="fas fa-laugh-wink"></i> -->
            <img src="lib\Mysite\img\logo.png" style="max-width: 60%;  height: auto;"  >
        </div>
        <div class="sidebar-brand-text mx-3">MeetRoom<sup>3</sup></div>
    </a> 
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="Index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a> 
    </li>
    <?php
    while ($obj = mysqli_fetch_object($results)) {

        if ($obj->MenuLevel == 0) {



    ?>
            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                <?php
                echo  $obj->MenuNameT;
                ?>
            </div>






        <?php
        } elseif ($obj->MenuLevel == 1) {
            if ($obj->MenuSub <> "") {
            }

if($obj->MenuURL <> ""){

    ?> 
    <li class="nav-item active">
                <?php echo '<a class="nav-link" href="' . $obj->MenuURL . '">' . $obj->IconClass . '' .  $obj->MenuNameT . '</a>'; ?> 
            </li>

    <?php
}else{


        ?> 
            <!-- Nav Item - Charts -->
            <li class="nav-item active">
                <?php echo '<a class="nav-link" href="Index.php?MeetRoom=' . $obj->Param . '">' . $obj->IconClass . '' .  $obj->MenuNameT . '</a>'; ?> 
            </li>

    <?php
    }
        }
    }
    ?>



    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
<!-- End of Sidebar -->