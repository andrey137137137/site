<?php

use yii\db\Migration;

/**
 * Class m180926_174739_add_timestamp_columns_table_category
 */
class m180926_174739_add_timestamp_columns_table_category extends Migration
{
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('{{%category}}', 'created_at', $this->string()->notNull()->after('is_main'));
        $this->addColumn('{{%category}}', 'updated_at', $this->string()->notNull()->after('created_at'));
    }

    public function down()
    {
        $this->dropColumn('{{%category}}', 'created_at');
        $this->dropColumn('{{%category}}', 'updated_at');
    }
}
