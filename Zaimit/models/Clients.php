<?php

namespace app\models;

use yii\db\ActiveRecord;

class Clients extends ActiveRecord 
{
    public static function tableName() {
        return 'tblClient';
    }

    public function rules()
    {
	return[[['id_client', 'client_surname', 'client_name', 'client_secondname', 'client_passport', 'client_birthday', 'client_adress', 'client_work', 'client_salary', 'client_number'], 'safe'],
		 ['client_surname', 'required'], ['client_name', 'required'], ['client_secondname', 'required'], ['client_passport', 'required'],
		['client_birthday', 'required'], ['client_adress', 'required'], ['client_work', 'required'], ['client_salary', 'required'],['client_number', 'required'],
		['client_birthday', 'required']
		];
    }


}
