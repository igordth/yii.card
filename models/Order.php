<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property integer $id
 * @property string $order_date
 * @property string $price
 * @property integer $card_id
 *
 * @property Card $card
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_date'], 'safe'],
            [['price'], 'number'],
            [['card_id'], 'integer'],
            [['card_id'], 'exist', 'skipOnError' => true, 'targetClass' => Card::className(), 'targetAttribute' => ['card_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'order_date' => 'Order Date',
            'price' => 'Price',
            'card_id' => 'Card ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCard()
    {
        return $this->hasOne(Card::className(), ['id' => 'card_id']);
    }
}
