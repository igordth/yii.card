<?php

use yii\db\Migration;

/**
 * Handles the creation for table `orders`.
 */
class m160508_143305_create_orders extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('orders', [
            'id' => $this->primaryKey(),
            'order_date' => $this->dateTime(),
            'price' => $this->decimal(10, 2),
            'card_id' => $this->integer()
                ->defaultValue(null),
        ]);

        $this->createIndex('idx-orders-card_id', 'orders', 'card_id');
        $this->addForeignKey('fk-orders-card_id', 'orders', 'card_id', 'cards', 'id', 'RESTRICT', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('orders');
    }
}
