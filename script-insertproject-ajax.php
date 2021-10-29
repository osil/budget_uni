<?php

session_start();
include "./authen/check_authen.php";
include "./config/global.php";
include "./config/database.php";

$phase_id = $_POST['phase_id'];
$strategy_id = $_POST['strategy_id'];
$target_id = $_POST['target_id'];
$strategic_id = $_POST['strategic_id'];
$indicator_id = $_POST['indicator_id'];
$budgetgroup_id = $_POST['budgetgroup_id'];
$planid = $_POST['planid'];
$productid = $_POST['productid'];
$strategyuid = $_POST['strategyuid'];
$budgettype_id = $_POST['budgettype_id'];
$budgettype_sub_id = $_POST['budgettype_sub_id'];
$departmentid = $_POST['departmentid'];
$periodid = $_POST['periodid'];
$projectname = $_POST['projectname'];
$m1 = $_POST['m1'];
$m2 = $_POST['m2'];
$m3 = $_POST['m3'];
$m4 = $_POST['m4'];
$m5 = $_POST['m5'];
$m6 = $_POST['m6'];
$m7 = $_POST['m7'];
$m8 = $_POST['m8'];
$m9 = $_POST['m9'];
$m10 = $_POST['m10'];
$m11 = $_POST['m11'];
$m12 = $_POST['m12'];

$sql = "
INSERT INTO `project` (
  `budgetgroup_id`,
  `strategyuid`,
  `planid`,
  `productid`,
  `budgettype_id`,
  `budgettype_sub_id`,
  `projectname`,
  `m1`,
  `m2`,
  `m3`,
  `m4`,
  `m5`,
  `m6`,
  `m7`,
  `m8`,
  `m9`,
  `m10`,
  `m11`,
  `m12`,
  `periodid`,
  `departmentid`,
  `phase_id`,
  `strategy_id`,
  `target_id`,
  `strategic_id`
)
VALUES
  (
    :budgetgroup_id,
    :strategyuid,
    :planid,
    :productid,
    :budgettype_id,
    :budgettype_sub_id,
    :projectname,
    :m1,
    :m2,
    :m3,
    :m4,
    :m5,
    :m6,
    :m7,
    :m8,
    :m9,
    :m10,
    :m11,
    :m12,
    :periodid,
    :departmentid,
    :phase_id,
    :strategy_id,
    :target_id,
    :strategic_id
  );

";
$params = array(
  "budgetgroup_id" => $budgetgroup_id,
  "strategyuid" => $strategyuid,
  "planid" => $planid,
  "productid" => $productid,
  "budgettype_id" => $budgettype_id,
  "budgettype_sub_id" => $budgettype_sub_id,
  "projectname" => $projectname,
  "m1" => $m1,
  "m2" => $m2,
  "m3" => $m3,
  "m4" => $m4,
  "m5" => $m5,
  "m6" => $m6,
  "m7" => $m7,
  "m8" => $m8,
  "m9" => $m9,
  "m10" => $m10,
  "m11" => $m11,
  "m12" => $m12,
  "periodid" => $periodid,
  "departmentid" => $departmentid,
  "phase_id" => $phase_id,
  "strategy_id" => $strategy_id,
  "target_id" => $target_id,
  "strategic_id" => $strategic_id
);
$result = $con->prepare($sql);
$res = $result->execute($params);

//check last id


$sql = "SELECT projectid FROM project ORDER BY projectid DESC LIMIT 1";

$params = array();
$result = $con->prepare($sql);
$res = $result->execute($params);
$default = $result->fetch();

// loop insert project_indicator


foreach ($indicator_id as $a) {

  $sql = "
INSERT INTO `project_indicator` (
  `project_id`,
  `indicator_id`
)
VALUES
  (
    :project_id,
    :indicator_id
  );

";
  $params = array(
    "project_id" => $default['projectid'],
    "indicator_id" => $a
  );
  $result = $con->prepare($sql);
  $res = $result->execute($params);
}



echo "ok";
