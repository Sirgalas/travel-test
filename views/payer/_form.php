<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\entities\Payer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'payer_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payer_token')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'secret_key')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
