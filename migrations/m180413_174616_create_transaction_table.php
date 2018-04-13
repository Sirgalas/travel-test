<?php

use yii\db\Migration;

/**
 * Handles the creation of table `transaction`.
 */
class m180413_174616_create_transaction_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('transaction', [
            'id' => $this->primaryKey(),
            'balance_id'=>$this->integer(),
            'payer_id'=>$this->integer(),
            'created_at'=>$this->integer(),
        ]);
        $this->createIndex(
            'idx-transaction-balance_id',
            'transaction',
            'balance_id'
        );
        $this->addForeignKey(
            'fk-transaction-balance_id',
            'transaction',
            'balance_id',
            'balance',
            'id',
            'CASCADE'
        );
        $this->addForeignKey(
            'fk-transaction-payer_id',
            'transaction',
            'payer_id',
            'payer',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        /*$this->dropForeignKey(
            'fk-transaction-payer_id',
            'transaction'
        );
        $this->dropForeignKey(
            'fk-transaction-balance_id',
            'transaction'
        );*/

        $this->dropIndex(
            'idx-transaction_balance_id',
            'transaction'
        );
        $this->dropTable('transaction');
    }
}
