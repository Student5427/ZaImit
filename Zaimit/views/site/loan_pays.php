<?php

use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Html;

echo "Выплаты по микрозайму № $loan->id_loan"; 

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'layout' => "{items}\n {pager}",
    'columns' => [
        ['label' => 'Дата выплаты', 'value' => 'pay_date'],['label' => 'Сумма выплаты', 'value' => 'pay_sum'],
        [
            'class' => ActionColumn::class,
            'template' => '{add_pay} {check_pays}',
        ]
    ]
]);