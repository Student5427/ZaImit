<table class = "table">
<tr><th>ID</th><th>Surname</th><th>name</th><th>Patronymic</th><th>Passport</th><th>Start Date</th><th>Deals number</th> <th>Birth date</th> <th>Role</th>
<?php
use yii\widgets\LinkPager;

$worker = $data->getWorker();

echo "<tr>";
    echo "<td>{$worker['id_worker']}</td>";
    echo "<td>{$worker['worker_surname']}</td>";
    echo "<td>{$worker['worker_name']}</td>";
    echo "<td>{$worker['worker_secondname']}</td>";
    echo "<td>{$worker['worker_passport']}</td>";
    echo "<td>{$worker['worker_date']}</td>";
    echo "<td>{$worker['worker_countm']}</td>";
    echo "<td>{$worker['worker_birthday']}</td>";
    echo "<td>{$worker['is_admin']}</td>";
echo "</tr>";

?>
</table> 