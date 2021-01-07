<?php
 
namespace app\models;

use yii\db\ActiveRecord;
use app\models\Resume;
use app\models\Contact;

 class Specialization_list extends ActiveRecord{

    public static function tableName(){
        return 'specialization';
    }

    // public function getContact(){
    //     return $this->hasOne(Contact::className(),['id' => 'id']);
    // }

 }