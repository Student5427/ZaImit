<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblDebt".
 *
 * @property int $id_debt
 * @property int $id_loan
 * @property int $debt_days
 * @property float $debt_penny
 * @property float $dent_sum
 */
class TblDebt extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblDebt';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_loan', 'debt_days', 'debt_penny', 'debt_sum'], 'required'],
            [['id_loan', 'debt_days'], 'integer'],
            [['debt_penny', 'debt_sum'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_debt' => 'Id Debt',
            'id_loan' => 'Id Loan',
            'debt_days' => 'Debt Days',
            'debt_penny' => 'Debt Penny',
            'debt_sum' => 'Dent Sum',
        ];
    }
}
