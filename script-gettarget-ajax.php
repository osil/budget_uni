<?php
session_start();
include "./authen/check_authen.php";
include "./config/global.php";
include "./config/database.php";


$strategy_id = $_POST['strategy_id'];

$sql = "SELECT * FROM
`target` AS s
WHERE
s.strategy_id = :strategy_id";

$params = array(
    'strategy_id' => $strategy_id
);
$result = $con->prepare($sql);
$res = $result->execute($params);
$row = $result->rowCount();

?>




<option value="">เลือกเป้าหมาย</option>
<?php while ($data = $result->fetch()) {
?>
    <option value="<?php echo $data['id'] ?>"><?php echo $data['code'] . " " . $data['name'] ?></option>
<?php } ?>