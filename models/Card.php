<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cards".
 *
 * @property integer $id
 * @property string $series
 * @property string $release_date
 * @property string $expiration_date
 * @property string $amount
 * @property string $status
 *
 * @property Order[] $orders
 */
class Card extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cards';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['series', 'release_date', 'expiration_date', 'amount', 'status'], 'required'],
            [['release_date', 'expiration_date'], 'safe'],
            [['amount'], 'number'],
            [['status'], 'string'],
            [['series'], 'string', 'max' => 3],
            [['series'], 'string', 'min' => 3],
            [['series'], 'match', 'pattern' => '/[a-z\d]{3}/i'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'series' => 'Series',
            'release_date' => 'Release Date',
            'expiration_date' => 'Expiration Date',
            'amount' => 'Amount',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Order::className(), ['card_id' => 'id']);
    }

    /**
     * Check expiration date of card.
     * Set status to overdue if expiration date is overdue.
     *
     * @return boolean
     */
    public function checkIsActive()
    {
        if (empty($this->expiration_date)) return false;
        if (strtotime($this->expiration_date)>=time()) {
            if ($this->status != 'overdue') {
                $this->status = 'overdue';
                $this->save();
            }
            return false;
        }
        return true;
    }
}
