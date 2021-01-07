<?php
 
 namespace app\models;

use yii\db\ActiveRecord;
use app\models\Resume;
use app\models\Schedule_List;

 class Schedule extends ActiveRecord{

    public static function tableName(){
        return 'schedule';
    }
    public function getResume(){
        return $this->hasMany(Resume::className(),['id' => 'resume_id']);
    }
    public function getScheduleTitle(){
        return $this->hasOne(Schedule_List::className(),['id' => 'resume_id']);
    }
 }