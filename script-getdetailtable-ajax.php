<?php
session_start();
include "./authen/check_authen.php";
include "./config/global.php";
include "./config/database.php";


$budgetgroup_id = $_POST['budgetgroup_id'];
// $planid = $_POST['planid'];
// $productid = $_POST['productid'];
// $strategyuid = $_POST['strategyuid'];
// $budgettype_id = $_POST['budgettype_id'];
$departmentid = $_POST['departmentid'];
$periodid = $_POST['periodid'];

$sql = "SELECT
s.projectid, 
s.budgetgroup_id, 
s.strategyuid, 
s.planid, 
s.productid, 
s.budgettype_id, 
s.budgettype_sub_id, 
s.projectname, 
FORMAT(s.m1,0) as m1,  
FORMAT(s.m2,0) as m2, 
FORMAT(s.m3,0) as m3, 
FORMAT(s.m4,0) as m4, 
FORMAT(s.m5,0) as m5, 
FORMAT(s.m6,0) as m6, 
FORMAT(s.m7,0) as m7, 
FORMAT(s.m8,0) as m8, 
FORMAT(s.m9,0) as m9, 
FORMAT(s.m10,0) as m10, 
FORMAT(s.m11,0) as m11, 
FORMAT(s.m12,0) as m12, 
FORMAT((m1+m2+m3+m4+m5+m6+m7+m8+m9+m10+m11+m12),0) as sum_budget,
b.budgettype_sub_name
FROM
project AS s
INNER JOIN
	budgettype_sub AS b
	ON 
		s.budgettype_sub_id = b.budgettype_sub_id
INNER JOIN v_department AS v ON v.departmentid = s.departmentid
WHERE
s.budgetgroup_id = :budgetgroup_id
AND v.master_id = :departmentid
AND s.periodid = :periodid
";

$params = array(
    'budgetgroup_id' => $budgetgroup_id,
    'departmentid' => $departmentid,
    'periodid' => $periodid
);
$result = $con->prepare($sql);
$res = $result->execute($params);
$row = $result->rowCount();
$i = 1;
?>
<div class="table-responsive">
    <table class="table table-bordered table-striped m-0" style="vertical-align: middle;">
        <thead>
            <tr class="text-center">
                <th width="5%">ลำดับ</th>
                <th>ชื่อโครงการ</th>
                <th width="30%">รายละเอียดงบ</th>
                <th width="15%">จำนวนเงิน</th>
                <th width="10%">ตัวเลือก</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($data = $result->fetch()) { ?>
                <tr>
                    <td class="text-center"><?php echo $i; ?></td>
                    <td><?php echo $data['projectname']; ?></td>
                    <td class="text-center"><?php echo $data['budgettype_sub_name']; ?></td>
                    <td class="text-center"><?php echo $data['sum_budget']; ?></td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-outline-warning" onclick="_editProject(<?php echo $data['projectid']; ?>)">แก้ไข</button>
                        <button type="button" class="btn btn-sm btn-outline-danger" onclick="_delProject(<?php echo $data['projectid']; ?>)">ลบ</button>
                    </td>
                </tr>
            <?php $i++;
            } ?>


    </table>
</div>