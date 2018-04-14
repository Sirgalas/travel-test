<?php

use yii\helpers\Html;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel app\search\PayerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Update ';
$this->params['breadcrumbs'][] = ['label' => 'Payers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="payer-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'payer_name',
            'secret_key',
            'payer_token',
            'secret_key',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update-form},{view}',
                'buttons' => [
                    'update-form' => function ($url, $model) {
                        return Html::a('<i class="glyphicon glyphicon-pencil"></i>', $url);
                    },
                    ]
            ]
        ],
    ]); ?>

</div>
