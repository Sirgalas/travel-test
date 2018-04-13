<?php

use yii\db\Migration;

/**
 * Handles the creation of table `balance`.
 */
class m180413_174530_create_balance_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('balance', [
            'id' => $this->primaryKey(),
            'user_id'=>$this->integer(),
            'sum'=>$this->float(),
        ]);
        $this->createIndex(
            'idx-balance_id',
            'balance',
            'id'
        );
        $this->addForeignKey(
            'fk-balance_user',
            'balance',
            'user_id',
            'user',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {

        $this->dropForeignKey(
            'fk-balance_user',
            'balance'
        );

        // drops index for column `author_id`
        $this->dropIndex(
            'idx-balance_id',
            'balance'
        );
        $this->dropTable('balance');
    }
}
