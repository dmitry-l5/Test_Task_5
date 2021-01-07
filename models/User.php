<?php
 
 namespace app\models;

use yii\db\ActiveRecord;
use app\models\Resume;
use app\models\Contact;
use app\models\Specialization;

 class User extends ActiveRecord{

    public static function tableName(){
        return 'users';
    }

    // public function getContact(){
    //     return $this->hasOne(Contact::className(),['id' => 'id']);
    // }
    //public function getResumes(){
    //    return $this->hasMany(Resume::className(),['id' => 'user_id']);
    //}

 }