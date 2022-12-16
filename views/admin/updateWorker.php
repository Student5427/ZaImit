<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(['id' => 'login-form', 'options' =>['class' => 'horizontal'], 'method' => 'post']);

?>

<?= $form->field($worker, 'worker_surname')?>

<?= $form->field($worker, 'worker_name')?>

<?= $form->field($worker, 'worker_secondname')?>

<?= $form->field($worker, 'worker_pasport')?>

<?= $form->field($worker, 'worker_date')?>

<?= $form->field($worker, 'worker_countm')?>

<?= $form->field($worker, 'worker_birthday')?>

<?= $form->field($worker, 'is_admin')?>

<?= Html::submitButton('Save', ['class' => 'btn typicalbtn'])?>

<?php ActiveForm::end() ?>