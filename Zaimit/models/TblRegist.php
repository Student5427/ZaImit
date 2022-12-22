<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblRegist".
 *
 * @property int $id_regist
 * @property string $regist_name
 * @property string $regist_surname
 * @property string|null $regist_secondname
 * @property string $regist_number
 * @property string $regist_date
 * @property string $regist_time
 */
class TblRegist extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblRegist';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['regist_name', 'regist_surname', 'regist_number', 'regist_date', 'regist_time'], 'required'],
            [['regist_date', 'regist_time'], 'safe'],
            [['regist_name', 'regist_surname', 'regist_secondname'], 'string', 'max' => 50],
            [['regist_number'], 'string', 'max' => 11],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_regist' => 'Id Regist',
            'regist_name' => 'Regist Name',
            'regist_surname' => 'Regist Surname',
            'regist_secondname' => 'Regist Secondname',
            'regist_number' => 'Regist Number',
            'regist_date' => 'Regist Date',
            'regist_time' => 'Regist Time',
        ];
    }
}
