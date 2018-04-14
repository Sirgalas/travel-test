<?php

use yii\db\Migration;
use app\entities\User;
/**
 * Handles adding created_at to table `user`.
 */
class m180413_212348_add_created_at_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn(User::tableName(),'created_at');
        $this->dropColumn(User::tableName(),'updated_at');
        $this->addColumn(User::tableName(),'created_at',$this->timestamp());
        $this->addColumn(User::tableName(),'updated_at',$this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'));
        
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(User::tableName(),'created_at');
        $this->dropColumn(User::tableName(),'updated_at');
        $this->addColumn(User::tableName(),'created_at',$this->integer());
        $this->addColumn(User::tableName(),'updated_at',$this->integer());
    }
}
