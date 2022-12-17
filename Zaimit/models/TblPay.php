<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblPay".
 *
 * @property int $id_pay
 * @property int $id_loan
 * @property string $pay_date
 * @property float $pay_sum
 */
class TblPay extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblPay';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_loan', 'pay_date', 'pay_sum'], 'required'],
            [['id_loan'], 'integer'],
            [['pay_date'], 'safe'],
            [['pay_sum'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_pay' => 'Id Pay',
            'id_loan' => 'Id Loan',
            'pay_date' => 'Pay Date',
            'pay_sum' => 'Pay Sum',
        ];
    }
}
