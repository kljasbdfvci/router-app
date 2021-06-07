<?php

use yii\db\Migration;

/**
 * Class m210606_163729_create_sysstat
 */
class m210606_163729_create_sysstat extends Migration
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
        echo "m210606_163729_create_sysstat cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('{{%sysstat}}', [
            'id' => $this->primaryKey(),
            'datetime'  => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'daemon'  => $this->string()->notNull(),
            'value'  => $this->float()->notNull(),
        ]);
    }

    public function down()
    {
        $this->dropTable('{{%sysstat}}');
    }
}
