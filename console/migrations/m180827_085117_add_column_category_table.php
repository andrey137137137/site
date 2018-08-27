<?php

use yii\db\Migration;

class m180827_085117_add_column_category_table extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('{{%category}}', 'image_name', $this->string()->notNull()->after('alias'));
    }

    public function down()
    {
        $this->dropColumn('{{%category}}', 'image_name');
    }
}
