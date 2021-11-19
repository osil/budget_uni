<?php
session_start();
include "./authen/check_authen.php";
include "./config/global.php";
include "./config/database.php";


$periodid = $_POST['periodid'];
$budgetgroup_id = $_POST['budgetgroup_id'];
$master_id = $_POST['master_id'];
$m_sum = $_POST['m_sum'];



$sql = "SELECT * FROM v_budget_check b 
WHERE b.periodid = :periodid AND b.master_id = :master_id AND b.budgetgroup_id = :budgetgroup_id";

$params = array(
    'periodid' => $periodid,
    'master_id' => $master_id,
    'budgetgroup_id' => $budgetgroup_id
);
$result = $con->prepare($sql);
$res = $result->execute($params);
$row = $result->rowCount();
$default = $result->fetch();

if ($m_sum <= $default['budget_remain']) {
    echo "ok";
} else {
    echo "nn";
}
