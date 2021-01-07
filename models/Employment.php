<?php
 
 namespace app\models;

use yii\db\ActiveRecord;
use app\models\Resume;
use app\models\Employment_List;

 class Employment extends ActiveRecord{

    public static function tableName(){
        return 'employment';
    }
    public function getResume(){
        return $this->hasMany(Resume::className(),['id' => 'resume_id']);
    }
    public function getEmploymentTitle(){
        return $this->hasOne(Employment_List::className(),['id' => 'resume_id']);
    }
 }