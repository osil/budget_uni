<?php
session_start();
include "./authen/check_authen.php";
include "./config/global.php";
include "./config/database.php";


$phase_id = $_POST['phase_id'];

$sql = "SELECT * FROM
strategy AS s
WHERE
s.phase_id = :phase_id";

$params = array(
    'phase_id' => $phase_id
);
$result = $con->prepare($sql);
$res = $result->execute($params);
$row = $result->rowCount();

?>




<option value="">เลือกยุทธศาสตร์</option>
<?php while ($data = $result->fetch()) {
?>
    <option value="<?php echo $data['id'] ?>"><?php echo $data['name'] ?></option>
<?php } ?>