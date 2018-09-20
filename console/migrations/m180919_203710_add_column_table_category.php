<?php

use yii\db\Migration;

/**
 * Class m180919_203710_add_column_table_category
 */
class m180919_203710_add_column_table_category extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('{{%category}}', 'image_name', $this->string()->null()->after('alias'));
    }

    public function down()
    {
        $this->dropColumn('{{%category}}', 'image_name');
    }
}
