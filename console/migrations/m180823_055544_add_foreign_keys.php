<?php

use yii\db\Migration;

class m180823_055544_add_foreign_keys extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        // create index for column `cat_id`
        $this->createIndex(
            'idx_image_category_id',
            '{{%image}}',
            'cat_id'
        );

        // create index for column `parent_id`
        $this->createIndex(
            'idx_category_category_id',
            '{{%category}}',
            'parent_id'
        );

        // create index for column `main_image_id`
        $this->createIndex(
            'idx_category_image_id',
            '{{%category}}',
            'main_image_id'
        );

        // add foreign key for table `image`
        $this->addForeignKey(
            'fk_image_category_id',
            '{{%image}}',
            'cat_id',
            '{{%category}}',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        // add foreign key for table `category`
        $this->addForeignKey(
            'fk_category_category_id',
            '{{%category}}',
            'parent_id',
            '{{%category}}',
            'id',
            'RESTRICT',
            'CASCADE'
        );

        // add foreign key for table `category`
        $this->addForeignKey(
            'fk_category_image_id',
            '{{%category}}',
            'main_image_id',
            '{{%image}}',
            'id',
            'SET NULL',
            'CASCADE'
        );
    }

    public function down()
    {
        // drop foreign key for table `image`
        $this->dropForeignKey(
            'fk_image_category_id',
            '{{%image}}'
        );

        // drop foreign key for table `category`
        $this->dropForeignKey(
            'fk_category_category_id',
            '{{%category}}'
        );

        // drop foreign key for table `category`
        $this->dropForeignKey(
            'fk_category_image_id',
            '{{%category}}'
        );

        // drop index for column `cat_id`
        $this->dropIndex(
            'idx_image_category_id',
            '{{%image}}'
        );

        // drop index for column `parent_id`
        $this->dropIndex(
            'idx_category_category_id',
            '{{%category}}'
        );

        // drop index for column `main_image_id`
        $this->dropIndex(
            'idx_category_image_id',
            '{{%category}}'
        );

    }
}
