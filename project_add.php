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
                                <div class="card-body" id="card-form">

                                    <!-- Row start -->
                                    <form class="needs-validation" id="form-plan" name="form-plan" novalidate>
                                        <div class="row gutters">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                                                <div class="form-section-header">บันทึกยุทธศาสตร์</div>
                                            </div>

                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <select class="select-single js-states form-select required" data-live-search="true" id="phase_id" name="phase_id" onchange="_getStrategy(this.value)" required>
                                                        <option value="">เลือกแผนยุทธศาสตร์</option>
                                                        <?php

                                                        $sql = "SELECT * FROM tb_phase";

                                                        $params = array();
                                                        $result = $con->prepare($sql);
                                                        $res = $result->execute($params);
                                                        $row = $result->rowCount();
                                                        while ($data = $result->fetch()) {
                                                        ?>
                                                            <option value="<?php echo $data['id'] ?>"><?php echo $data['name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <div class="field-placeholder">เลือกแผนยุทธศาสตร์</div>
                                                    <div class="invalid-feedback">
                                                        * กรุณาเลือก
                                                    </div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <select class="select-single js-states form-select required" data-live-search="true" id="strategy_id" name="strategy_id" onchange="_getTarget(this.value)" required>
                                                        <option value="">เลือกยุทธศาสตร์</option>

                                                    </select>
                                                    <div class="field-placeholder">เลือกยุทธศาสตร์</div>
                                                    <div class="invalid-feedback">
                                                        * กรุณาเลือก
                                                    </div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <select class="select-single js-states form-select required" data-live-search="true" id="target_id" name="target_id" onchange="_getStrategic(this.value)" required>
                                                        <option value="">เลือกเป้าหมาย</option>

                                                    </select>
                                                    <div class="field-placeholder">เลือกเป้าหมาย</div>
                                                    <div class="invalid-feedback">
                                                        * กรุณาเลือก
                                                    </div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>

                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <select class="select-single js-states form-select required" data-live-search="true" id="strategic_id" name="strategic_id" onchange="_getIndicator(this.value)" required>
                                                        <option value="">เลือกกลยุทธ</option>

                                                    </select>
                                                    <div class="field-placeholder">เลือกกลยุทธ</div>
                                                    <div class="invalid-feedback">
                                                        * กรุณาเลือก
                                                    </div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>

                                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                                                <div class="field-wrapper">
                                                    <select class="select-multiple js-states" title="Select Product Category" multiple="multiple" id="indicator_id" name="indicator_id[]" required>
                                                        <option>เลือกตัวชี้วัด</option>

                                                    </select>
                                                    <div class="field-placeholder">เลือกตัวชี้วัด</div>
                                                    <div class="invalid-feedback">
                                                        * กรุณาเลือก
                                                    </div>
                                                </div>
                                            </div>





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
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

                            // var select = document.getElementById('indicator_id');
                            // var selected = [...select.selectedOptions]
                            //     .map(option => option.value);

                            const phase_id = $("#phase_id").val();
                            const strategy_id = $("#strategy_id").val();
                            const target_id = $("#target_id").val();
                            const strategic_id = $("#strategic_id").val();
                            const indicator_id = $("#indicator_id").val();
                            //console.log(indicator_id);

                            const budgetgroup_id = $("#budgetgroup_id").val();
                            const planid = $("#planid").val();
                            const productid = $("#productid").val();
                            const strategyuid = $("#strategyuid").val();
                            const budgettype_id = $("#budgettype_id").val();
                            const budgettype_sub_id = $("#budgettype_sub_id").val();
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
                                    phase_id,
                                    strategy_id,
                                    target_id,
                                    strategic_id,
                                    indicator_id,
                                    budgetgroup_id,
                                    planid,
                                    productid,
                                    strategyuid,
                                    budgettype_id,
                                    budgettype_sub_id,
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
                                    //console.log(msg);
                                    if (msg === 'ok') {
                                        Swal.fire({

                                            icon: 'success',
                                            title: 'บันทึกข้อมูลสำเร็จแล้ว',
                                            showConfirmButton: false,
                                            timer: 2500
                                        })
                                        _getDetailTable(budgetgroup_id, planid, productid, strategyuid, budgettype_id, departmentid, periodid);
                                        $("#projectname").val("").change();
                                        $("#m1").val("0").change();
                                        $("#m2").val("0").change();
                                        $("#m3").val("0").change();
                                        $("#m4").val("0").change();
                                        $("#m5").val("0").change();
                                        $("#m6").val("0").change();
                                        $("#m7").val("0").change();
                                        $("#m8").val("0").change();
                                        $("#m9").val("0").change();
                                        $("#m10").val("0").change();
                                        $("#m11").val("0").change();
                                        $("#m12").val("0").change();

                                    } else {
                                        Swal.fire({

                                            icon: 'error',
                                            title: 'เกิดข้อผิดพลาดในการบันทึกข้อมูล ' + msg,
                                            showConfirmButton: false,
                                            timer: 2500
                                        })
                                    }
                                }

                            })


                        }

                        form.classList.add('was-validated')

                    }, false)

                })


        })()

        function _getStrategy(phase_id) {
            //ดึงข้อมูลยุทธศาสตร
            $("#strategy_id").val("").change();
            $("#target_id").val("").change();
            $("#strategic_id").val("").change();
            $("#indicator_id").val("").change();
            $.ajax({
                type: "POST",
                url: "script-getstrategy-ajax.php",
                data: {
                    phase_id
                },
                success: function(msg) {
                    $("#strategy_id").html(msg)
                }

            })

        }

        function _getTarget(strategy_id) {
            //ดึงข้อมูลเป้าหมายจาก table target
            $("#target_id").val("").change();
            $("#strategic_id").val("").change();
            $("#indicator_id").val("").change();

            $.ajax({
                type: "POST",
                url: "script-gettarget-ajax.php",
                data: {
                    strategy_id
                },
                success: function(msg) {
                    $("#target_id").html(msg)
                }

            })
        }

        function _getStrategic(target_id) {
            //ดึงข้อมูลเป้าหมายจาก table Strategic
            $("#strategic_id").val("").change();
            $("#indicator_id").val("").change();

            $.ajax({
                type: "POST",
                url: "script-getstrategic-ajax.php",
                data: {
                    target_id
                },
                success: function(msg) {
                    $("#strategic_id").html(msg)
                }

            })
        }

        function _getIndicator(strategic_id) {
            //ดึงข้อมูลเป้าหมายจาก table Indicator
            $("#indicator_id").val("").change();

            $.ajax({
                type: "POST",
                url: "script-getindicator-ajax.php",
                data: {
                    strategic_id
                },
                success: function(msg) {
                    $("#indicator_id").html(msg)
                }

            })
        }

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
        $("#form-plan-edit").submit(function(event) {

            /* stop form from submitting normally */
            event.preventDefault();
            console.log("form-plan-edit")
        });

        function _editProject(projectid) {
            Swal.fire({
                title: 'ยืนยันการทำรายการ?',
                text: "คุณต้องการทำรายการต่อหรือไม่ !!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Edit it!'
            }).then((result) => {
                if (result.isConfirmed) {


                    $.ajax({
                        type: "POST",
                        url: "script-projectedit-ajax.php",
                        data: {
                            projectid
                        },
                        success: function(msg) {

                            $("#card-form").html(msg)
                        }

                    })




                }
            })
        }

        function _delProject(projectid) {
            const budgetgroup_id = $("#budgetgroup_id").val();
            const planid = $("#planid").val();
            const productid = $("#productid").val();
            const strategyuid = $("#strategyuid").val();
            const budgettype_id = $("#budgettype_id").val();
            const departmentid = <?php echo $_SESSION["sess-bgu-departmentid"] ?>;
            const periodid = <?php echo $periodid ?>;

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
                                _getDetailTable(budgetgroup_id, planid, productid, strategyuid, budgettype_id, departmentid, periodid);


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
    </script>


</body>

</html>