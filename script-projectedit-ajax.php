<?php
session_start();
include "./authen/check_authen.php";
include "./config/global.php";
include "./config/database.php";

$projectid = $_POST['projectid'];
$periodid = $_SESSION['sess-bgu-periodid'];

$sql = "SELECT
s.projectid, 
s.budgetgroup_id, 
s.strategyuid, 
s.periodid,
s.departmentid,
s.planid, 
s.productid, 
s.budgettype_id, 
s.budgettype_sub_id, 
s.projectname, 
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
m12, 
FORMAT((m1+m2+m3+m4+m5+m6+m7+m8+m9+m10+m11+m12),0) as sum_budget,
b.budgettype_sub_name
FROM
project AS s
INNER JOIN
	budgettype_sub AS b
	ON 
		s.budgettype_sub_id = b.budgettype_sub_id
WHERE
s.projectid = :projectid
";

$params = array(
    'projectid' => $projectid
);
$result = $con->prepare($sql);
$res = $result->execute($params);
$row = $result->rowCount();

$default = $result->fetch();


?>


<form class="needs-validation" id="form-plan-edit" name="form-plan-edit" action="script-updateproject.php" method="post">
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
            <div class="alert alert-secondary" role="alert">
                แก้ไขข้อมูลรายการ <?php echo $default['projectname'] ?>
            </div>

        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

            <input type="hidden" name="projectid" id="projectid" value="<?php echo $default['projectid'] ?>" />
            <input type="hidden" name="periodid" id="periodid" value="<?php echo $default['periodid'] ?>" />
            <input type="hidden" name="departmentid" id="departmentid" value="<?php echo $default['departmentid'] ?>" />
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
                        <option value="<?php echo $data['budgetgroup_id'] ?>" <?php
                                                                                if ($data['budgetgroup_id'] == $default['budgetgroup_id']) {
                                                                                    echo "selected";
                                                                                }
                                                                                ?>><?php echo $data['budgetgroup_code'] . " " . $data['budgetgroup_name'] ?></option>
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
                        <option value="<?php echo $data['PLANID'] ?>" <?php
                                                                        if ($data['PLANID'] == $default['planid']) {
                                                                            echo "selected";
                                                                        }
                                                                        ?>><?php echo $data['PLANCODE'] . " " . $data['PLANNAME'] ?></option>
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

                    <?php

                    $sql = "SELECT
                        s.PRODUCTID,
                        s.PRODUCTNAME,
                        s.PLANID
                        FROM
                        product AS s
                        WHERE
                        s.PLANID = :PLANID";

                    $params = array(
                        'PLANID' => $default['planid']
                    );
                    $result = $con->prepare($sql);
                    $res = $result->execute($params);
                    while ($data = $result->fetch()) {
                    ?>
                        <option value="<?php echo $data['PRODUCTID'] ?>" <?php
                                                                            if ($data['PRODUCTID'] == $default['productid']) {
                                                                                echo "selected";
                                                                            }
                                                                            ?>><?php echo $data['PRODUCTNAME'] ?></option>
                    <?php } ?>


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
                        <option value="<?php echo $data['STRATEGYUID'] ?>" <?php
                                                                            if ($data['STRATEGYUID'] == $default['strategyuid']) {
                                                                                echo "selected";
                                                                            }
                                                                            ?>><?php echo $data['STRATEGYUNAME']  ?></option>
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
                        <option value="<?php echo $data['budgettype_id'] ?>" <?php
                                                                                if ($data['budgettype_id'] == $default['budgettype_id']) {
                                                                                    echo "selected";
                                                                                }
                                                                                ?>><?php echo $data['budgettype_name']  ?></option>
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

                    <?php
                    $sql = "SELECT * FROM
                    budgettype_sub AS s
                    WHERE
                    s.budgettype_id = :budgettype_id";

                    $params = array(
                        'budgettype_id' => $default['budgettype_id']
                    );
                    $result = $con->prepare($sql);
                    $res = $result->execute($params);
                    while ($data = $result->fetch()) {
                    ?>

                        <option value="<?php echo $data['budgettype_sub_id'] ?>" <?php
                                                                                    if ($data['budgettype_sub_id'] == $default['budgettype_sub_id']) {
                                                                                        echo "selected";
                                                                                    }
                                                                                    ?>><?php echo $data['budgettype_sub_name'] ?></option>

                    <?php } ?>


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
                    <input class="form-control" type="text" id="projectname" name="projectname" value="<?php echo $default['projectname'] ?>" autofocus required>
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
                    <input class="form-control" type="number" min="0" id="m1" name="m1" value="<?php echo $default['m1'] ?>" required>
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
                    <input class="form-control" type="number" min="0" id="m2" name="m2" value="<?php echo $default['m2'] ?>" required>
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
                    <input class="form-control" type="number" min="0" id="m3" name="m3" value="<?php echo $default['m3'] ?>" required>
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
                    <input class="form-control" type="number" min="0" id="m4" name="m4" value="<?php echo $default['m4'] ?>" required>
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
                    <input class="form-control" type="number" min="0" id="m5" name="m5" value="<?php echo $default['m5'] ?>" required>
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
                    <input class="form-control" type="number" min="0" id="m6" name="m6" value="<?php echo $default['m6'] ?>" required>
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
                    <input class="form-control" type="number" min="0" id="m7" name="m7" value="<?php echo $default['m7'] ?>" required>
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
                    <input class="form-control" type="number" min="0" id="m8" name="m8" value="<?php echo $default['m8'] ?>" required>
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
                    <input class="form-control" type="number" min="0" id="m9" name="m9" value="<?php echo $default['m9'] ?>" required>
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
                    <input class="form-control" type="number" min="0" id="m10" name="m10" value="<?php echo $default['m10'] ?>" required>
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
                    <input class="form-control" type="number" min="0" id="m11" name="m11" value="<?php echo $default['m11'] ?>" required>
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
                    <input class="form-control" type="number" min="0" id="m12" name="m12" value="<?php echo $default['m12'] ?>" required>
                    <span class="input-group-text">
                        <i class="icon-dollar-sign"></i>
                    </span>
                </div>
                <div class="field-placeholder">ก.ย.<?php echo substr($periodid, 2); ?></div>
            </div>
            <!-- Field wrapper end -->

        </div>



        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <button class="btn btn-primary" type="submit">บันทึกการแก้ไขรายการ</button>
        </div>
    </div>
    <!-- Row end -->
</form>