<?php

namespace app\entities;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\web\IdentityInterface;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $login
 * @property int $created_at
 * @property int $updated_at
 *
 * @property Balance[] $balance
 */
class User extends ActiveRecord implements IdentityInterface
{
    use \app\traits\Validate;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['login'], 'required'],
            [['login'], 'unique'],
            [['created_at', 'updated_at'], 'integer'],
            [['login'], 'string', 'max' => 510],
        ];
    }

    public function afterSave($insert, $changedAttributes)
    {
        $balance = new Balance([
            "user_id" => $this->id,
            "sum" => 0.00
        ]);
        $balance->save();

        parent::afterSave($insert, $changedAttributes);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    public function getId()
    {
        return $this->getPrimaryKey();
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBalance()
    {
        return $this->hasOne(Balance::class, ['user_id' => 'id']);
    }

    public static function findUserbyLogin($login)
    {
        return static::findOne(['login' => $login]);
    }
}
