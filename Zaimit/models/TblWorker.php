<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblWorker".
 *
 * @property int $id_worker
 * @property string $worker_name
 * @property string $worker_surname
 * @property string|null $worker_secondname
 * @property string $worker_birthday
 * @property string $worker_passport
 * @property string $worker_date
 * @property int $worker_countm
 * @property int $is_admin
 */
class TblWorker extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tblWorker';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['worker_name', 'worker_surname', 'worker_birthday', 'worker_passport', 'worker_date', 'worker_countm', 'is_admin'], 'required'],
            [['worker_birthday', 'worker_date'], 'safe'],
            [['worker_countm', 'is_admin'], 'integer'],
            [['worker_name', 'worker_surname', 'worker_secondname'], 'string', 'max' => 50],
            [['worker_passport'], 'string', 'max' => 11],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_worker' => 'Id Worker',
            'worker_name' => 'Worker Name',
            'worker_surname' => 'Worker Surname',
            'worker_secondname' => 'Worker Secondname',
            'worker_birthday' => 'Worker Birthday',
            'worker_passport' => 'Worker Passport',
            'worker_date' => 'Worker Date',
            'worker_countm' => 'Worker Countm',
            'is_admin' => 'Is Admin',
        ];
    }
}
