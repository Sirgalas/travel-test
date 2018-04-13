<?php

namespace app\entities;

use Yii;

/**
 * This is the model class for table "transaction".
 *
 * @property int $id
 * @property int $balance_id
 * @property int $payer_id
 * @property int $created_at
 *
 * @property Balance $balance
 */
class Transaction extends \yii\db\ActiveRecord
{
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
            [['balance_id'], 'exist', 'skipOnError' => true, 'targetClass' => Balance::className(), 'targetAttribute' => ['balance_id' => 'id']],
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBalance()
    {
        return $this->hasOne(Balance::className(), ['id' => 'balance_id']);
    }
}
