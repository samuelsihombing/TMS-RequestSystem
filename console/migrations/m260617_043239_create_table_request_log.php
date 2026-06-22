<?php

use yii\db\Migration;

class m260617_043239_create_table_request_log extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
   {
        $this->createTable('{{%request_log}}', [
            'id' => $this->primaryKey(),
            'request_id' => $this->integer()->notNull(),
            'status' => $this->smallInteger()->notNull(),
            'note' => $this->text(),
            'changed_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('fk-request_log-request_id', '{{%request_log}}', 'request_id', '{{%request}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-request_log-changed_by', '{{%request_log}}', 'changed_by', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }
    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-request_log-request_id', '{{%request_log}}');
        $this->dropForeignKey('fk-request_log-changed_by', '{{%request_log}}');
        $this->dropTable('{{%request_log}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m260617_043239_create_table_request_log cannot be reverted.\n";

        return false;
    }
    */
}
