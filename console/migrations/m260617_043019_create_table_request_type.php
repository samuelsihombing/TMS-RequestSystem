<?php

use yii\db\Migration;

class m260617_043019_create_table_request_type extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%request_type}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->batchInsert('{{%request_type}}', ['name', 'created_at', 'updated_at'], [
            ['Machine Maintenance', time(), time()],
            ['Procurement / Sparepart', time(), time()],
            ['IT Support', time(), time()],
            ['Quality Calibration', time(), time()],
            ['General Affair', time(), time()],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%request_type}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m260617_043019_create_table_request_type cannot be reverted.\n";

        return false;
    }
    */
}
