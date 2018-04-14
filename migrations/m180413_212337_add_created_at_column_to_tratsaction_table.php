<?php

use yii\db\Migration;
use app\entities\Transaction;
/**
 * Handles adding created_at to table `tratsaction`.
 */
class m180413_212337_add_created_at_column_to_tratsaction_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropColumn(Transaction::tableName(),'created_at');
        $this->addColumn(Transaction::tableName(),'created_at',$this->timestamp());

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(Transaction::tableName(),'created_at');
        $this->addColumn(Transaction::tableName(),'created_at',$this->integer());
    }
}
