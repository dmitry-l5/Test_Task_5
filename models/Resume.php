<?php
 
 namespace app\models;

use yii\db\ActiveRecord;
use app\models\Resume;
use app\models\Contact;
use app\models\Specialization;
use app\models\User;
use app\models\Experience;
use app\models\AboutMe;

 class Resume extends ActiveRecord{

    public $photo;

    public static function tableName(){
        return 'resume';
    }

    // public function getContact(){
    //     return $this->hasOne(Contact::className(),['id' => 'id']);
    // }
    public function getUser(){
        return $this->hasOne(User::className(),['id' => 'user_id']);
    }
    public function getSpec(){
        return $this->hasOne(Specialization_list::className(),['id' => 'specialization']);
    }
    public function getExperience(){
        return $this->hasMany(Experience::className(),['resume_id' => 'id']);
    }
    public function getEmployment(){
        return $this->hasMany(Employment::className(),['resume_id' => 'id']);
    }
    public function getSchedule(){
        return $this->hasMany(Schedule::className(),['resume_id' => 'id']);
    }
    public function getContact(){
        return $this->hasOne(Contact::className(),['id' => 'id']);
    }
    public function getDescription(){
        return $this->hasOne(AboutMe::className(),['id' => 'id']);
    }

    public function uploadPhoto(){
            $this->photo->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
    }
 }