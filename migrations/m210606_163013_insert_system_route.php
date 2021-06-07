<?php

use yii\db\Migration;

/**
 * Class m210606_163013_insert_system_route
 */
class m210606_163013_insert_system_route extends Migration
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
        echo "m210606_163013_insert_system_route cannot be reverted.\n";

        return false;
    }

    public function up()
    {
        $this->insert(
            'system',
            [
                'key' => 'network_gateway',
                'value' => '192.168.1.1',
            ]
        );
    }

    public function down()
    {
        $this->delete('system', ['key' => 'network_gateway']);
    }
}
