<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\TblRegist */
/* @var $form ActiveForm */
?>
<div class="updateTblRegist">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'regist_name') ?>
    <?= $form->field($model, 'regist_surname') ?>
    <?= $form->field($model, 'regist_number') ?>
    <?= $form->field($model, 'regist_date') ?>
    <?= $form->field($model, 'regist_time') ?>
    <?= $form->field($model, 'regist_secondname') ?>

    <div class="form-group">
        <?= Html::submitButton('Подтвердить', ['class' => 'btn typicalbtn']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div><!-- updateTblRegist -->