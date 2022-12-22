<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblLoan".
 *
 * @property int $id_loan
 * @property int $id_client
 * @property int $id_worker
 * @property float $loan_sum
 * @property float $loan_percent
 * @property string $loan_start
 * @property string $loan_end
 * @property string $loan_date_pay
 * @property float $loan_sum_pay
 */
class TblLoan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblLoan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_client', 'id_worker', 'loan_sum', 'loan_percent', 'loan_start', 'loan_end', 'loan_date_pay', 'loan_sum_pay'], 'required'],
            [['id_client', 'id_worker'], 'integer'],
            [['loan_sum', 'loan_percent', 'loan_sum_pay'], 'number'],
            [['loan_start', 'loan_end', 'loan_date_pay'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_loan' => 'Id Loan',
            'id_client' => 'Id Client',
            'id_worker' => 'Id Worker',
            'loan_sum' => 'Loan Sum',
            'loan_percent' => 'Loan Percent',
            'loan_start' => 'Loan Start',
            'loan_end' => 'Loan End',
            'loan_date_pay' => 'Loan Date Pay',
            'loan_sum_pay' => 'Loan Sum Pay',
        ];
    }
}
