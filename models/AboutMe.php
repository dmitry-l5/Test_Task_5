<?php
 
 namespace app\models;

use yii\db\ActiveRecord;
use app\models\Resume;

 class AboutMe extends ActiveRecord{

    public static function tableName(){
        return 'about_me';
    }
    public function getResume(){
        return $this->hasMany(Resume::className(),['id' => 'resume_id']);
    }
 }