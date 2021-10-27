<?php
session_start();
include "./authen/check_authen.php";
include "./config/global.php";
include "./config/database.php";

$periodid = $_SESSION['sess-bgu-periodid'];
$actual_link = "http://$_SERVER[HTTP_HOST]";
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

                            <!-- Card start -->
                            <div class="card">
                                <div class="card-body">

                                    <!-- Row start -->
                                    <form class="needs-validation" id="form-plan" name="form-plan" novalidate>
                                        <div class="row gutters">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                                                <div class="form-section-header">บันทึกงบประมาณรายจ่ายเงินรายได้ประจำปีงบประมาณ <?php echo $_SESSION['sess-bgu-periodid'] ?></div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <select class="select-single js-states form-select required" data-live-search="true" id="budgetgroup_id" name="budgetgroup_id" onchange="_budgetgroup()" required>
                                                        <option value="">เลือกประเภทงบประมาณ</option>
                                                        <?php

                                                        $sql = "SELECT * FROM v_budgetegroup";

                                                        $params = array();
                                                        $result = $con->prepare($sql);
                                                        $res = $result->execute($params);
                                                        $row = $result->rowCount();
                                                        while ($data = $result->fetch()) {
                                                        ?>
                                                            <option value="<?php echo $data['budgetgroup_id'] ?>"><?php echo $data['budgetgroup_code'] . " " . $data['budgetgroup_name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <div class="field-placeholder">ประเภทงบประมาณ</div>
                                                    <div class="invalid-feedback">
                                                        * กรุณาเลือก
                                                    </div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <select class="select-single js-states form-select required" data-live-search="true" id="planid" name="planid" onchange="_getProduct(this.value)" required>
                                                        <option value="">เลือกประเภทแผน</option>
                                                        <?php

                                                        $sql = "SELECT * FROM plan";

                                                        $params = array();
                                                        $result = $con->prepare($sql);
                                                        $res = $result->execute($params);
                                                        $row = $result->rowCount();
                                                        while ($data = $result->fetch()) {
                                                        ?>
                                                            <option value="<?php echo $data['PLANID'] ?>"><?php echo $data['PLANCODE'] . " " . $data['PLANNAME'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <div class="field-placeholder">ประเภทแผน</div>
                                                    <div class="invalid-feedback">
                                                        * กรุณาเลือก
                                                    </div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">

                                                    <select class="select-single js-states required" data-live-search="true" id="productid" name="productid" required>
                                                        <option value="">เลือกประเภทโครงการ</option>


                                                    </select>
                                                    <div class="field-placeholder">เลือกประเภทโครงการ</div>
                                                    <div class="invalid-feedback">
                                                        * กรุณาเลือก
                                                    </div>


                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <select class="select-single js-states form-select required" data-live-search="true" id="strategyuid" name="strategyuid" onchange="_strategyu()" required>
                                                        <option value="">เลือกประเภทยุทธศาสตร์</option>
                                                        <?php

                                                        $sql = "SELECT * FROM strategyu";

                                                        $params = array();
                                                        $result = $con->prepare($sql);
                                                        $res = $result->execute($params);
                                                        $row = $result->rowCount();
                                                        while ($data = $result->fetch()) {
                                                        ?>
                                                            <option value="<?php echo $data['STRATEGYUID'] ?>"><?php echo $data['STRATEGYUNAME']  ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <div class="field-placeholder">เลือกประเภทยุทธศาสตร์</div>
                                                    <div class="invalid-feedback">
                                                        * กรุณาเลือก
                                                    </div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <select class="select-single js-states form-select required" data-live-search="true" id="budgettype_id" name="budgettype_id" onchange="_getBudgetSubType(this.value)" required>
                                                        <option value="">เลือกประเภทงบ</option>
                                                        <?php

                                                        $sql = "SELECT * FROM budgettype";

                                                        $params = array();
                                                        $result = $con->prepare($sql);
                                                        $res = $result->execute($params);
                                                        $row = $result->rowCount();
                                                        while ($data = $result->fetch()) {
                                                        ?>
                                                            <option value="<?php echo $data['budgettype_id'] ?>"><?php echo $data['budgettype_name']  ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <div class="field-placeholder">เลือกประเภทงบ</div>
                                                    <div class="invalid-feedback">
                                                        * กรุณาเลือก
                                                    </div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">

                                                    <select class="select-single js-states required" data-live-search="true" id="budgettype_sub_id" name="budgettype_sub_id" required>
                                                        <option value="">เลือกรายละเอียดงบ</option>


                                                    </select>
                                                    <div class="field-placeholder">เลือกรายละเอียดงบ</div>
                                                    <div class="invalid-feedback">
                                                        * กรุณาเลือก
                                                    </div>


                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>

                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                                                <div class="form-section-header">รายละเอียดการ <span class="title-info"></span></div>
                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <div class="input-group">
                                                        <input class="form-control" type="text" id="projectname" name="projectname" required>
                                                        <span class="input-group-text">
                                                            <i class="icon-info2"></i>
                                                        </span>
                                                    </div>
                                                    <div class="field-placeholder">ชื่อโครงการ</div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>



                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                                                <div class="form-section-header">รายละเอียดการใช้เงินแต่ละเดือน ประจำปีงบประมาณ <?php echo $periodid; ?></div>
                                            </div>
                                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <div class="input-group">
                                                        <input class="form-control" type="number" min="0" id="m1" name="m1" value="0" required>
                                                        <span class="input-group-text">
                                                            <i class="icon-dollar-sign"></i>
                                                        </span>
                                                    </div>
                                                    <div class="field-placeholder">ต.ค.<?php echo (substr($periodid, 2) - 1); ?></div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>
                                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <div class="input-group">
                                                        <input class="form-control" type="number" min="0" id="m2" name="m2" value="0" required>
                                                        <span class="input-group-text">
                                                            <i class="icon-dollar-sign"></i>
                                                        </span>
                                                    </div>
                                                    <div class="field-placeholder">พ.ย.<?php echo (substr($periodid, 2) - 1); ?></div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>
                                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <div class="input-group">
                                                        <input class="form-control" type="number" min="0" id="m3" name="m3" value="0" required>
                                                        <span class="input-group-text">
                                                            <i class="icon-dollar-sign"></i>
                                                        </span>
                                                    </div>
                                                    <div class="field-placeholder">ธ.ค.<?php echo (substr($periodid, 2) - 1); ?></div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>

                                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <div class="input-group">
                                                        <input class="form-control" type="number" min="0" id="m4" name="m4" value="0" required>
                                                        <span class="input-group-text">
                                                            <i class="icon-dollar-sign"></i>
                                                        </span>
                                                    </div>
                                                    <div class="field-placeholder">ม.ค.<?php echo substr($periodid, 2); ?></div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>

                                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <div class="input-group">
                                                        <input class="form-control" type="number" min="0" id="m5" name="m5" value="0" required>
                                                        <span class="input-group-text">
                                                            <i class="icon-dollar-sign"></i>
                                                        </span>
                                                    </div>
                                                    <div class="field-placeholder">ก.พ.<?php echo substr($periodid, 2); ?></div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>
                                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <div class="input-group">
                                                        <input class="form-control" type="number" min="0" id="m6" name="m6" value="0" required>
                                                        <span class="input-group-text">
                                                            <i class="icon-dollar-sign"></i>
                                                        </span>
                                                    </div>
                                                    <div class="field-placeholder">มี.ค.<?php echo substr($periodid, 2); ?></div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>
                                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <div class="input-group">
                                                        <input class="form-control" type="number" min="0" id="m7" name="m7" value="0" required>
                                                        <span class="input-group-text">
                                                            <i class="icon-dollar-sign"></i>
                                                        </span>
                                                    </div>
                                                    <div class="field-placeholder">เม.ย.<?php echo substr($periodid, 2); ?></div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>
                                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <div class="input-group">
                                                        <input class="form-control" type="number" min="0" id="m8" name="m8" value="0" required>
                                                        <span class="input-group-text">
                                                            <i class="icon-dollar-sign"></i>
                                                        </span>
                                                    </div>
                                                    <div class="field-placeholder">พ.ค.<?php echo substr($periodid, 2); ?></div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>
                                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <div class="input-group">
                                                        <input class="form-control" type="number" min="0" id="m9" name="m9" value="0" required>
                                                        <span class="input-group-text">
                                                            <i class="icon-dollar-sign"></i>
                                                        </span>
                                                    </div>
                                                    <div class="field-placeholder">มิ.ย.<?php echo substr($periodid, 2); ?></div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>
                                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <div class="input-group">
                                                        <input class="form-control" type="number" min="0" id="m10" name="m10" value="0" required>
                                                        <span class="input-group-text">
                                                            <i class="icon-dollar-sign"></i>
                                                        </span>
                                                    </div>
                                                    <div class="field-placeholder">ก.ค.<?php echo substr($periodid, 2); ?></div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>
                                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <div class="input-group">
                                                        <input class="form-control" type="number" min="0" id="m11" name="m11" value="0" required>
                                                        <span class="input-group-text">
                                                            <i class="icon-dollar-sign"></i>
                                                        </span>
                                                    </div>
                                                    <div class="field-placeholder">ส.ค.<?php echo substr($periodid, 2); ?></div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>
                                            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-3 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <div class="input-group">
                                                        <input class="form-control" type="number" min="0" id="m12" name="m12" value="0" required>
                                                        <span class="input-group-text">
                                                            <i class="icon-dollar-sign"></i>
                                                        </span>
                                                    </div>
                                                    <div class="field-placeholder">ก.ย.<?php echo substr($periodid, 2); ?></div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>



                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <button class="btn btn-primary" type="submit" name="formsubmit" id="formsubmit">บันทึก</button>
                                            </div>
                                        </div>
                                        <!-- Row end -->
                                    </form>

                                </div>
                            </div>
                            <!-- Card end -->

                        </div>
                    </div>
                    <!-- Row end -->


                    <!-- Row start -->
                    <div class="row gutters" id="detail">
                        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12" id="detail_list">
                            <!-- Card start -->
                            <div class="card">
                                <div class="card-body">
                                    <ul class="list-group m-0">
                                        <li class="list-group-item active">รายละเอียด</li>
                                        <li class="list-group-item"><b>งบประมาณ : </b> <span id="budgetgroup_name"></span></li>
                                        <li class="list-group-item"><b>แผน : </b> <span id="plan_name"></span></li>
                                        <li class="list-group-item"><b>โครงการ : </b> <span id="product_name"></span></li>
                                        <li class="list-group-item"><b>ยุทธศาสตร์ : </b> <span id="strategyu_name"></span></li>
                                        <li class="list-group-item"><b>งบ : </b> <span id="budgettype_name"></span></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Card end -->
                        </div>
                        <div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">

                            <!-- Card start -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                                        <div class="alert alert-primary" role="alert">
                                            ตารางข้อมูลงบประมาณรายจ่ายเงินรายได้ประจำปีงบประมาณ
                                        </div>


                                    </div>
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div id="detail_table">

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

    <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {

            $("#detail").hide();
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()

                        } else {
                            const budgetgroup_id = $("#budgetgroup_id").val();
                            const planid = $("#planid").val();
                            const productid = $("#productid").val();
                            const strategyuid = $("#strategyuid").val();
                            const budgettype_id = $("#budgettype_id").val();
                            const departmentid = <?php echo $_SESSION["sess-bgu-departmentid"] ?>;
                            const periodid = <?php echo $periodid ?>;
                            const projectname = $("#projectname").val();
                            const m1 = $("#m1").val();
                            const m2 = $("#m2").val();
                            const m3 = $("#m3").val();
                            const m4 = $("#m4").val();
                            const m5 = $("#m5").val();
                            const m6 = $("#m6").val();
                            const m7 = $("#m7").val();
                            const m8 = $("#m8").val();
                            const m9 = $("#m9").val();
                            const m10 = $("#m10").val();
                            const m11 = $("#m11").val();
                            const m12 = $("#m12").val();

                            $.ajax({
                                type: "POST",
                                url: "script-insertproject-ajax.php",
                                data: {
                                    budgetgroup_id,
                                    planid,
                                    productid,
                                    strategyuid,
                                    budgettype_id,
                                    departmentid,
                                    periodid,
                                    projectname,
                                    m1,
                                    m2,
                                    m3,
                                    m4,
                                    m5,
                                    m6,
                                    m7,
                                    m8,
                                    m9,
                                    m10,
                                    m11,
                                    m12
                                },
                                success: function(msg) {
                                    console.log(msg);
                                }

                            })


                        }

                        form.classList.add('was-validated')

                    }, false)

                })


        })()

        function _getProduct(planid) {
            $("#strategyuid").val("").change();
            $("#budgettype_id").val("").change();
            $("#budgettype_sub_id").val("").change();
            $.ajax({
                type: "POST",
                url: "script-product-ajax.php",
                data: {
                    planid: planid
                },
                success: function(msg) {
                    $("#productid").html(msg)
                }

            })
        }

        function _getBudgetSubType(budgettype_id) {
            _getDataByBudgettype();
            $.ajax({
                type: "POST",
                url: "script-budgetsubtype-ajax.php",
                data: {
                    budgettype_id: budgettype_id
                },
                success: function(msg) {
                    $("#budgettype_sub_id").html(msg)
                }

            })
        }

        function _budgetgroup() {
            $("#planid").val("").change();
            $("#productid").val("").change();
            $("#strategyuid").val("").change();
            $("#budgettype_id").val("").change();
            $("#budgettype_sub_id").val("").change();
        }

        function _strategyu() {
            $("#budgettype_id").val("").change();
            $("#budgettype_sub_id").val("").change();
        }

        function _getDataByBudgettype() {
            const budgetgroup_id = $("#budgetgroup_id").val();
            const planid = $("#planid").val();
            const productid = $("#productid").val();
            const strategyuid = $("#strategyuid").val();
            const budgettype_id = $("#budgettype_id").val();
            const departmentid = <?php echo $_SESSION["sess-bgu-departmentid"] ?>;
            const periodid = <?php echo $periodid ?>;
            // console.log("budgetgroup_id : " + budgetgroup_id);
            // console.log("planid : " + planid);
            // console.log("productid : " + productid);
            // console.log("strategyuid : " + strategyuid);
            // console.log("budgettype_id : " + budgettype_id);
            // console.log("departmentid : " + departmentid);
            // console.log("periodid : " + periodid);

            if (budgetgroup_id != "" && planid != "" && productid != "" && strategyuid != "" && budgettype_id) {

                _getDetailList(budgetgroup_id, planid, productid, strategyuid, budgettype_id, departmentid, periodid);

                $("#detail").show();
                _getDetailTable(budgetgroup_id, planid, productid, strategyuid, budgettype_id, departmentid, periodid);


            } else {
                $("#detail").hide();
            }
        }

        function _getDetailList(budgetgroup_id, planid, productid, strategyuid, budgettype_id, departmentid, periodid) {
            $.ajax({
                type: "POST",
                url: "script-getdetaillist-ajax.php",
                data: {
                    budgetgroup_id,
                    planid,
                    productid,
                    strategyuid,
                    budgettype_id,
                    departmentid,
                    periodid
                },
                success: function(msg) {
                    $("#detail_list").html(msg)
                }

            })
        }

        function _getDetailTable(budgetgroup_id, planid, productid, strategyuid, budgettype_id, departmentid, periodid) {
            $.ajax({
                type: "POST",
                url: "script-getdetailtable-ajax.php",
                data: {
                    budgetgroup_id,
                    planid,
                    productid,
                    strategyuid,
                    budgettype_id,
                    departmentid,
                    periodid
                },
                success: function(msg) {
                    $("#detail_table").html(msg)
                }

            })
        }

        $("#form-plan").submit(function(event) {

            /* stop form from submitting normally */
            event.preventDefault();




        });
    </script>


</body>

</html>