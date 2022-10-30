<?php

namespace app\models;

use yii\db\ActiveRecord;

class Clients extends ActiveRecord 
{
    public static function tableName() {
        return 'clients';
    }

    public function rules()
    {
	return[[['ID', 'surname', 'name', 'patronymic', 'passport', 'birthdate', 'address', 'job', 'income', 'phoneNumber', 'active'], 'safe'],
		 ['surname', 'required'], ['name', 'required'], ['patronymic', 'required'], ['passport', 'required'],
		['birthdate', 'required'], ['address', 'required'], ['job', 'required'], ['income', 'required'],['phoneNumber', 'required'], ['active', 'required'],
        ['active','boolean']
		];
    }


}
