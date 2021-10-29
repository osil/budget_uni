<?php
session_start();
include "./authen/check_authen.php";
include "./config/global.php";
include "./config/database.php";


$target_id = $_POST['target_id'];

$sql = "SELECT * FROM
`strategic` AS s
WHERE
s.target_id = :target_id";

$params = array(
    'target_id' => $target_id
);
$result = $con->prepare($sql);
$res = $result->execute($params);
$row = $result->rowCount();

?>




<option value="">เลือกกลยุทธ</option>
<?php while ($data = $result->fetch()) {
?>
    <option value="<?php echo $data['id'] ?>"><?php echo $data['code'] . " " . $data['name'] ?></option>
<?php } ?>