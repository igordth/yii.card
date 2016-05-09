<?php

use yii\db\Migration;

/**
 * Handles the creation for table `catds`.
 */
class m160508_092904_create_cards extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('cards', [
            'id' => $this->primaryKey(),
            'series' => $this->string(3),
            'release_date' => $this->dateTime(),
            'expiration_date' => $this->dateTime(),
            'amount' => $this->decimal(10, 2),
            'status' => "ENUM('not_active', 'active', 'overdue') NOT NULL DEFAULT 'not_active'",
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('cards');
    }
}
