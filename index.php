<?php
session_start();
include "./authen/check_authen.php";
include "./config/global.php";
include "./config/database.php";


?>
<!doctype html>
<html lang="th">

<head>
    <?php include "./include/head.php"; ?>
</head>

<body>

    <!-- Loading wrapper start -->
    <?php include "./include/loading.php"; ?>
    <!-- Loading wrapper end -->

    <!-- Page wrapper start -->
    <div class="page-wrapper">

        <!-- Sidebar wrapper start -->
        <?php include "./include/sidebar.php"; ?>
        <!-- Sidebar wrapper end -->

        <!-- *************
				************ Main container start *************
			************* -->
        <div class="main-container">

            <!-- Page header starts -->
            <?php include "./include/header.php"; ?>
            <!-- Page header ends -->

            <!-- Content wrapper scroll start -->
            <div class="content-wrapper-scroll">

                <!-- Content wrapper start -->
                <div class="content-wrapper">


                    <!-- Row start -->
                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                            <div class="profile-header">
                                <h1>ยินดีต้อนรับเข้าสู่ระบบ</h1>
                                <div class="profile-header-content">
                                    <div class="profile-header-tiles">
                                        <div class="row gutters">
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                                <div class="profile-tile">
                                                    <span class="icon">
                                                        <i class="icon-server"></i>
                                                    </span>
                                                    <h6>ชื่อผู้ใช้งาน - <span><?php echo $_SESSION["sess-bgu-user_code"]; ?></span></h6>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                                <div class="profile-tile">
                                                    <span class="icon">
                                                        <i class="icon-dollar-sign"></i>
                                                    </span>
                                                    <h6>สังกัด - <span><?php echo $_SESSION["sess-bgu-user_name"]; ?></span></h6>
                                                </div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">
                                                <div class="profile-tile">
                                                    <span class="icon">
                                                        <i class="icon-schedule"></i>
                                                    </span>
                                                    <h6>ปีงบประมาณ - <span><?php echo $_SESSION["sess-bgu-periodid"]; ?></span></h6>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="profile-avatar-tile">
                                        <img src="./img/blank_user.jpeg" class="img-fluid" alt="User Profile" />
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Row end -->
                    <!-- Row start -->
                    <div class="row gutters">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                            <!-- Card start -->
                            <div class="card">
                                <div class="card-body">

                                    <!-- Faq start -->
                                    <div class="accordion" id="faqAccordion">


                                        <?php

                                        $sql2 = "SELECT * FROM v_budgetegroup";

                                        $params2 = array();
                                        $result2 = $con->prepare($sql2);
                                        $res2 = $result2->execute($params2);
                                        while ($data2 = $result2->fetch()) {
                                        ?>

                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="heading<?php echo $data2['budgetgroup_id'] ?>">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $data2['budgetgroup_id'] ?>" aria-expanded="false" aria-controls="collapse<?php echo $data2['budgetgroup_id'] ?>">
                                                        <?php echo $data2['budgetgroup_name'] ?>
                                                    </button>
                                                </h2>
                                                <div id="collapse<?php echo $data2['budgetgroup_id'] ?>" class="accordion-collapse collapse" aria-labelledby="heading<?php echo $data2['budgetgroup_id'] ?>" data-bs-parent="#faqAccordion">
                                                    <div class="accordion-body">
                                                        <h5 class="text-center">งบ <?php echo $data2['budgetgroup_name'] ?></h5>

                                                        <div class="table-responsive">
                                                            <table class="table table-bordered table-striped m-0" style="vertical-align: middle;">
                                                                <thead>
                                                                    <tr class="text-center">

                                                                        <th width="60%">รายละเอียดงบ</th>
                                                                        <th width="40%">จำนวนเงิน</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    $i = 1;
                                                                    $sql = "SELECT
                                                                    * 
                                                                FROM
                                                                    v_project p 
                                                                WHERE
                                                                    p.departmentid = :departmentid
                                                                    AND p.budgetgroup_id = :budgetgroup_id
                                                                    AND p.periodid = :periodid 
                                                                ORDER BY
                                                                    p.productid ASC";

                                                                    $params = array(
                                                                        'departmentid' => $_SESSION["sess-bgu-departmentid"],
                                                                        'budgetgroup_id' => $data2['budgetgroup_id'],
                                                                        'periodid' => $_SESSION["sess-bgu-periodid"]
                                                                    );
                                                                    $result = $con->prepare($sql);
                                                                    $res = $result->execute($params);
                                                                    while ($data1 = $result->fetch()) {
                                                                    ?>

                                                                        <tr>

                                                                            <td style="vertical-align: top;">
                                                                                <ul class="list-group m-0">
                                                                                    <li class="list-group-item active"><b> ชื่อ : </b> <?php echo $data1['projectname'] ?></li>
                                                                                    <li class="list-group-item"><b>งบประมาณ : </b> <?php echo $data1['budgetgroup_code'] . " " . $data1['budgetgroup_name'] ?></li>
                                                                                    <li class="list-group-item"><b>แผน : </b> <?php echo $data1['PLANNAME'] ?></li>
                                                                                    <li class="list-group-item"><b>โครงการ : </b> <?php echo $data1['PRODUCTNAME'] ?></li>
                                                                                    <li class="list-group-item"><b>ยุทธศาสตร์ : </b> <?php echo $data1['STRATEGYUNAME'] ?></li>
                                                                                    <li class="list-group-item"><b>งบ : </b> <?php echo $data1['budgettype_name'] ?></li>
                                                                                </ul>
                                                                            </td>
                                                                            <td class="">
                                                                                <div class="row">
                                                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                                                        <ol class="list-group">
                                                                                            <li class="list-group-item"> ต.ค.<?php echo (substr($data1['periodid'], 2) - 1) . " : " . number_format($data1['m1']) . " บาท"; ?> </li>
                                                                                            <li class="list-group-item"> พ.ย.<?php echo (substr($data1['periodid'], 2) - 1) . " : " . number_format($data1['m2']) . " บาท"; ?> </li>
                                                                                            <li class="list-group-item"> ธ.ค.<?php echo (substr($data1['periodid'], 2) - 1) . " : " . number_format($data1['m3']) . " บาท"; ?> </li>
                                                                                            <li class="list-group-item"> ม.ค.<?php echo (substr($data1['periodid'], 2)) . " : " . number_format($data1['m4']) . " บาท"; ?> </li>
                                                                                            <li class="list-group-item"> ก.พ.<?php echo (substr($data1['periodid'], 2)) . " : " . number_format($data1['m5']) . " บาท"; ?> </li>
                                                                                            <li class="list-group-item"> มี.ค.<?php echo (substr($data1['periodid'], 2)) . " : " . number_format($data1['m6']) . " บาท"; ?> </li>
                                                                                        </ol>
                                                                                    </div>
                                                                                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-12">
                                                                                        <ol class="list-group">

                                                                                            <li class="list-group-item"> เม.ย.<?php echo (substr($data1['periodid'], 2)) . " : " . number_format($data1['m7']) . " บาท"; ?> </li>
                                                                                            <li class="list-group-item"> พ.ค.<?php echo (substr($data1['periodid'], 2)) . " : " . number_format($data1['m8']) . " บาท"; ?> </li>
                                                                                            <li class="list-group-item"> มิ.ย.<?php echo (substr($data1['periodid'], 2)) . " : " . number_format($data1['m9']) . " บาท"; ?> </li>
                                                                                            <li class="list-group-item"> ก.ค.<?php echo (substr($data1['periodid'], 2)) . " : " . number_format($data1['m10']) . " บาท"; ?> </li>
                                                                                            <li class="list-group-item"> ส.ค.<?php echo (substr($data1['periodid'], 2)) . " : " . number_format($data1['m11']) . " บาท"; ?> </li>
                                                                                            <li class="list-group-item"> ก.ย.<?php echo (substr($data1['periodid'], 2)) . " : " . number_format($data1['m12']) . " บาท"; ?> </li>
                                                                                        </ol>
                                                                                    </div>
                                                                                </div>

                                                                            </td>

                                                                        </tr>
                                                                    <?php $i++;
                                                                    } ?>



                                                            </table>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>

                                    </div>
                                    <!-- Faq end -->

                                </div>
                            </div>
                            <!-- Card end -->

                        </div>
                    </div>
                    <!-- Row end -->

                </div>
                <!-- Content wrapper end -->

                <!-- App footer start -->
                <?php include "./include/footer.php"; ?>
                <!-- App footer end -->

            </div>
            <!-- Content wrapper scroll end -->

        </div>
        <!-- *************
				************ Main container end *************
			************* -->

    </div>
    <!-- Page wrapper end -->
    <?php include "./include/script.php"; ?>


</body>

</html>