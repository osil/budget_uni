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
                            <div class="card">
                                <div class="card-body">
                                    <div class="row gutters">
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                            <!-- Field wrapper start -->
                                            <div class="field-wrapper">
                                                <select class="select-single js-states form-select required" data-live-search="true" id="budgetgroup_id" name="budgetgroup_id" onchange="_getBudgetgroup()">
                                                    <option value="">เลือกประเภทแหล่งเงิน</option>
                                                    <?php

                                                    $sql = "SELECT * FROM v_budgetegroup";

                                                    $params = array();
                                                    $result = $con->prepare($sql);
                                                    $res = $result->execute($params);
                                                    $row = $result->rowCount();
                                                    while ($data = $result->fetch()) {
                                                    ?>
                                                        <option value="<?php echo $data['budgetgroup_id'] ?>"><?php echo $data['budgetgroup_name'] ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="field-placeholder">เลือกประเภทแหล่งเงิน</div>
                                                <div class="invalid-feedback">
                                                    * กรุณาเลือก
                                                </div>
                                            </div>
                                            <!-- Field wrapper end -->

                                        </div>
                                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                                            <!-- Field wrapper start -->
                                            <div class="field-wrapper">
                                                <select class="select-single js-states form-select required" data-live-search="true" id="departmentid" name="departmentid" onchange="_getDepartment(this.value)">
                                                    <option value="">เลือกสาขา</option>
                                                    <?php

                                                    $sql = "SELECT * FROM v_department where master_id = :master_id";

                                                    $params = array(
                                                        'master_id' => $_SESSION["sess-bgu-departmentid"]
                                                    );
                                                    $result = $con->prepare($sql);
                                                    $res = $result->execute($params);
                                                    $row = $result->rowCount();
                                                    while ($data = $result->fetch()) {
                                                    ?>
                                                        <option value="<?php echo $data['departmentid'] ?>"><?php echo $data['departmentname'] ?></option>
                                                    <?php } ?>
                                                </select>
                                                <div class="field-placeholder">เลือกสาขา</div>
                                                <div class="invalid-feedback">
                                                    * กรุณาเลือก
                                                </div>
                                            </div>
                                            <!-- Field wrapper end -->

                                        </div>
                                    </div>


                                </div>

                            </div>

                        </div>



                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                            <!-- Card start -->
                            <div class="card">
                                <div class="card-body">


                                    <div id="show_detail">

                                        <div class="table-responsive">
                                            <table class="table table-bordered m-0" style="width: 100%; ">
                                                <thead>
                                                    <tr class="text-center" style="vertical-align: middle;">
                                                        <th rowspan="2">#</th>
                                                        <th rowspan="2">แผนงาน / ผลผลิต</th>
                                                        <th>งบบุคลากร</th>
                                                        <th colspan="4">งบดำเนินงาน</th>
                                                        <th colspan="2">งบลงทุน</th>
                                                        <th rowspan="2">งบเงินอุดหนุน</th>
                                                        <th rowspan="2">งบรายจ่ายอื่นๆ</th>
                                                        <th rowspan="2">รวมทั้งสิ้น</th>
                                                        <th rowspan="2">Option</th>
                                                    </tr>
                                                    <tr class="text-center" style="vertical-align: middle;">

                                                        <th>ค่าจ้างชั่วคราว</th>
                                                        <th>ค่าตอบแทน</th>
                                                        <th>ค่าใช้สอย</th>
                                                        <th>ค่าวัสดุ</th>
                                                        <th>ค่าสาธารณูปโภค</th>
                                                        <th>ค่าครุภัณฑ์</th>
                                                        <th>ค่าที่ดินและ<br>สิ่งปลูกสร้าง</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>




                                    </div>

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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        function _getBudgetgroup() {

            $("#departmentid").val("").change();
        }

        function _getDepartment(department_id) {
            const budgetgroup_id = $("#budgetgroup_id").val();
            if (budgetgroup_id != "") {
                $.ajax({
                    type: "POST",
                    url: "script-gettableindex-ajax.php",
                    data: {
                        department_id,
                        budgetgroup_id
                    },
                    beforeSend: function() {
                        $("#loading-wrapper").show();
                    },
                    success: function(msg) {
                        $("#loading-wrapper").hide();
                        $("#show_detail").html(msg)


                    }

                })
            } else {
                console.log("else")
            }

        }

        function _deleteProject(projectid) {
            Swal.fire({
                title: 'ยืนยันการทำรายการ?',
                text: "คุณต้องการที่จะลบข้อมูล!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        type: "POST",
                        url: "script-deleteproject-ajax.php",
                        data: {
                            projectid
                        },
                        success: function(msg) {
                            if (msg === 'ok') {
                                Swal.fire({

                                    icon: 'success',
                                    title: 'ลบข้อมูลสำเร็จแล้ว',
                                    showConfirmButton: false,
                                    timer: 2500
                                })
                                _setInterval();



                            } else {
                                Swal.fire({

                                    icon: 'error',
                                    title: 'เกิดข้อผิดพลาดในการลบข้อมูล ' + msg,
                                    showConfirmButton: false,
                                    timer: 2500
                                })
                            }

                        }

                    })

                }
            })
        }

        function _editProject(projectid) {
            Swal.fire({
                title: 'ยืนยันการทำรายการ?',
                text: "คุณต้องการที่จะแก้ไขข้อมูล!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Edit it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    console.log("edit")
                    window.location = 'editproject.php?id=' + projectid;

                }
            })
        }

        function _setInterval() {
            setInterval(function() {
                location.reload();
            }, 3000);
        }
    </script>


</body>

</html>