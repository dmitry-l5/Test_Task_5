<?php
 
 namespace app\models;
 
 use Yii;
 use yii\db\Query;
 use yii\db\ActiveRecord;
 use app\models\Resume;
 use app\models\Contact;
 use app\models\Specialization;
 
 class Experience extends ActiveRecord{
     
     public function init(){
         /////////////////
         //Это временно))) 
         $result = Yii::$app->db->createCommand('SELECT * FROM experience')->queryAll();
         foreach($result as $row){
             $interval = ($row["end"])?
             ((new \DateTime($row['begin']))->diff(new \DateTime($row['end']))):
                ((new \DateTime($row['begin']))->diff(new \DateTime()));
                $month_full =  $interval->y*12 + $interval->m;
                $id=$row['id'];
                $update = Yii::$app->db->createCommand("update experience set period='$month_full' where id=$id")->execute();
        }
        $res_id = Yii::$app->db->createCommand('select id from resume')->queryAll();
        foreach($res_id as $id){
            $r_id = $id['id'];
            $exps = Yii::$app->db->createCommand("select resume_id, sum(period) as summ from experience where resume_id=$r_id")->queryOne();
            if($exps['resume_id']){
                $sum =  $exps['summ'];
                $id_r=$exps['resume_id'];
                $update = Yii::$app->db->createCommand("update resume set exp_interval='$sum' where id=$id_r")->execute();
            }
        }
        //Это временно))) 
        /////////////////
    }
    public static function tableName(){
        return 'experience';
    }
}