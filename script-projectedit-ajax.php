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
b.budgettype_sub_name,
`phase_id`,
`strategy_id`,
`target_id`,
`strategic_id`
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

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
            <div class="form-section-header">แก้ไขยุทธศาสตร์</div>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

            <!-- Field wrapper start -->
            <div class="field-wrapper">
                <select class="select-single js-states form-select required" data-live-search="true" id="phase_id" name="phase_id" onchange="_getStrategy(this.value)" required>
                    <option value="">เลือกแผนยุทธศาสตร์</option>
                    <?php

                    $sql = "SELECT * FROM tb_phase where cur_status = :cur_status";

                    $params = array(
                        'cur_status' => '1'
                    );
                    $result = $con->prepare($sql);
                    $res = $result->execute($params);
                    $row = $result->rowCount();
                    while ($data = $result->fetch()) {
                    ?>
                        <option value="<?php echo $data['id'] ?>" <?php
                                                                    if ($data['id'] == $default['phase_id']) {
                                                                        echo "selected";
                                                                    }
                                                                    ?>><?php echo $data['name'] ?></option>
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
                    <?php

                    $sql = "SELECT * FROM
                    strategy AS s
                    WHERE
                    s.phase_id = :phase_id";

                    $params = array(
                        'phase_id' => $default['phase_id']
                    );
                    $result = $con->prepare($sql);
                    $res = $result->execute($params);
                    $row = $result->rowCount();
                    while ($data = $result->fetch()) {
                    ?>
                        <option value="<?php echo $data['id'] ?>" <?php
                                                                    if ($data['id'] == $default['strategy_id']) {
                                                                        echo "selected";
                                                                    }
                                                                    ?>><?php echo $data['code'] . " " . $data['name'] ?></option>
                    <?php } ?>

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
                    <?php

                    $sql = "SELECT * FROM
                    `target` AS s
                    WHERE
                    s.strategy_id = :strategy_id";

                    $params = array(
                        'strategy_id' => $default['strategy_id']
                    );
                    $result = $con->prepare($sql);
                    $res = $result->execute($params);
                    $row = $result->rowCount();
                    while ($data = $result->fetch()) {
                    ?>
                        <option value="<?php echo $data['id'] ?>" <?php
                                                                    if ($data['id'] == $default['target_id']) {
                                                                        echo "selected";
                                                                    }
                                                                    ?>><?php echo $data['code'] . " " . $data['name'] ?></option>
                    <?php } ?>

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
                    <?php

                    $sql = "SELECT * FROM
                        `strategic` AS s
                        WHERE
                        s.target_id = :target_id";

                    $params = array(
                        'target_id' => $default['target_id']
                    );
                    $result = $con->prepare($sql);
                    $res = $result->execute($params);
                    $row = $result->rowCount();
                    while ($data = $result->fetch()) {
                    ?>
                        <option value="<?php echo $data['id'] ?>" <?php
                                                                    if ($data['id'] == $default['strategic_id']) {
                                                                        echo "selected";
                                                                    }
                                                                    ?>><?php echo $data['code'] . " " . $data['name'] ?></option>
                    <?php } ?>

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
                <select class="select-multiple js-states" title="Select Product Category" multiple="multiple" id="indicator_id" name="indicator_id[]">
                    <option>เลือกตัวชี้วัด</option>
                    <?php

                    $sql = "SELECT
                    a.*,
                IF
                    ( ISNULL( bb.project_id ), 0, 1 ) AS ind_status 
                FROM
                    indicator a
                    LEFT JOIN ( SELECT project_id, indicator_id FROM project_indicator b WHERE b.`project_id` = :project_id ) bb ON a.id = bb.indicator_id 
                WHERE
                    a.`strategic_id` = :strategic_id";

                    $params = array(
                        'strategic_id' => $default['strategic_id'],
                        'project_id' => $default['projectid']
                    );
                    $result = $con->prepare($sql);
                    $res = $result->execute($params);
                    $row = $result->rowCount();
                    while ($data = $result->fetch()) {
                    ?>

                        <option value="<?php echo $data['id'] ?>" <?php if ($data['ind_status'] == '1') {
                                                                        echo "selected";
                                                                    } ?>><?php echo $data['code'] . " " . $data['name'] . '' . $data['ind_status']  ?></option>
                    <?php
                    } ?>

                </select>
                <div class="field-placeholder">เลือกตัวชี้วัด</div>
                <div class="invalid-feedback">
                    * กรุณาเลือก
                </div>
            </div>
        </div>




        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
            <div class="form-section-header">แก้ไขงบประมาณรายจ่ายเงินรายได้</div>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

            <input type="hidden" name="projectid" id="projectid" value="<?php echo $default['projectid'] ?>" />
            <input type="hidden" name="periodid" id="periodid" value="<?php echo $default['periodid'] ?>" />
            <!-- Field wrapper start -->
            <div class="field-wrapper">
                <select class="select-single js-states form-select required" data-live-search="true" id="budgetgroup_id" name="budgetgroup_id" onchange="_budgetgroup()" required>
                    <option value="">เลือกประเภทแหล่งเงิน</option>
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
                <div class="field-placeholder">เลือกประเภทแหล่งเงิน</div>
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

                    $sql = "SELECT * FROM plan where STATUS = :plan_status";

                    $params = array(
                        'plan_status' => '1',
                    );
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
                    <option value="">เลือกประเภทผลผลิต</option>

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
                <div class="field-placeholder">เลือกประเภทผลผลิต</div>
                <div class="invalid-feedback">
                    * กรุณาเลือก
                </div>


            </div>
            <!-- Field wrapper end -->

        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

            <!-- Field wrapper start -->
            <div class="field-wrapper">
                <select class="select-single js-states form-select required" data-live-search="true" id="departmentid" name="departmentid" required>
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
                        <option value="<?php echo $data['departmentid'] ?>" <?php
                                                                            if ($data['departmentid'] == $default['departmentid']) {
                                                                                echo "selected";
                                                                            } ?>><?php echo $data['departmentname'] ?></option>
                    <?php } ?>
                </select>
                <div class="field-placeholder">เลือกสาขา</div>
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
        <div class="field-wrapper">
            <div class="field-placeholder"><u>ไตรมาสที่ 1</u></div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

            <!-- Field wrapper start -->
            <div class="field-wrapper">
                <div class="input-group">
                    <input class="form-control" type="number" min="0" id="m1" name="m1" value="<?php echo $default['m1'] ?>" onfocus="Init(this)" onblur="Reset(this)" onchange="Compute('m1')" required>
                    <span class="input-group-text">
                        ฿
                    </span>
                </div>
                <div class="field-placeholder">ต.ค.<?php echo (substr($periodid, 2) - 1); ?></div>
            </div>
            <!-- Field wrapper end -->

        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

            <!-- Field wrapper start -->
            <div class="field-wrapper">
                <div class="input-group">
                    <input class="form-control" type="number" min="0" id="m2" name="m2" value="<?php echo $default['m2'] ?>" onfocus="Init(this)" onblur="Reset(this)" onchange="Compute('m1')" required>
                    <span class="input-group-text">
                        ฿
                    </span>
                </div>
                <div class="field-placeholder">พ.ย.<?php echo (substr($periodid, 2) - 1); ?></div>
            </div>
            <!-- Field wrapper end -->

        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

            <!-- Field wrapper start -->
            <div class="field-wrapper">
                <div class="input-group">
                    <input class="form-control" type="number" min="0" id="m3" name="m3" value="<?php echo $default['m3'] ?>" onfocus="Init(this)" onblur="Reset(this)" onchange="Compute('m1')" required>
                    <span class="input-group-text">
                        ฿
                    </span>
                </div>
                <div class="field-placeholder">ธ.ค.<?php echo (substr($periodid, 2) - 1); ?></div>
            </div>
            <!-- Field wrapper end -->

        </div>
        <div class="field-wrapper">
            <div class="field-placeholder"><u>ไตรมาสที่ 2</u></div>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

            <!-- Field wrapper start -->
            <div class="field-wrapper">
                <div class="input-group">
                    <input class="form-control" type="number" min="0" id="m4" name="m4" value="<?php echo $default['m4'] ?>" onfocus="Init(this)" onblur="Reset(this)" onchange="Compute('m1')" required>
                    <span class="input-group-text">
                        ฿
                    </span>
                </div>
                <div class="field-placeholder">ม.ค.<?php echo substr($periodid, 2); ?></div>
            </div>
            <!-- Field wrapper end -->

        </div>

        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

            <!-- Field wrapper start -->
            <div class="field-wrapper">
                <div class="input-group">
                    <input class="form-control" type="number" min="0" id="m5" name="m5" value="<?php echo $default['m5'] ?>" onfocus="Init(this)" onblur="Reset(this)" onchange="Compute('m1')" required>
                    <span class="input-group-text">
                        ฿
                    </span>
                </div>
                <div class="field-placeholder">ก.พ.<?php echo substr($periodid, 2); ?></div>
            </div>
            <!-- Field wrapper end -->

        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

            <!-- Field wrapper start -->
            <div class="field-wrapper">
                <div class="input-group">
                    <input class="form-control" type="number" min="0" id="m6" name="m6" value="<?php echo $default['m6'] ?>" onfocus="Init(this)" onblur="Reset(this)" onchange="Compute('m1')" required>
                    <span class="input-group-text">
                        ฿
                    </span>
                </div>
                <div class="field-placeholder">มี.ค.<?php echo substr($periodid, 2); ?></div>
            </div>
            <!-- Field wrapper end -->

        </div>
        <div class="field-wrapper">
            <div class="field-placeholder"><u>ไตรมาสที่ 3</u></div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

            <!-- Field wrapper start -->
            <div class="field-wrapper">
                <div class="input-group">
                    <input class="form-control" type="number" min="0" id="m7" name="m7" value="<?php echo $default['m7'] ?>" onfocus="Init(this)" onblur="Reset(this)" onchange="Compute('m1')" required>
                    <span class="input-group-text">
                        ฿
                    </span>
                </div>
                <div class="field-placeholder">เม.ย.<?php echo substr($periodid, 2); ?></div>
            </div>
            <!-- Field wrapper end -->

        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

            <!-- Field wrapper start -->
            <div class="field-wrapper">
                <div class="input-group">
                    <input class="form-control" type="number" min="0" id="m8" name="m8" value="<?php echo $default['m8'] ?>" onfocus="Init(this)" onblur="Reset(this)" onchange="Compute('m1')" required>
                    <span class="input-group-text">
                        ฿
                    </span>
                </div>
                <div class="field-placeholder">พ.ค.<?php echo substr($periodid, 2); ?></div>
            </div>
            <!-- Field wrapper end -->

        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

            <!-- Field wrapper start -->
            <div class="field-wrapper">
                <div class="input-group">
                    <input class="form-control" type="number" min="0" id="m9" name="m9" value="<?php echo $default['m9'] ?>" onfocus="Init(this)" onblur="Reset(this)" onchange="Compute('m1')" required>
                    <span class="input-group-text">
                        ฿
                    </span>
                </div>
                <div class="field-placeholder">มิ.ย.<?php echo substr($periodid, 2); ?></div>
            </div>
            <!-- Field wrapper end -->

        </div>
        <div class="field-wrapper">
            <div class="field-placeholder"><u>ไตรมาสที่ 4</u></div>
        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

            <!-- Field wrapper start -->
            <div class="field-wrapper">
                <div class="input-group">
                    <input class="form-control" type="number" min="0" id="m10" name="m10" value="<?php echo $default['m10'] ?>" onfocus="Init(this)" onblur="Reset(this)" onchange="Compute('m1')" required>
                    <span class="input-group-text">
                        ฿
                    </span>
                </div>
                <div class="field-placeholder">ก.ค.<?php echo substr($periodid, 2); ?></div>
            </div>
            <!-- Field wrapper end -->

        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

            <!-- Field wrapper start -->
            <div class="field-wrapper">
                <div class="input-group">
                    <input class="form-control" type="number" min="0" id="m11" name="m11" value="<?php echo $default['m11'] ?>" onfocus="Init(this)" onblur="Reset(this)" onchange="Compute('m1')" required>
                    <span class="input-group-text">
                        ฿
                    </span>
                </div>
                <div class="field-placeholder">ส.ค.<?php echo substr($periodid, 2); ?></div>
            </div>
            <!-- Field wrapper end -->

        </div>
        <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

            <!-- Field wrapper start -->
            <div class="field-wrapper">
                <div class="input-group">
                    <input class="form-control" type="number" min="0" id="m12" name="m12" value="<?php echo $default['m12'] ?>" onfocus="Init(this)" onblur="Reset(this)" onchange="Compute('m1')" required>
                    <span class="input-group-text">
                        ฿
                    </span>
                </div>
                <div class="field-placeholder">ก.ย.<?php echo substr($periodid, 2); ?></div>
            </div>
            <!-- Field wrapper end -->

        </div>
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="form-section-header" style="font-size:2em;text-align:right;">
                ยอดรวม <span id="totalSPAN"><?php echo number_format($default['m1'] + $default['m2'] + $default['m3'] + $default['m4'] + $default['m5'] + $default['m6'] + $default['m7'] + $default['m8'] + $default['m9'] + $default['m10'] + $default['m11'] + $default['m12']) ?></span> บาท
            </div>
        </div>



        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <button class="btn btn-primary" type="submit">บันทึกการแก้ไขรายการ</button>
        </div>
    </div>
    <!-- Row end -->
</form>