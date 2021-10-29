<?php


session_start();
include "./authen/check_authen.php";
include "./config/global.php";
include "./config/database.php";

$projectid = $_POST['projectid'];
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
UPDATE
  `project`
SET
`budgetgroup_id` = :budgetgroup_id,
`strategyuid` = :strategyuid,
`planid` = :planid,
`productid` = :productid,
`budgettype_id` = :budgettype_id,
`budgettype_sub_id` = :budgettype_sub_id,
`projectname` = :projectname,
`m1` = :m1,
`m2` = :m2,
`m3` = :m3,
`m4` = :m4,
`m5` = :m5,
`m6` = :m6,
`m7` = :m7,
`m8` = :m8,
`m9` = :m9,
`m10` = :m10,
`m11` = :m11,
`m12` = :m12,
`periodid` = :periodid,
`departmentid` = :departmentid
WHERE `projectid` = :projectid
";


$params = array(
    "projectid" => $projectid,
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
    "departmentid" => $departmentid
);
$result = $con->prepare($sql);
$res = $result->execute($params);

//print_r($_POST);

?>

<meta charset="utf-8" />
<script>
    alert("แก้ไขข้อมูลเรียบร้อยแล้ว");
    window.location = 'project_add.php';
</script>