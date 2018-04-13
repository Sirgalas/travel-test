<?php

use yii\db\Migration;

/**
 * Handles the creation of table `transaction`.
 */
class m180413_174616_create_payer_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('payer', [
            'id' => $this->primaryKey(),
            'payer_name'=>$this->string(255)->notNull(),
            'payer_token'=>$this->string(255),
            'secret_key'=>$this->string(255)
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('payer');
    }
}
