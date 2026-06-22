<?php

use yii\db\Migration;

class m260617_043120_create_table_request extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%request}}', [
            'id' => $this->primaryKey(),
            'business_unit_id' => $this->integer()->notNull(),
            'request_type_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'title' => $this->string(255)->notNull(),
            'description' => $this->text(),
            'priority' => $this->smallInteger()->notNull()->defaultValue(2),
            'status' => $this->smallInteger()->notNull()->defaultValue(1),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('fk-request-business_unit_id', '{{%request}}', 'business_unit_id', '{{%business_unit}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-request-request_type_id', '{{%request}}', 'request_type_id', '{{%request_type}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-request-user_id', '{{%request}}', 'user_id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');
    }


    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-request-business_unit_id', '{{%request}}');
        $this->dropForeignKey('fk-request-request_type_id', '{{%request}}');
        $this->dropForeignKey('fk-request-user_id', '{{%request}}');
        $this->dropTable('{{%request}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m260617_043120_create_table_request cannot be reverted.\n";

        return false;
    }
    */
}
