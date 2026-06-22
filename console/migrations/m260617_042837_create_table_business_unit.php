<?php

use yii\db\Migration;

class m260617_042837_create_table_business_unit extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%business_unit}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'description' => $this->string(255),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ]);

        $this->batchInsert('{{%business_unit}}', ['name', 'description', 'created_at', 'updated_at'], [
            ['Copper Rod & Wire Production', 'Unit produksi batang dan kawat tembaga', time(), time()],
            ['Aluminum Rod Production', 'Unit produksi batang aluminium', time(), time()],
            ['Quality Control', 'Unit kalibrasi dan pengujian kualitas', time(), time()],
            ['Warehouse & Logistic', 'Unit gudang dan logistik bahan baku', time(), time()],
            ['IT & General Affair', 'Unit IT dan umum', time(), time()],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
         $this->dropTable('{{%business_unit}}');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m260617_042837_create_table_business_unit cannot be reverted.\n";

        return false;
    }
    */
}
