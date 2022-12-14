<?php

use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Html;



echo Html::a("Добавить сотрудника", ["add_worker"], ['class' => 'btn typicalbtn']);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'layout' => "{items}\n {pager}",
    'columns' => [
        ['label' => 'ID', 'value' => 'id_worker'], ['label' => 'Фамилия', 'value' => 'worker_surname'],
        ['label' => 'Имя', 'value' => 'worker_name'], ['label' => 'Отчество', 'value' => 'worker_secondname'],
        ['label' => 'Серия и номер паспорта', 'value' => 'worker_passport'], ['label' => 'Дата приема на работу', 'value' => 'worker_date'],
        ['label' => 'Количество клиентов', 'value' => 'worker_countm'], ['label' => 'Дата рождения', 'value' => 'worker_birthday'],
        ['label' => 'Наличие прав администратора', 'value' => 'is_admin'], [
            'class' => ActionColumn::class,
            'template' => '{update} {auth} {delete} {link}',
            'buttons' => [
                'auth' => function ($url, $model) {
                    return Html::a(
                        '<span class="glyphicon glyphicon-wrench"></span>',
                        $url
                    );
                },
            ],'visibleButtons' => [
                'delete' => function ($model, $key, $index) {
                    return $model->is_admin === 0;
                },
            ] 
        ]
    ]
]);
