<?php
session_start();
include "./authen/check_authen.php";
include "./config/global.php";
include "./config/database.php";


$strategic_id = $_POST['strategic_id'];

$sql = "SELECT * FROM
`indicator` AS s
WHERE
s.strategic_id = :strategic_id";

$params = array(
    'strategic_id' => $strategic_id
);
$result = $con->prepare($sql);
$res = $result->execute($params);
$row = $result->rowCount();

?>




<option value="">เลือกตัวชี้วัด</option>
<?php while ($data = $result->fetch()) {
?>
    <option value="<?php echo $data['id'] ?>"><?php echo $data['code'] . " " . $data['name'] ?></option>
<?php } ?>