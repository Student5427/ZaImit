<?php
use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Html;



echo Html::a("Add worker", ["add_worker"], ['class' => 'btn btn->info']);

echo GridView::widget(['dataProvider' => $dataProvider,
'layout'=> "{items}\n {pager}",
'columns' => ['ID', 'surname', 'name','patronymic','passport','startDate','dealsNumber','birthDate','role',['class' => ActionColumn::class,
'template' => '{view} {update} {delete} {link}',]]]);


?>
