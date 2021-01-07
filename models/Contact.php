<?php
 
 namespace app\models;

use yii\db\ActiveRecord;
use app\models\Resume;
use app\models\Contact;

 class Contact extends ActiveRecord{

    public static function tableName(){
        return 'contacts';
    }
    public function getResume(){
        return $this->hasOne([Resume::className()],['id' => 'id']);
    }

 }