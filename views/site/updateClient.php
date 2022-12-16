<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(['id' => 'login-form', 'options' => ['class' => 'horizontal'], 'method' => 'post']);

?>

<?= $form->field($client, 'client_surname') ?>

<?= $form->field($client, 'client_name') ?>

<?= $form->field($client, 'client_secondname') ?>

<?= $form->field($client, 'client_pasport') ?>

<?= $form->field($client, 'client_birthday') ?>

<?= $form->field($client, 'client_adress') ?>

<?= $form->field($client, 'client_work') ?>

<?= $form->field($client, 'client_salary') ?>

<?= $form->field($client, 'client_number') ?>


<?= Html::submitButton('Сохранить', ['class' => 'btn typicalbtn']) ?>

<?php ActiveForm::end() ?>