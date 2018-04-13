<?php

namespace app\entities;

use Yii;

/**
 * This is the model class for table "payer".
 *
 * @property int $id
 * @property string $payer_name
 * @property string $payer_token
 * @property string $secret_key
 *
 * @property Transaction[] $transactions
 */
class Payer extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'payer';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['payer_name'], 'required'],
            [['payer_name', 'payer_token', 'secret_key'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'payer_name' => 'Payer Name',
            'payer_token' => 'Payer Token',
            'secret_key' => 'Secret Key',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transaction::className(), ['payer_id' => 'id']);
    }
}
