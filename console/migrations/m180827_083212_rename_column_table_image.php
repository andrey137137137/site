<?php

use yii\db\Migration;

class m180827_083212_rename_column_table_image extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->renameColumn('{{%image}}', 'image', 'image_name');
    }

    public function down()
    {
        $this->renameColumn('{{%image}}', 'image_name', 'image');
    }
}
