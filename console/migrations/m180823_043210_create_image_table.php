<?php

use yii\db\Migration;

/**
 * Handles the creation of table `image`.
 */
class m180823_043210_create_image_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('{{%image}}', [
            'id' => $this->primaryKey()->unsigned(),
            'name' => $this->string()->null(),
            'alias' => $this->string()->null(),
            'image' => $this->string()->notNull(),
            'description' => $this->text()->null(),
            'meta_keys' => $this->string()->null(),
            'meta_desc' => $this->text()->null(),
            'created_at' => $this->integer()->unsigned()->notNull(),
            'updated_at' => $this->integer()->unsigned()->notNull(),
            'cat_id' => $this->integer()->unsigned()->notNull(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('{{%image}}');
    }
}
