<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\entities\Payer */

$this->title = 'Update Payer: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Payers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="payer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
