<table class = "table">
<tr><th>ID</th><th>Surname</th><th>name</th><th>Patronymic</th><th>Passport</th><th>Start Date</th><th>Deals number</th> <th>Birth date</th> <th>Role</th>
<?php
use yii\widgets\LinkPager;

$worker = $data->getWorker();

echo "<tr>";
    echo "<td>{$worker['ID']}</td>";
    echo "<td>{$worker['surname']}</td>";
    echo "<td>{$worker['name']}</td>";
    echo "<td>{$worker['patronymic']}</td>";
    echo "<td>{$worker['passport']}</td>";
    echo "<td>{$worker['startDate']}</td>";
    echo "<td>{$worker['dealsNumber']}</td>";
    echo "<td>{$worker['birthDate']}</td>";
    echo "<td>{$worker['role']}</td>";
echo "</tr>";

?>
</table> 