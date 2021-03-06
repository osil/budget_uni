<?php


session_start();
include "./authen/check_authen.php";
include "./config/global.php";
try {
  include "./config/database.php";

  $projectid = $_POST['projectid'];
  $budgetgroup_id = $_POST['budgetgroup_id'];
  $planid = $_POST['planid'];
  $productid = $_POST['productid'];
  $strategyuid = $_POST['strategy_id'];
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
  $phase_id = $_POST['phase_id'];
  $strategy_id = $_POST['strategy_id'];
  $target_id = $_POST['target_id'];
  $strategic_id = $_POST['strategic_id'];
  $indicator_id = $_POST['indicator_id'];

  // ประกาศการเริ่มต้น Transaction
  $con->beginTransaction();


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
`departmentid` = :departmentid,
`phase_id` = :phase_id,
`strategy_id` = :strategy_id,
`target_id` = :target_id,
`strategic_id` = :strategic_id
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
    "departmentid" => $departmentid,
    "phase_id" => $phase_id,
    "strategy_id" => $strategy_id,
    "target_id" => $target_id,
    "strategic_id" => $strategic_id
  );
  $result = $con->prepare($sql);
  $res = $result->execute($params);

  // delete project_indicator
  $sql = "
  DELETE FROM `project_indicator` WHERE `project_id` = :project_id
  ";
  $params = array(
    "project_id" => $projectid
  );
  $result = $con->prepare($sql);
  $res = $result->execute($params);

  // insert project_indicator new

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
      "project_id" => $projectid,
      "indicator_id" => $a
    );
    $result = $con->prepare($sql);
    $res = $result->execute($params);
  }


  // ถ้าทุกอย่างไม่ผิดพลาด ก็ยืนยันการบันทึกข้อมูล
  $con->commit();

  //print_r($_POST);
} catch (PDOException $ex) {
  // ถ้ามีบางอย่างผิดพลาด ก็ให้ rollback ทั้งหมดไม่บันทึก
  $con->rollBack();
  die($ex->getMessage());
}

?>

<meta charset="utf-8" />
<script>
  alert("แก้ไขข้อมูลเรียบร้อยแล้ว");
  window.location = 'index.php';
</script>