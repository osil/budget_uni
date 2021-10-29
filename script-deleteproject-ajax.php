<?php
session_start();
include "./authen/check_authen.php";
include "./config/global.php";
include "./config/database.php";


$projectid = $_POST['projectid'];

$sql = "
DELETE FROM `project` WHERE `projectid` = :projectid
";
$params = array(
    "projectid" => $projectid,
);
$result = $con->prepare($sql);
$res = $result->execute($params);

echo 'ok';
