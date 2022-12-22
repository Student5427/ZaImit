<?php

use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Html;

echo "Микрозаймы клиента $client->client_surname $client->client_name $client->client_secondname"; 

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'layout' => "{items}\n {pager}",
    'columns' => [
        ['label' => 'ID', 'value' => 'id_client'], ['label' => 'Сумма займа', 'value' => 'loan_sum'], ['label' => 'Процентная ставка', 'value' => 'loan_percent'],
        ['label' => 'Дата оформления займа', 'value' => 'loan_start'], ['label' => 'Предполагаемая дата погашения займа', 'value' => 'loan_end'],
        ['label' => 'Дата последней выплаты', 'value' => 'loan_date_pay'],['label' => 'Сумма выплат', 'value' => 'loan_sum_pay'],
        [
            'class' => ActionColumn::class,
            'template' => '{add_pay} {check_pays}',
            'buttons' => [
                'add_pay' => function ($url, $model) {
                    return Html::a(
                        '<span class="glyphicon glyphicon-ruble"></span>',
                        $url, ['title'=>'add_pay'] 
                    );
                },
                'check_pays' => function ($url, $model) {
                    return Html::a(
                        '<span class="glyphicon glyphicon-eye-open"></span>',
                        $url, ['title'=>'add_pay'] 
                    );
                },
            ],
        ]
    ]
]);