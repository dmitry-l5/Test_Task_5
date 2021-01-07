<?php
 
 namespace app\models;

use yii\db\ActiveRecord;
use app\models\Resume;

 class Employment_List extends ActiveRecord{

    public static function tableName(){
        return 'employment_enum';
    }
    public function getResume(){
        return $this->hasMany(Resume::className(),['resume_id' => 'id']);
    }

 }