<?php
session_start();
include "./authen/check_authen.php";
include "./config/global.php";
include "./config/database.php";


$PLANID = $_POST['planid'];

$sql = "SELECT
s.PRODUCTID,
s.PRODUCTNAME,
s.PLANID
FROM
product AS s
WHERE
s.PLANID = :PLANID";

$params = array(
    'PLANID' => $PLANID
);
$result = $con->prepare($sql);
$res = $result->execute($params);
$row = $result->rowCount();

?>




<option value="">เลือกประเภทโครงการ</option>
<?php while ($data = $result->fetch()) {
?>
    <option value="<?php echo $data['PRODUCTID'] ?>"><?php echo $data['PRODUCTNAME'] ?></option>
<?php } ?>