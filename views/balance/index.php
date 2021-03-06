<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\search\BalanceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Balances';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="balance-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Balance', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'user_id',
                'value' => function($model){
                    return $model->user->login;
                }
            ],

            'sum',

            ['class' => 'yii\grid\ActionColumn',
                'template'=>'{transaction-add},{to-user},{view}',
                'buttons' => [
                    'transaction-add'=>function($url, $model){
                        return Html::a('<span class="glyphicon glyphicon-usd"></span>','/balance/transaction-add');
                    },
                    'to-user'=>function($url, $model){
                        return Html::a('<span class="glyphicon glyphicon-user"></span>',$url);
                    }
                ]
            ],
        ],
    ]); ?>
</div>
