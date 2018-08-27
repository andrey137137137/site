<?php

use yii\db\Migration;

class m180827_160932_alter_column_table_image extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->alterColumn('{{%image}}', 'image_name', $this->string()->null());
    }

    public function down()
    {
        
    }
}
