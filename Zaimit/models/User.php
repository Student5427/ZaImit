<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\models\Workers;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    public static function tableName() {
        return 'tblAuth';
    }
    
    public function rules(){
        return[[['id_worker', 'auth_login', 'auth_pass'], 'safe'],
        ['id_worker', 'required'], ['auth_login', 'required'], ['auth_pass', 'required']];
    }


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id_worker)
    {
        //return isset(self::$users[$id]) ? new static(self::$users[$id]) : null;
        return static::findOne($id_worker);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        /*foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;*/
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($auth_login)
    {
        return static::findOne (['auth_login' => $auth_login]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id_auth;
    }

    function getWorkerId()
    {
        return $this->id_worker;
    }


    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
       // return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        //return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->auth_pass === ($password);
    }

    public function getWorker(){
        return TblWorker::findOne($this->id_worker);
	}

    public function isAdmin(){

	return TblWorker::findOne($this->id_worker)->is_admin == 1 ? TRUE : FALSE;
	}
}
