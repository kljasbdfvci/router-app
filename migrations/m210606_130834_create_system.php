<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%system}}`.
 */
class m210606_130834_create_system extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210606_130834_create_system cannot be reverted.\n";

        return false;
    }

    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('{{%system}}', [
            'id' => $this->primaryKey(),
            'key'  => $this->string()->notNull(),
            'value'  => $this->string()->notNull(),
        ]);

        $this->createIndex('{{%system_unique}}', '{{%system}}', 'key', $unique = true);
    }

    public function down()
    {
        $this->dropTable('{{%system}}');
    }
}
