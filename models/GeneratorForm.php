<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\db\Expression;

/**
 * GeneratorForm is the model for generate card form.
 */
class GeneratorForm extends Model
{
    const EXPIRATION = [
        12 => '1 год',
        6 => '6 месяцев',
        1 => '1 месяц',
    ];

    public $series;
    public $count;
    public $expiration = 12;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['series', 'count', 'expiration'], 'required'],
            [['series'], 'string', 'max' => 3],
            [['series'], 'string', 'min' => 3],
            [['series'], 'match', 'pattern' => '/[a-z\d]{3}/i'],
            [['count', 'expiration'], 'integer'],
            [['expiration'], 'in', 'range' => array_keys(self::EXPIRATION)],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'series' => 'Серия',
            'count' => 'Количество карт',
            'expiration' => 'Срок окончания активности',
        ];
    }

    /**
     * Generate Card model.
     *
     * @return mixed
     */
    public function generate()
    {
        $data = [];
        for ($i=1; $i<=$this->count; $i++) {
            $date = new \DateTime();
            $date->add(new \DateInterval("P{$this->expiration}M"));
            $data[] = [
                'series' => $this->series,
                'release_date' => new Expression("NOW()"),
                'expiration_date' => $date->format("Y-m-d H:i:s"),
                'amount' => rand(1, 10000),
                'status' => 'active',

            ];
        }
        Yii::$app
            ->db
            ->createCommand()
            ->batchInsert('cards', ['series', 'release_date', 'expiration_date', 'amount', 'status'], $data)
            ->execute();
        return true;
    }
}
