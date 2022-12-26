<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TblLoan */
/* @var $form ActiveForm */
?>
<div class="updateTblLoan">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'loan_sum') ?>
    <?= $form->field($model, 'loan_percent') ?>
    <?= $form->field($model, 'loan_start') ?>
    <?= $form->field($model, 'loan_end') ?>

    <div class="form-group">
        <?= Html::submitButton('Подтвердить', ['class' => 'btn typicalbtn']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- updateTblLoan -->