<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\search\PayerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Payers';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="payer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if(!Yii::$app->user->isGuest){ ?>
        <p>
            <?= Html::a('Create Payer', ['create'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Update Payer', ['update'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php } ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'payer_name',

        ],
    ]); ?>
</div>
