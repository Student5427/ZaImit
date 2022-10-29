<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(['id' => 'login-form', 'options' =>['class' => 'horizontal'], 'method' => 'post']);

?>

<?= $form->field($worker, 'surname')?>

<?= $form->field($worker, 'name')?>

<?= $form->field($worker, 'patronymic')?>

<?= $form->field($worker, 'passport')?>

<?= $form->field($worker, 'startDate')?>

<?= $form->field($worker, 'dealsNumber')?>

<?= $form->field($worker, 'birthDate')?>

<?= $form->field($worker, 'role')?>

<?= Html::submitButton('Save', ['class' => 'btn btn-primary'])?>

<?php ActiveForm::end() ?>