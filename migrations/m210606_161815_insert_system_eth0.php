<?php

use yii\db\Migration;

/**
 * Class m210606_161815_insert_system_eth0
 */
class m210606_161815_insert_system_eth0 extends Migration
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
        echo "m210606_161815_insert_system_eth0 cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->insert(
            'system',
            [
                'key' => 'network_eth0_ip3',
                'value' => '192.168.1.11',
            ]
        );
        $this->insert(
            'system',
            [
                'key' => 'network_eth0_netmask3',
                'value' => '255.255.255.0',
            ]
        );
    }

    public function down()
    {
        $this->delete('system', ['key' => 'network_eth0_ip3']);
        $this->delete('system', ['key' => 'network_eth0_netmask3']);
    }
}
