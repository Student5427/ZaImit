<?php
#Таблица для просмотра свободных для записи дат + добавление новой свободной даты + запись клиента на опр. дату
use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\bootstrap\Alert;


echo Html::a("Добавить клиента", ["add_client"], ['class' => 'btn typicalbtn']);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'layout' => "{items}\n {pager}",
    'columns' => [
        ['label' => 'Дата записи', 'value' => 'infreg_date'], ['label' => 'Время записи', 'value' => 'infreg_time'],
        ['label' => 'Занято', 'value' => 'infreg_emp'], [
            'class' => ActionColumn::class,
            'template' => '{update_regist} {cancel_regist} {link}',
            'buttons' => [
                'update_regist' => function ($url, $model) {
                    return Html::a(
                        '<span class="glyphicon glyphicon-pencil"></span>',
                        $url
                    );
                },
                'cancel_regist' => function ($url, $model) {
                    return Html::a(
                        '<span class="	glyphicon glyphicon-remove"></span>',
                        $url,
                        ['style' => ['color' => 'black', 'display' => 'inline']],
                    );
                },
            ], 'visibleButtons' => [
                'update_regist' => function ($model, $key, $index) {
                    return $model->infreg_emp === 0;
                },
                'cancel_regist' => function ($model, $key, $index) {
                    return $model->infreg_emp === 1;
                },
            ]

        ]
    ]
]);

/*echo Alert::widget([
    'options' => [
        'class' => 'alert-info',
    ],
    'body' => 'Say hello...',
]);*/
