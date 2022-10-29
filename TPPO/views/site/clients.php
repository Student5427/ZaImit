<?php
use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Html;



echo Html::a("Add client", ["add_client"], ['class' => 'btn btn->info']);

echo GridView::widget(['dataProvider' => $dataProvider,
'layout'=> "{items}\n {pager}",
'columns' => ['ID', 'surname', 'name','patronymic','passport','birthdate','address','job','income','phoneNumber','active',['class' => ActionColumn::class,
'template' => '{view} {update} {delete} {link}',]]]);


?>
