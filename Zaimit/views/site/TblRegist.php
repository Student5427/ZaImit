<?php
#Таблица для просмотра свободных для записи дат + добавление новой свободной даты + запись клиента на опр. дату
use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\helpers\Html;


echo GridView::widget([
    'dataProvider' => $dataProvider,
    'layout' => "{items}\n {pager}",
    'columns' => [
        ['label' => 'Имя', 'value' => 'regist_name'], ['label' => 'Фамилия', 'value' => 'regist_surname'],
        ['label' => 'Имя', 'value' => 'regist_secondname'], ['label' => 'Дата записи', 'value' => 'regist_date'],
        ['label' => 'Время записи', 'value' => 'regist_time'], ['label' => 'Номер', 'value' => 'regist_number'], [
            'class' => ActionColumn::class,
            'template' => '{view} {update} {delete} {link}',
        ]
    ]
]);
