<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category`.
 */
class m180823_050539_create_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%category}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string()->notNull(),
            'alias' => $this->string()->notNull(),
            'description' => $this->text()->null(),
            'is_main' => $this->smallInteger()->defaultValue(0),
            'parent_id' => $this->integer()->unsigned()->null(),
            'main_image_id' => $this->integer()->unsigned()->null(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%category}}');
    }
}
