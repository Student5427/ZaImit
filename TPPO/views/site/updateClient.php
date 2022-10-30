<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(['id' => 'login-form', 'options' =>['class' => 'horizontal'], 'method' => 'post']);

?>

<?= $form->field($client, 'surname')?>

<?= $form->field($client, 'name')?>

<?= $form->field($client, 'patronymic')?>

<?= $form->field($client, 'passport')?>

<?= $form->field($client, 'birthdate')?>

<?= $form->field($client, 'address')?>

<?= $form->field($client, 'job')?>

<?= $form->field($client, 'income')?>

<?= $form->field($client, 'phoneNumber')?>

<?= $form->field($client, 'active')?>

<?= Html::submitButton('Save', ['class' => 'btn btn-primary'])?>

<?php ActiveForm::end() ?>