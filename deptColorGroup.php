<ul class="nav justify-content-center ">
    <?php
    try {
        $ObjRun = new Connetions();
        $results = $ObjRun->getDepartment();
        $rescnt = mysqli_num_rows($results);
        //  $ObjResult = ($rescnt > 0 ? mysqli_fetch_array($results) : null);
        $rows = array();
        while ($row = $results->fetch_assoc()) {
    ?>
            <li class="nav-item m-2">
                <a href="<?php echo $row["url"] ?>" class="btn btn-light btn-icon-split" style="background-color: <?php echo $row["DepartmentColor"] ?>;">
                    <span class="icon text-white-50">
                        <i class="fas fa-flag"></i>
                    </span>
                    <span class="text text-white"><?php echo $row["DepartmentID"] ?></span>
                </a>
            </li>
    <?php
        }
    } catch (Exception $e) {
        $strerr = 'Caught exception: ' .  $e->getMessage() . "\n";
    }
    ?>

</ul>