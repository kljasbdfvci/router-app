<?php

use yii\db\Migration;

/**
 * Class m210606_120808_user_add_admin
 */
class m210606_120808_insert_user_admin extends Migration
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
        echo "m210606_120808_user_add_admin cannot be reverted.\n";

        return false;
    }


    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->insert(
            'user',
            [
                'id' => 1,
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'password_hash' => '$2y$08$MSWS3wVxinKWEftIZI91BORXXx/nT8i9qHkGouaQ7j3XZ8bwsOHvm',
                'auth_key' => '6XwprqzIHbhkb3jj536obVqsmhpGk7Yp',
                'confirmed_at' => '1531493443',
                'unconfirmed_email' => NULL,
                'blocked_at' => NULL,
                'registration_ip' => '::1',
                'created_at' => '1531493443',
                'updated_at' => '1531547431',
                'flags' => 0,
                'last_login_at' => '1577543768'
            ]
        );
        $this->insert(
            'profile',
            [
                'user_id' => 1,
                'name' => NULL,
                'public_email' => NULL,
                'gravatar_email' => NULL,
                'gravatar_id' => NULL,
                'location' => NULL,
                'website' => NULL,
                'bio' => NULL,
                'timezone' => NULL,
            ]
        );
    }

    public function down()
    {
        $this->delete('user', ['id' => 1]);
        $this->delete('profile', ['user_id' => 1]);
    }
}
