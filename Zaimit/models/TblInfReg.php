<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblInfReg".
 *
 * @property string $infreg_date
 * @property string $infreg_time
 * @property int $infreg_emp
 */
class TblInfReg extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblInfReg';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['infreg_date', 'infreg_time', 'infreg_emp'], 'required'],
            [['infreg_date', 'infreg_time'], 'safe'],
            [['infreg_emp'], 'integer'],
            [['infreg_date', 'infreg_time'], 'unique', 'targetAttribute' => ['infreg_date', 'infreg_time']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'infreg_date' => 'Infreg Date',
            'infreg_time' => 'Infreg Time',
            'infreg_emp' => 'Infreg Emp',
        ];
    }
}
