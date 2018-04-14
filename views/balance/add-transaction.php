<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $model app\entities\Transaction
 * @var $payer app\entities\Payer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="payer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'sum')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payer_id')->dropDownList([$payer]) ?>
    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>