<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/* @var $model app\entities\Transaction
 * @var $payer app\entities\Payer */
/* @var $form yii\widgets\ActiveForm */
/** @var $toUserForm app\forms\ToUserForm */
/** @var $users app\entities\User */
?>

<div class="payer-form">
    <p>
        <?= $model->sum; ?>
    </p>
    <?php $form = ActiveForm::begin(); ?>
    
    <?= $form->field($toUserForm, 'recipient_sum')->textInput(['maxlength' => true]) ?>

    <?= $form->field($toUserForm, 'recipient_id')->dropDownList([$users]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>