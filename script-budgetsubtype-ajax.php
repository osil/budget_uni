<?php
session_start();
include "./authen/check_authen.php";
include "./config/global.php";
include "./config/database.php";


$budgettype_id = $_POST['budgettype_id'];

$sql = "SELECT * FROM
budgettype_sub AS s
WHERE
s.budgettype_id = :budgettype_id";

$params = array(
    'budgettype_id' => $budgettype_id
);
$result = $con->prepare($sql);
$res = $result->execute($params);
$row = $result->rowCount();

?>




<option value="">เลือกรายละเอียดงบ</option>
<?php while ($data = $result->fetch()) {
?>
    <option value="<?php echo $data['budgettype_sub_id'] ?>"><?php echo $data['budgettype_sub_name'] ?></option>
<?php } ?>