<?php
session_start();
include "./authen/check_authen.php";
include "./config/global.php";
include "./config/database.php";

$department_id = $_POST['department_id'];
$budgetgroup_id = $_POST['budgetgroup_id'];
$periodid = $_SESSION["sess-bgu-periodid"];

?>
<div class="table-responsive" style="overflow-x:auto; max-height: 400px; overflow: auto;">
    <table class="table table-bordered m-0" style="width: 100%; ">
        <thead>
            <tr class="text-center" style="vertical-align: middle;">
                <th rowspan="2">#</th>
                <th rowspan="2">แผนงาน / ผลผลิต</th>
                <th>งบบุคลากร</th>
                <th colspan="4">งบดำเนินงาน</th>
                <th colspan="2">งบลงทุน</th>
                <th rowspan="2">งบเงินอุดหนุน</th>
                <th rowspan="2">งบรายจ่ายอื่นๆ</th>
                <th rowspan="2">รวมทั้งสิ้น</th>
                <th rowspan="2">Option</th>
            </tr>
            <tr class="text-center" style="vertical-align: middle;">

                <th>ค่าจ้างชั่วคราว</th>
                <th>ค่าตอบแทน</th>
                <th>ค่าใช้สอย</th>
                <th>ค่าวัสดุ</th>
                <th>ค่าสาธารณูปโภค</th>
                <th>ค่าครุภัณฑ์</th>
                <th>ค่าที่ดินและ<br>สิ่งปลูกสร้าง</th>
            </tr>
        </thead>
        <tbody>
            <?php

            $sql = "SELECT * FROM v_summary_dept where department_id = :department_id AND periodid = :periodid AND budgetgroup_id = :budgetgroup_id";

            $params = array(
                'department_id' => $department_id,
                'periodid' => $periodid,
                'budgetgroup_id' => $budgetgroup_id
            );
            $result = $con->prepare($sql);
            $res = $result->execute($params);
            $row = $result->rowCount();
            while ($data = $result->fetch()) {
            ?>
                <tr class="text-center" style="color:black; vertical-align: middle; font-weight: bold; background-color:#979A9A;">
                    <td>&nbsp;</td>
                    <td>รวมทั้งสิ้น</td>
                    <td><?php echo number_format($data['v1']) ?></td>
                    <td><?php echo number_format($data['v2']) ?></td>
                    <td><?php echo number_format($data['v3']) ?></td>
                    <td><?php echo number_format($data['v4']) ?></td>
                    <td><?php echo number_format($data['v5']) ?></td>
                    <td><?php echo number_format($data['v6']) ?></td>
                    <td><?php echo number_format($data['v7']) ?></td>
                    <td><?php echo number_format($data['v8']) ?></td>
                    <td><?php echo number_format($data['v9']) ?></td>
                    <td><?php echo number_format($data['total']) ?></td>
                    <td>&nbsp;</td>
                </tr>



            <?php } ?>
            <!-- end loop v_summary_dept   -->

            <!-- start loop v_summary_plan -->

            <?php

            $plan_number = 1;
            $sql2 = "SELECT * FROM v_summary_plan where department_id = :department_id AND periodid = :periodid AND budgetgroup_id = :budgetgroup_id";

            $params2 = array(
                'department_id' => $department_id,
                'periodid' => $periodid,
                'budgetgroup_id' => $budgetgroup_id
            );
            $result2 = $con->prepare($sql2);
            $res2 = $result2->execute($params2);
            $row2 = $result2->rowCount();
            while ($data2 = $result2->fetch()) {
            ?>
                <tr style="color:black; vertical-align: middle; font-weight: bold; background-color:#B3B6B7;">
                    <td class="text-center"><?php echo $plan_number; ?></td>
                    <td><?php echo $data2['plan_name'] ?></td>
                    <td class="text-center"><?php echo number_format($data2['v1']) ?></td>
                    <td class="text-center"><?php echo number_format($data2['v2']) ?></td>
                    <td class="text-center"><?php echo number_format($data2['v3']) ?></td>
                    <td class="text-center"><?php echo number_format($data2['v4']) ?></td>
                    <td class="text-center"><?php echo number_format($data2['v5']) ?></td>
                    <td class="text-center"><?php echo number_format($data2['v6']) ?></td>
                    <td class="text-center"><?php echo number_format($data2['v7']) ?></td>
                    <td class="text-center"><?php echo number_format($data2['v8']) ?></td>
                    <td class="text-center"><?php echo number_format($data2['v9']) ?></td>
                    <td class="text-center"><?php echo number_format($data2['total']) ?></td>
                    <td class="text-center">&nbsp;</td>
                </tr>

                <!-- start loop v_summary_product -->
                <?php
                $product_number = 1;
                $sql3 = "SELECT * FROM v_summary_product where department_id = :department_id AND periodid = :periodid AND budgetgroup_id = :budgetgroup_id AND plan_id = :plan_id";

                $params3 = array(
                    'department_id' => $department_id,
                    'periodid' => $periodid,
                    'budgetgroup_id' => $budgetgroup_id,
                    'plan_id' => $data2['plan_id']

                );
                $result3 = $con->prepare($sql3);
                $res3 = $result3->execute($params3);
                $row3 = $result3->rowCount();

                while ($data3 = $result3->fetch()) {
                ?>
                    <tr style="color:black; vertical-align: middle; font-weight: bold; background-color:#D0D3D4;">
                        <td class="text-center"><?php echo $plan_number . "." . $product_number; ?></td>
                        <td><?php echo $data3['product_name'] ?></td>
                        <td class="text-center"><?php echo number_format($data3['v1']) ?></td>
                        <td class="text-center"><?php echo number_format($data3['v2']) ?></td>
                        <td class="text-center"><?php echo number_format($data3['v3']) ?></td>
                        <td class="text-center"><?php echo number_format($data3['v4']) ?></td>
                        <td class="text-center"><?php echo number_format($data3['v5']) ?></td>
                        <td class="text-center"><?php echo number_format($data3['v6']) ?></td>
                        <td class="text-center"><?php echo number_format($data3['v7']) ?></td>
                        <td class="text-center"><?php echo number_format($data3['v8']) ?></td>
                        <td class="text-center"><?php echo number_format($data3['v9']) ?></td>
                        <td class="text-center"><?php echo number_format($data3['total']) ?></td>
                        <td class="text-center">&nbsp;</td>
                    </tr>

                    <!-- start loop v_summary_strategy -->
                    <?php
                    $strategy_number = 1;
                    $sql4 = "SELECT * FROM v_summary_strategy where department_id = :department_id AND periodid = :periodid AND budgetgroup_id = :budgetgroup_id AND plan_id = :plan_id AND product_id = :product_id";

                    $params4 = array(
                        'department_id' => $department_id,
                        'periodid' => $periodid,
                        'budgetgroup_id' => $budgetgroup_id,
                        'plan_id' => $data3['plan_id'],
                        'product_id' => $data3['product_id']

                    );
                    $result4 = $con->prepare($sql4);
                    $res4 = $result4->execute($params4);
                    $row4 = $result4->rowCount();
                    while ($data4 = $result4->fetch()) {
                    ?>
                        <tr style="color:black; vertical-align: middle; font-weight: bold;  background-color:#ECF0F1;">
                            <td class="text-center"><?php echo $plan_number . "." . $product_number . "." . $strategy_number; ?></td>
                            <td><?php echo $data4['strategy_name'] ?></td>
                            <td class="text-center"><?php echo number_format($data4['v1']) ?></td>
                            <td class="text-center"><?php echo number_format($data4['v2']) ?></td>
                            <td class="text-center"><?php echo number_format($data4['v3']) ?></td>
                            <td class="text-center"><?php echo number_format($data4['v4']) ?></td>
                            <td class="text-center"><?php echo number_format($data4['v5']) ?></td>
                            <td class="text-center"><?php echo number_format($data4['v6']) ?></td>
                            <td class="text-center"><?php echo number_format($data4['v7']) ?></td>
                            <td class="text-center"><?php echo number_format($data4['v8']) ?></td>
                            <td class="text-center"><?php echo number_format($data4['v9']) ?></td>
                            <td class="text-center"><?php echo number_format($data4['total']) ?></td>
                            <td class="text-center">&nbsp;</td>
                        </tr>
                        <!-- start loop v_summary_detail -->
                        <?php
                        $detail_number = 1;
                        $sql5 = "SELECT * FROM v_summary_detail where department_id = :department_id AND periodid = :periodid AND budgetgroup_id = :budgetgroup_id AND plan_id = :plan_id AND product_id = :product_id AND strategy_id = :strategy_id";

                        $params5 = array(
                            'department_id' => $department_id,
                            'periodid' => $periodid,
                            'budgetgroup_id' => $budgetgroup_id,
                            'plan_id' => $data4['plan_id'],
                            'product_id' => $data4['product_id'],
                            'strategy_id' => $data4['strategy_id']

                        );
                        $result5 = $con->prepare($sql5);
                        $res5 = $result5->execute($params5);
                        $row5 = $result5->rowCount();
                        while ($data5 = $result5->fetch()) {
                        ?>

                            <tr style="vertical-align: middle;">
                                <td class="text-center"><?php echo $detail_number; ?></td>
                                <td style="color:black;"><?php echo $data5['projectname'] ?></td>
                                <td class="text-center"><?php echo number_format($data5['v1']) ?></td>
                                <td class="text-center"><?php echo number_format($data5['v2']) ?></td>
                                <td class="text-center"><?php echo number_format($data5['v3']) ?></td>
                                <td class="text-center"><?php echo number_format($data5['v4']) ?></td>
                                <td class="text-center"><?php echo number_format($data5['v5']) ?></td>
                                <td class="text-center"><?php echo number_format($data5['v6']) ?></td>
                                <td class="text-center"><?php echo number_format($data5['v7']) ?></td>
                                <td class="text-center"><?php echo number_format($data5['v8']) ?></td>
                                <td class="text-center"><?php echo number_format($data5['v9']) ?></td>
                                <td class="text-center"><?php echo number_format($data5['total']) ?></td>
                                <td class="text-center">
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-secondary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                            Options
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#" onclick="_editProject(<?php echo $data5['projectid'] ?>)">แก้ไข</a></li>
                                            <li><a class="dropdown-item" href="#" onclick="_deleteProject(<?php echo $data5['projectid'] ?>)">ลบ</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>

                        <?php $detail_number++;
                        } ?>

                        <!-- end loop v_summary_detail -->

                    <?php $strategy_number++;
                    } ?>

                    <!-- end loop v_summary_strategy -->


                <?php $product_number++;
                } ?>
                <!-- end loop v_summary_product -->



            <?php $plan_number++;
            } ?>
            <!-- end loop v_summary_plan -->
        </tbody>
    </table>
</div>