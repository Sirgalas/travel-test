<?php

namespace app\entities;

use Yii;

/**
 * This is the model class for table "balance".
 *
 * @property int $id
 * @property int $user_id
 * @property double $sum
 * @property integer $recipient_id
 * @property User $user
 * @property integer $recipient_sum
 * @property Transaction[] $transactions
 */
class Balance extends \yii\db\ActiveRecord
{
    public $recipient_id;
    public $recipient_sum;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'balance';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id','recipient_id'], 'integer'],
            [['sum'], 'number'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'sum' => 'Sum',
        ];
    }


    public function balanceToUser($recipient_id,$sum){
        $this->sum = $this->sum - $sum;
        
        if(($this->sum)<-1000)
            throw new \Exception('Your balance is less than the allowable minimum');
        $user=User::findOne($recipient_id);
        $user->balance->sum=$user->balance->sum+$sum;
        if(!$user->balance->save())
            throw new \Exception('Sum not transferred');

        if(!$this->update())
            throw new \Exception('balance not save');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransactions()
    {
        return $this->hasMany(Transaction::class, ['balance_id' => 'id']);
    }
}
