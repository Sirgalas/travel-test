<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model app\entities\User */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php if(Yii::$app->user->isGuest) { ?>
        <p>
            <?= Html::a('Register User', ['register'], ['class' => 'btn btn-success']) ?>
        </p>
    <?php } ?>
    

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'login',
            [
                'attribute'=>'balance',
                'header'=>'Balance',
                'value'=> function($model){
                    return $model->balance->sum;
                }
            ],
            
        ],
    ]); ?>
</div>
