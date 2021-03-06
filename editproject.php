<?php
session_start();
include "./authen/check_authen.php";
include "./config/global.php";
include "./config/database.php";

$projectid = $_GET['id'];
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

                            <div class="card">
                                <div class="card-body">

                                    <!-- Faq start -->
                                    <div class="accordion" id="faqAccordion">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                    ??????????????????????????????????????????????????????????????????????????????????????????? <span class="badge bg-secondary">????????????</span>
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#faqAccordion">
                                                <div class="accordion-body">

                                                    <div class="table-responsive">
                                                        <table class="table table-hover table-bordered m-0">
                                                            <thead>
                                                                <tr>
                                                                    <th>???????????????????????????</th>
                                                                    <th>??????????????????</th>
                                                                    <th>???????????????</th>
                                                                    <th>????????????????????????</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <?php

                                                                $sql = "SELECT * FROM v_budget_check b 
                                                                WHERE b.periodid = :periodid AND b.master_id = :master_id";

                                                                $params = array(
                                                                    'periodid' => $_SESSION["sess-bgu-periodid"],
                                                                    'master_id' => $_SESSION["sess-bgu-departmentid"]
                                                                );
                                                                $result = $con->prepare($sql);
                                                                $res = $result->execute($params);
                                                                $row = $result->rowCount();
                                                                while ($data = $result->fetch()) {
                                                                ?>
                                                                    <tr>
                                                                        <td><?php echo $data['budgetgroup_name'] ?></td>
                                                                        <td><?php echo number_format($data['budget_total']) ?></td>
                                                                        <td><?php echo number_format($data['request_total']) ?></td>
                                                                        <td><?php echo number_format($data['budget_remain']) ?></td>
                                                                    </tr>
                                                                <?php } ?>

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- Faq end -->

                                </div>
                            </div>

                            <!-- Card start -->
                            <div class="card">
                                <div class="card-body" id="card-form">

                                    <!-- Row start -->
                                    <form class="needs-validation" action="script-updateproject.php" method="post">
                                        <div class="row gutters">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                                                <div class="alert alert-secondary" role="alert">
                                                    ??????????????????????????????????????????????????? <?php echo $default['projectname'] ?>
                                                </div>

                                            </div>

                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                                                <div class="form-section-header">?????????????????????????????????????????????</div>
                                            </div>

                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <select class="select-single js-states form-select required" data-live-search="true" id="phase_id" name="phase_id" onchange="_getStrategy(this.value)" required>
                                                        <option value="">??????????????????????????????????????????????????????</option>
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
                                                    <div class="field-placeholder">??????????????????????????????????????????????????????</div>
                                                    <div class="invalid-feedback">
                                                        * ??????????????????????????????
                                                    </div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>

                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <select class="select-single js-states form-select required" data-live-search="true" id="strategy_id" name="strategy_id" onchange="_getTarget(this.value)" required>
                                                        <option value="">?????????????????????????????????????????????</option>
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
                                                    <div class="field-placeholder">?????????????????????????????????????????????</div>
                                                    <div class="invalid-feedback">
                                                        * ??????????????????????????????
                                                    </div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>

                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <select class="select-single js-states form-select required" data-live-search="true" id="target_id" name="target_id" onchange="_getStrategic(this.value)" required>
                                                        <option value="">???????????????????????????????????????</option>
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
                                                    <div class="field-placeholder">???????????????????????????????????????</div>
                                                    <div class="invalid-feedback">
                                                        * ??????????????????????????????
                                                    </div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>

                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <select class="select-single js-states form-select required" data-live-search="true" id="strategic_id" name="strategic_id" onchange="_getIndicator(this.value)" required>
                                                        <option value="">?????????????????????????????????</option>
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
                                                    <div class="field-placeholder">?????????????????????????????????</div>
                                                    <div class="invalid-feedback">
                                                        * ??????????????????????????????
                                                    </div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>

                                            <div class="col-xl-8 col-lg-8 col-md-8 col-sm-8 col-12">
                                                <div class="field-wrapper">
                                                    <select class="select-multiple js-states" title="Select Product Category" multiple="multiple" id="indicator_id" name="indicator_id[]">
                                                        <option>??????????????????????????????????????????</option>
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
                                                    <div class="field-placeholder">??????????????????????????????????????????</div>
                                                    <div class="invalid-feedback">
                                                        * ??????????????????????????????
                                                    </div>
                                                </div>
                                            </div>




                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                                                <div class="form-section-header">??????????????????????????????????????????????????????????????????????????????????????????</div>
                                            </div>

                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                                <input type="hidden" name="projectid" id="projectid" value="<?php echo $default['projectid'] ?>" />
                                                <input type="hidden" name="periodid" id="periodid" value="<?php echo $default['periodid'] ?>" />
                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <select class="select-single js-states form-select required" data-live-search="true" id="budgetgroup_id" name="budgetgroup_id" onchange="_budgetgroup()" required>
                                                        <option value="">????????????????????????????????????????????????????????????</option>
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
                                                    <div class="field-placeholder">????????????????????????????????????????????????????????????</div>
                                                    <div class="invalid-feedback">
                                                        * ??????????????????????????????
                                                    </div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <select class="select-single js-states form-select required" data-live-search="true" id="planid" name="planid" onchange="_getProduct(this.value)" required>
                                                        <option value="">??????????????????????????????????????????</option>
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
                                                    <div class="field-placeholder">???????????????????????????</div>
                                                    <div class="invalid-feedback">
                                                        * ??????????????????????????????
                                                    </div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">

                                                    <select class="select-single js-states required" data-live-search="true" id="productid" name="productid" required>
                                                        <option value="">???????????????????????????????????????????????????</option>

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
                                                    <div class="field-placeholder">???????????????????????????????????????????????????</div>
                                                    <div class="invalid-feedback">
                                                        * ??????????????????????????????
                                                    </div>


                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <select class="select-single js-states form-select required" data-live-search="true" id="departmentid" name="departmentid" required>
                                                        <option value="">???????????????????????????</option>
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
                                                    <div class="field-placeholder">???????????????????????????</div>
                                                    <div class="invalid-feedback">
                                                        * ??????????????????????????????
                                                    </div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <select class="select-single js-states form-select required" data-live-search="true" id="budgettype_id" name="budgettype_id" onchange="_getBudgetSubType(this.value)" required>
                                                        <option value="">???????????????????????????????????????</option>
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
                                                    <div class="field-placeholder">???????????????????????????????????????</div>
                                                    <div class="invalid-feedback">
                                                        * ??????????????????????????????
                                                    </div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">

                                                    <select class="select-single js-states required" data-live-search="true" id="budgettype_sub_id" name="budgettype_sub_id" required>
                                                        <option value="">???????????????????????????????????????????????????</option>

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
                                                    <div class="field-placeholder">???????????????????????????????????????????????????</div>
                                                    <div class="invalid-feedback">
                                                        * ??????????????????????????????
                                                    </div>


                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>

                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                                                <div class="form-section-header">??????????????????????????????????????? <span class="title-info"></span></div>
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
                                                    <div class="field-placeholder">?????????????????????????????????</div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>



                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                                                <div class="form-section-header">?????????????????????????????????????????????????????????????????????????????????????????? ????????????????????????????????????????????? <?php echo $periodid; ?></div>
                                            </div>
                                            <div class="field-wrapper">
                                                <div class="field-placeholder"><u>??????????????????????????? 1</u></div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <div class="input-group">
                                                        <input class="form-control" type="number" min="0" id="m1" name="m1" value="<?php echo $default['m1'] ?>" onfocus="Init(this)" onblur="Reset(this)" onchange="Compute('m1')" required>
                                                        <span class="input-group-text">
                                                            ???
                                                        </span>
                                                    </div>
                                                    <div class="field-placeholder">???.???.<?php echo (substr($periodid, 2) - 1); ?></div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <div class="input-group">
                                                        <input class="form-control" type="number" min="0" id="m2" name="m2" value="<?php echo $default['m2'] ?>" onfocus="Init(this)" onblur="Reset(this)" onchange="Compute('m1')" required>
                                                        <span class="input-group-text">
                                                            ???
                                                        </span>
                                                    </div>
                                                    <div class="field-placeholder">???.???.<?php echo (substr($periodid, 2) - 1); ?></div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <div class="input-group">
                                                        <input class="form-control" type="number" min="0" id="m3" name="m3" value="<?php echo $default['m3'] ?>" onfocus="Init(this)" onblur="Reset(this)" onchange="Compute('m1')" required>
                                                        <span class="input-group-text">
                                                            ???
                                                        </span>
                                                    </div>
                                                    <div class="field-placeholder">???.???.<?php echo (substr($periodid, 2) - 1); ?></div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>
                                            <div class="field-wrapper">
                                                <div class="field-placeholder"><u>??????????????????????????? 2</u></div>
                                            </div>

                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <div class="input-group">
                                                        <input class="form-control" type="number" min="0" id="m4" name="m4" value="<?php echo $default['m4'] ?>" onfocus="Init(this)" onblur="Reset(this)" onchange="Compute('m1')" required>
                                                        <span class="input-group-text">
                                                            ???
                                                        </span>
                                                    </div>
                                                    <div class="field-placeholder">???.???.<?php echo substr($periodid, 2); ?></div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>

                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <div class="input-group">
                                                        <input class="form-control" type="number" min="0" id="m5" name="m5" value="<?php echo $default['m5'] ?>" onfocus="Init(this)" onblur="Reset(this)" onchange="Compute('m1')" required>
                                                        <span class="input-group-text">
                                                            ???
                                                        </span>
                                                    </div>
                                                    <div class="field-placeholder">???.???.<?php echo substr($periodid, 2); ?></div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <div class="input-group">
                                                        <input class="form-control" type="number" min="0" id="m6" name="m6" value="<?php echo $default['m6'] ?>" onfocus="Init(this)" onblur="Reset(this)" onchange="Compute('m1')" required>
                                                        <span class="input-group-text">
                                                            ???
                                                        </span>
                                                    </div>
                                                    <div class="field-placeholder">??????.???.<?php echo substr($periodid, 2); ?></div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>
                                            <div class="field-wrapper">
                                                <div class="field-placeholder"><u>??????????????????????????? 3</u></div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <div class="input-group">
                                                        <input class="form-control" type="number" min="0" id="m7" name="m7" value="<?php echo $default['m7'] ?>" onfocus="Init(this)" onblur="Reset(this)" onchange="Compute('m1')" required>
                                                        <span class="input-group-text">
                                                            ???
                                                        </span>
                                                    </div>
                                                    <div class="field-placeholder">??????.???.<?php echo substr($periodid, 2); ?></div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <div class="input-group">
                                                        <input class="form-control" type="number" min="0" id="m8" name="m8" value="<?php echo $default['m8'] ?>" onfocus="Init(this)" onblur="Reset(this)" onchange="Compute('m1')" required>
                                                        <span class="input-group-text">
                                                            ???
                                                        </span>
                                                    </div>
                                                    <div class="field-placeholder">???.???.<?php echo substr($periodid, 2); ?></div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <div class="input-group">
                                                        <input class="form-control" type="number" min="0" id="m9" name="m9" value="<?php echo $default['m9'] ?>" onfocus="Init(this)" onblur="Reset(this)" onchange="Compute('m1')" required>
                                                        <span class="input-group-text">
                                                            ???
                                                        </span>
                                                    </div>
                                                    <div class="field-placeholder">??????.???.<?php echo substr($periodid, 2); ?></div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>
                                            <div class="field-wrapper">
                                                <div class="field-placeholder"><u>??????????????????????????? 4</u></div>
                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <div class="input-group">
                                                        <input class="form-control" type="number" min="0" id="m10" name="m10" value="<?php echo $default['m10'] ?>" onfocus="Init(this)" onblur="Reset(this)" onchange="Compute('m1')" required>
                                                        <span class="input-group-text">
                                                            ???
                                                        </span>
                                                    </div>
                                                    <div class="field-placeholder">???.???.<?php echo substr($periodid, 2); ?></div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <div class="input-group">
                                                        <input class="form-control" type="number" min="0" id="m11" name="m11" value="<?php echo $default['m11'] ?>" onfocus="Init(this)" onblur="Reset(this)" onchange="Compute('m1')" required>
                                                        <span class="input-group-text">
                                                            ???
                                                        </span>
                                                    </div>
                                                    <div class="field-placeholder">???.???.<?php echo substr($periodid, 2); ?></div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>
                                            <div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 col-12">

                                                <!-- Field wrapper start -->
                                                <div class="field-wrapper">
                                                    <div class="input-group">
                                                        <input class="form-control" type="number" min="0" id="m12" name="m12" value="<?php echo $default['m12'] ?>" onfocus="Init(this)" onblur="Reset(this)" onchange="Compute('m1')" required>
                                                        <span class="input-group-text">
                                                            ???
                                                        </span>
                                                    </div>
                                                    <div class="field-placeholder">???.???.<?php echo substr($periodid, 2); ?></div>
                                                </div>
                                                <!-- Field wrapper end -->

                                            </div>
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="form-section-header" style="font-size:2em;text-align:right;">
                                                    ?????????????????? <span id="totalSPAN"><?php echo number_format($default['m1'] + $default['m2'] + $default['m3'] + $default['m4'] + $default['m5'] + $default['m6'] + $default['m7'] + $default['m8'] + $default['m9'] + $default['m10'] + $default['m11'] + $default['m12']) ?></span> ?????????
                                                </div>
                                            </div>



                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <button class="btn btn-primary" type="submit">????????????????????????????????????????????????????????????</button>
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

                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                            <!-- Card start -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-4 col-12">
                                        <div class="alert alert-primary" role="alert">
                                            ?????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????
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

                        }

                        form.classList.add('was-validated')

                    }, false)

                })


        })()

        function _getStrategy(phase_id) {
            //??????????????????????????????????????????????????????
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
            //???????????????????????????????????????????????????????????? table target
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
            //???????????????????????????????????????????????????????????? table Strategic
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
            //???????????????????????????????????????????????????????????? table Indicator

            $("#indicator_id").val("").change();


            document.getElementById("indicator_id").disabled = false;
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
            //$("#strategyuid").val("").change();
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
            //_getDataByBudgettype();
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
            _getDataByBudgettype();
            $("#planid").val("").change();
            $("#productid").val("").change();
            //$("#strategyuid").val("").change();
            $("#budgettype_id").val("").change();
            $("#budgettype_sub_id").val("").change();
        }

        function _strategyu() {
            $("#budgettype_id").val("").change();
            $("#budgettype_sub_id").val("").change();
        }

        function _getDataByBudgettype() {
            const budgetgroup_id = $("#budgetgroup_id").val();
            // const planid = $("#planid").val();
            // const productid = $("#productid").val();
            // const strategyuid = $("#strategy_id").val();
            // const budgettype_id = $("#budgettype_id").val();
            const departmentid = <?php echo $_SESSION["sess-bgu-departmentid"] ?>;
            const periodid = <?php echo $periodid ?>;
            // console.log("budgetgroup_id : " + budgetgroup_id);
            // console.log("planid : " + planid);
            // console.log("productid : " + productid);
            // console.log("strategyuid : " + strategyuid);
            // console.log("budgettype_id : " + budgettype_id);
            // console.log("departmentid : " + departmentid);
            // console.log("periodid : " + periodid);

            if (budgetgroup_id != "") {

                // _getDetailList(budgetgroup_id, departmentid, periodid);

                $("#detail").show();
                _getDetailTable(budgetgroup_id, departmentid, periodid);


            } else {
                $("#detail").hide();
            }
        }

        // function _getDetailList(budgetgroup_id, departmentid, periodid) {
        //     $.ajax({
        //         type: "POST",
        //         url: "script-getdetaillist-ajax.php",
        //         data: {
        //             budgetgroup_id,
        //             departmentid,
        //             periodid
        //         },
        //         success: function(msg) {
        //             $("#detail_list").html(msg)
        //         }

        //     })
        // }

        function _getDetailTable(budgetgroup_id, departmentid, periodid) {
            $.ajax({
                type: "POST",
                url: "script-getdetailtable-ajax.php",
                data: {
                    budgetgroup_id,
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
                title: '????????????????????????????????????????????????????',
                text: "???????????????????????????????????????????????????????????????????????????????????? !!",
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
            const strategyuid = $("#strategy_id").val();
            const budgettype_id = $("#budgettype_id").val();
            const departmentid = <?php echo $_SESSION["sess-bgu-departmentid"] ?>;
            const periodid = <?php echo $periodid ?>;

            Swal.fire({
                title: '????????????????????????????????????????????????????',
                text: "?????????????????????????????????????????????????????????????????????!",
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
                                    title: '??????????????????????????????????????????????????????',
                                    showConfirmButton: false,
                                    timer: 2500
                                })
                                _getDetailTable(budgetgroup_id, departmentid, periodid);


                            } else {
                                Swal.fire({

                                    icon: 'error',
                                    title: '????????????????????????????????????????????????????????????????????????????????? ' + msg,
                                    showConfirmButton: false,
                                    timer: 2500
                                })
                            }

                        }

                    })

                }
            })



        }

        function _checkBudget(periodid, budgettype_id, departmentid, m_sum) {

            $.ajax({
                type: "POST",
                url: "script-checkbudget-ajax.php",
                data: {
                    projectid,
                    budgettype_id,
                    departmentid,
                    m_sum
                },
                success: function(msg) {

                    if (msg === 'ok') {
                        return 1;
                    } else {
                        return 0;
                    }
                }

            })
        }

        function Init(obj) {
            var v = obj.value;
            if (v == 0) {
                obj.value = '';
            }

        }

        function Reset(obj) {
            var v = obj.value;
            if (v == '') {
                obj.value = 0;
            }
        }

        function Compute(name) {

            var v = $("#" + name).val();
            let m = v % 10;
            let a = v - m;
            if (m > 0) {
                $("#" + name).val(a);
            }

            const m1 = ($("#m1").val() * 1);
            const m2 = ($("#m2").val() * 1);
            const m3 = ($("#m3").val() * 1);
            const m4 = ($("#m4").val() * 1);
            const m5 = ($("#m5").val() * 1);
            const m6 = ($("#m6").val() * 1);
            const m7 = ($("#m7").val() * 1);
            const m8 = ($("#m8").val() * 1);
            const m9 = ($("#m9").val() * 1);
            const m10 = ($("#m10").val() * 1);
            const m11 = ($("#m11").val() * 1);
            const m12 = ($("#m12").val() * 1);

            let m_sum = (m1 + m2 + m3 + m4 + m5 + m6 + m7 + m8 + m9 + m10 + m11 + m12)

            let str = m_sum.toLocaleString("en-US");

            $("#totalSPAN").html(str);


        }
    </script>


</body>

</html>