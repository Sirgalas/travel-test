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
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Payer', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'payer_name',
            'payer_token',
            'secret_key',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
