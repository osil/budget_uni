<?php
session_start();
include "./authen/check_authen.php";
include "./config/global.php";
include "./config/database.php";


$budgetgroup_id = $_POST['budgetgroup_id'];
$planid = $_POST['planid'];
$productid = $_POST['productid'];
$strategyuid = $_POST['strategyuid'];
$budgettype_id = $_POST['budgettype_id'];
$departmentid = $_POST['departmentid'];
$periodid = $_POST['periodid'];

$sql = "SELECT * FROM
budgetgroup AS s
WHERE
s.budgetgroup_id = :budgetgroup_id";

$params = array(
    'budgetgroup_id' => $budgetgroup_id
);
$result = $con->prepare($sql);
$res = $result->execute($params);
$row = $result->rowCount();
$d_budgetgroup = $result->fetch();


$sql2 = "SELECT * FROM
plan AS s
WHERE
s.PLANID = :planid";

$params = array(
    'planid' => $planid
);
$result = $con->prepare($sql2);
$res = $result->execute($params);
$row = $result->rowCount();
$d_plan = $result->fetch();

$sql3 = "SELECT * FROM
product AS s
WHERE
s.PRODUCTID = :productid";

$params = array(
    'productid' => $productid
);
$result = $con->prepare($sql3);
$res = $result->execute($params);
$row = $result->rowCount();
$d_product = $result->fetch();


$sql4 = "SELECT * FROM
strategyu AS s
WHERE
s.STRATEGYUID = :strategyuid";

$params = array(
    'strategyuid' => $strategyuid
);
$result = $con->prepare($sql4);
$res = $result->execute($params);
$row = $result->rowCount();
$d_strategyu = $result->fetch();

$sql5 = "SELECT * FROM
budgettype AS s
WHERE
s.budgettype_id = :budgettype_id";

$params = array(
    'budgettype_id' => $budgettype_id
);
$result = $con->prepare($sql5);
$res = $result->execute($params);
$row = $result->rowCount();
$d_budgettype = $result->fetch();

?>



<!-- Card start -->
<div class="card">
    <div class="card-body">

        <ul class="list-group m-0">
            <li class="list-group-item active">รายละเอียด</li>
            <li class="list-group-item"><b>งบประมาณ : </b> <?php echo $d_budgetgroup['budgetgroup_code'] . " " . $d_budgetgroup['budgetgroup_name'] ?></li>
            <li class="list-group-item"><b>แผน : </b> <?php echo $d_plan['PLANNAME'] ?></li>
            <li class="list-group-item"><b>โครงการ : </b> <?php echo $d_product['PRODUCTNAME'] ?></li>
            <li class="list-group-item"><b>ยุทธศาสตร์ : </b> <?php echo $d_strategyu['STRATEGYUNAME'] ?></li>
            <li class="list-group-item"><b>งบ : </b> <?php echo $d_budgettype['budgettype_name'] ?></li>
        </ul>
    </div>
</div>
<!-- Card end -->