<?php

namespace app\entities;

use SebastianBergmann\Timer\RuntimeException;
use Yii;

/**
 * This is the model class for table "transaction".
 *
 * @property int $id
 * @property int $balance_id
 * @property int $payer_id
 * @property int $created_at
 * @property int $sum
 * @property Balance $balance
 * @property Payer $payer
 */
class Transaction extends \yii\db\ActiveRecord
{
    public $sum;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'transaction';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['balance_id', 'payer_id', 'created_at'], 'integer'],
            [['balance_id'], 'exist', 'skipOnError' => true, 'targetClass' => Balance::class, 'targetAttribute' => ['balance_id' => 'id']],
            [['payer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Payer::class, 'targetAttribute' => ['payer_id' => 'id']],
            [['sum'],'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'balance_id' => 'Balance ID',
            'payer_id' => 'Payer ID',
            'created_at' => 'Created At',
        ];
    }
    
    public function beforeSave($insert)
    {
        if(Yii::$app->user->isGuest)
            throw new RuntimeException('user not find');
        $balance = Balance::findOne(['user_id'=>Yii::$app->user->id]);
        if(!$balance)
            throw new \RuntimeException('balance not find');
        $balance->sum=$balance->sum+$this->sum;
        if(!$balance->save())
            throw new RuntimeException('balance not save');
        return parent::beforeSave($insert); 
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBalance()
    {
        return $this->hasOne(Balance::className(), ['id' => 'balance_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayer()
    {
        return $this->hasOne(Payer::className(), ['id' => 'payer_id']);
    }
}
