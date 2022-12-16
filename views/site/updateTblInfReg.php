<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TblInfReg */
/* @var $form ActiveForm */
?>
<div class="InfReg">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'infreg_date') ?>
    <?= $form->field($model, 'infreg_time') ?>
    <?= $form->field($model, 'infreg_emp') ?>

    <div class="form-group">
        <?= Html::submitButton('Подтвердить', ['class' => 'btn typicalbtn']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- InfReg -->