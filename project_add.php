<?php
session_start();
include "./authen/check_authen.php";
include "./config/global.php";
include "./config/database.php";

$periodid = $_SESSION['sess-bgu-periodid'];

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
                                    <form class="needs-validation" novalidate>
                                        <div class="row gutters">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                                                <div class="form-section-header">บันทึกงบประมาณรายจ่ายเงินรายได้ประจำปีงบประมาณ <?php echo $_SESSION['sess-bgu-periodid'] ?></div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <select class="select-single js-states form-select required" data-live-search="true" id="budgetgroup_id" name="budgetgroup_id" required>
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
                                                    <select class="select-single js-states form-select required" data-live-search="true" id="strategyuid" name="strategyuid" required>
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
                                                <div class="form-section-header">รายละเอียดการ <span class="title-info">We'll never share your with anyone.</span></div>
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
                                                        <input class="form-control" type="number" min="0" id="m1" name="m1" required>
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
                                                        <input class="form-control" type="number" min="0" id="m2" name="m2" required>
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
                                                        <input class="form-control" type="number" min="0" id="m3" name="m3" required>
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
                                                        <input class="form-control" type="number" min="0" id="m4" name="m4" required>
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
                                                        <input class="form-control" type="number" min="0" id="m5" name="m5" required>
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
                                                        <input class="form-control" type="number" min="0" id="m6" name="m6" required>
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
                                                        <input class="form-control" type="number" min="0" id="m7" name="m7" required>
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
                                                        <input class="form-control" type="number" min="0" id="m8" name="m8" required>
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
                                                        <input class="form-control" type="number" min="0" id="m9" name="m9" required>
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
                                                        <input class="form-control" type="number" min="0" id="m10" name="m10" required>
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
                                                        <input class="form-control" type="number" min="0" id="m11" name="m11" required>
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
                                                        <input class="form-control" type="number" min="0" id="m12" name="m12" required>
                                                        <span class="input-group-text">
                                                            <i class="icon-dollar-sign"></i>
                                                        </span>
                                                    </div>
                                                    <div class="field-placeholder">ก.ย.<?php echo substr($periodid, 2); ?></div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>



                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <button class="btn btn-primary" type="submit" name="">Submit</button>
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
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()

        function _getProduct(planid) {
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
    </script>


</body>

</html>