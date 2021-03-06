<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m180413_174503_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'login'=>$this->string(510),
            'created_at'=>$this->timestamp(),
            'updated_at'=>$this->timestamp()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);
        $this->createIndex(
            'idx-user_login',
            'user',
            'login'
        );

       
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user');
    }
}
