<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TblPay */
/* @var $form ActiveForm */
?>
<div class="updateTblPay">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'pay_date') ?>
    <?= $form->field($model, 'pay_sum') ?>

    <div class="form-group">
        <?= Html::submitButton('Подтвердить', ['class' => 'btn typicalbtn']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- updateTblPay -->