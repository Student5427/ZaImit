<?php

namespace app\models;

use yii\db\ActiveRecord;

class Workers extends ActiveRecord 
{
    public static function tableName() {
        return 'workers';
    }
	
    public function rules()
    {
	return[[['ID', 'surname', 'name', 'patronymic', 'passport', 'startDate', 'dealsNumber', 'birthDate', 'role'], 'safe'],
		 ['surname', 'required'], ['name', 'required'], ['patronymic', 'required'], ['passport', 'required'],
		['startDate', 'required'], ['dealsNumber', 'required'], ['birthDate', 'required'], ['role', 'required'],
		];
    }


}
