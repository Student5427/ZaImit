<?php

use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Html;



echo Html::a("Добавить клиента", ["add_client"], ['class' => 'btn typicalbtn']);

echo GridView::widget([
    'dataProvider' => $dataProvider,
    'layout' => "{items}\n {pager}",
    'columns' => [
        ['label' => 'ID', 'value' => 'id_client'], ['label' => 'Фамилия', 'value' => 'client_surname'],
        ['label' => 'Имя', 'value' => 'client_name'], ['label' => 'Отчество', 'value' => 'client_secondname'],
        ['label' => 'Серия и номер паспорта', 'value' => 'client_pasport'], ['label' => 'Дата рождения', 'value' => 'client_birthday'],
        ['label' => 'Адрес', 'value' => 'client_adress'], ['label' => 'Место работы', 'value' => 'client_work'],
        ['label' => 'Заработная плата', 'value' => 'client_salary'], ['label' => 'Номер телефона', 'value' => 'client_number'], [
            'class' => ActionColumn::class,
            'template' => '{view} {update} {delete} {link}',
        ]
    ]
]);
