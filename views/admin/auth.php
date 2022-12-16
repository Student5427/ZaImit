<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$form = ActiveForm::begin(['id' => 'login-form', 'options' =>['class' => 'horizontal'], 'method' => 'post']);

?>

<?= $form->field($auth, 'auth_login')?>

<?= $form->field($auth, 'auth_pass')?>


<?= Html::submitButton('Save', ['class' => 'btn typicalbtn'])?>

<?php ActiveForm::end() ?>