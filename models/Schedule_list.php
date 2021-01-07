<?php
 
namespace app\models;

use yii\db\ActiveRecord;
use app\models\Resume;

 class Schedule_List extends ActiveRecord{

    public static function tableName(){
        return 'schedule_enum';
    }
    public function getResume(){
        return $this->hasMany(Resume::className(),['resume_id' => 'id']);
    }

 }