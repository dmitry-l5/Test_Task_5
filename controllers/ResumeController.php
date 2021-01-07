<?php

namespace app\controllers;

use Yii;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Resume;
use app\models\User;
use app\models\Contact;
use app\models\Specialization_list;
use app\models\Employment;
use app\models\Employment_List;
use app\models\Schedule;
use app\models\Schedule_List;
use app\models\Experience;
use yii\web\UploadedFile;


class ResumeController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex(){
         $this->redirect(['/resume/list']);
    }
    public function actionList(){
        $filter_view = array();
        $g_request = Yii::$app->request;
        $query = new Query();
        $select_str = "resume.id, specialization as spec, specialization.name as spec_name, salary, user_id, DateOfBirth, City_id, Gender_id ";
        $query->leftJoin('users', 'users.id=resume.user_id');
        $query->leftJoin('specialization', 'resume.specialization=specialization.id');
        //$query->leftJoin('experience', 'experience.resume_id=resume.id');
        //$select_str .= ", employment.enum_id as empl_enum_id";
        //$query->innerJoin('employment', 'employment.resume_id=resume.id');
        if(
            $g_request->get('min_age')
            ){
                $age = $g_request->get('min_age');
                $filter_view['min_age'] = $age;
                $now = new \DateTime();
                $now->sub(new \DateInterval("P".($age+1)."Y"));
                $DateOfBirth = $now->format("Y-m-d");

                $query->andWhere(["<", "users.DateOfBirth" ,$DateOfBirth]);
        }
        if(
            $g_request->get('max_age')
            ){
                $age = $g_request->get('max_age');
                $filter_view['max_age'] = $age;
                $now = new \DateTime();
                $now->sub(new \DateInterval("P".($age+1)."Y"));
                $DateOfBirth = $now->format("Y-m-d");

                $query->andWhere([">", "users.DateOfBirth", $DateOfBirth]);
        }
        if(
            $g_request->get('salary')
            ){
                $salary = (int)$g_request->get('salary');
                if($salary){
                    $filter_view["salary"] = $salary;
                    $query->andWhere([">", "resume.salary" ,$salary]);
                }
        }
        if(
            $g_request->get('city')
            ){
                $city = (int)$g_request->get('city');
                if($city){
                    $filter_view["city"] = $city;
                    $query->andWhere(["=", "users.City_id" ,$city]);
                }
        }
        if(
            $g_request->get('exp_without')||
            $g_request->get('exp_1to3')||
            $g_request->get('exp_3to6')||
            $g_request->get('exp_morethen6')
            ){
                if($g_request->get('exp_without')){
                    $filter_view['exp_without'] = true;
                    $query->andWhere([">=", "resume.exp_interval" ,0]);
                }
                if($g_request->get('exp_1to3')){
                    $filter_view['exp_1to3'] = true;
                    $query->andWhere([">=", "resume.exp_interval" ,1*12]);
                    $query->andWhere(["<=", "resume.exp_interval" ,3*12]);
                }
                if($g_request->get('exp_3to6')){
                    $filter_view['exp_3to6'] = true;
                    $query->andWhere([">=", "resume.exp_interval" ,3*12]);
                    $query->andWhere(["<=", "resume.exp_interval" ,6*12]);
                }
                if($g_request->get('exp_morethen6')){
                    $filter_view['exp_morethen6'] = true;
                    $query->andWhere([">=", "resume.exp_interval" ,6*12]);
                }
        }
        if($g_request->get('empl_full')){
            $query->andWhere(["=", "resume.empl_full" ,true]);
            $filter_view['empl_full']=true;
        }
        if($g_request->get('empl_part')){
            $query->andWhere(["=", "resume.empl_part" ,true]);
            $filter_view['empl_part']=true;
        }
        if($g_request->get('empl_project')){
            $query->andWhere(["=", "resume.empl_project" ,true]);
            $filter_view['empl_project']=true;
        }
        if($g_request->get('empl_internship')){
            $query->andWhere(["=", "resume.empl_internship" ,true]);
            $filter_view['empl_internship']=true;
        }
        if($g_request->get('empl_volunteering')){
            $query->andWhere(["=", "resume.empl_volunteering" ,true]);
            $filter_view['empl_volunteering']=true;
        }
        if($g_request->get('scdl_full')){
            $query->andWhere(["=", "resume.scdl_full" ,true]);
            $filter_view['scdl_full']=true;
        }
        if($g_request->get('scdl_part')){
            $query->andWhere(["=", "resume.scdl_part" ,true]);
            $filter_view['scdl_part']=true;
        }
        if($g_request->get('scdl_rotational')){
            $query->andWhere(["=", "resume.scdl_rotational" ,true]);
            $filter_view['scdl_rotational']=true;
        }
        if($g_request->get('scdl_flex')){
            $query->andWhere(["=", "resume.scdl_flex" ,true]);
            $filter_view['scdl_flex']=true;
        }
        if($g_request->get('scdl_remote')){
            $query->andWhere(["=", "resume.scdl_remote" ,true]);
            $filter_view['scdl_remote']=true;
        }
        if($g_request->get('spec')){
            $spec_id = (int)$g_request->get('spec');
            if($spec_id){
                $filter_view['spec'] = $spec_id;
                $query->andWhere(["=", "resume.specialization" ,$spec_id]);
            }
        }
        if($g_request->get('gender')){
            switch($g_request->get('gender')){
                case 'all':
                    $filter_view['gender']='all';
                break;
                case 'male':
                    $query->andWhere(["=", "users.Gender_id" ,'1']);
                    $filter_view['gender']='male';
                break;
                case 'female':
                    $filter_view['gender']='female';
                    $query->andWhere(["=", "users.Gender_id" ,'0']);
                break;
                default:
                    $filter_view['gender']='all';
                    break;
            }
        }

        if($g_request->get('sort')){
            $sort = $g_request->get('sort');
            $filter_view['sort'] = $sort;
            switch($sort){
                case "new_desc":
                    $query->orderBy([
                        'salary' => SORT_ASC,
                    ]);
                    break;
                case "salary_asc":
                    $query->orderBy([
                        'salary' => SORT_ASC,
                    ]);
                    break;
                case "salary_desc":
                    $query->orderBy([
                        'salary' => SORT_DESC,
                    ]);
                    break;
                default:
                    //$filter_view['sort'] = 'new_desc';
                    break;
            }
        }
        $limit = 3;
        $offset = 0;
        $page = 1;
        if($g_request->get('page')){
            $page = (int)$g_request->get('page');
            $offset = ($page - 1)*$limit;
        }
        $query->select($select_str);
        $query->from('resume');
        $rows_count = $query->count();
        $page_count = ceil($rows_count/$limit);
        $query->select($select_str);
        $query->limit($limit);
        $query->offset($offset);
        $query->from('resume');
        $model = $query->all();


        $current_page = $page;
        $cities = Yii::$app->db->createCommand('SELECT * FROM cities')->queryAll();
        $spec_list = Yii::$app->db->createCommand('SELECT * FROM specialization')->queryAll();
        $indexer = array(
            "current" => $current_page,
            "count" => $page_count,
            "resume_count" => $rows_count,
        );
        return $this->render('list', [
            'model' => $model, 
            'cities' => $cities,
            'spec_list' => $spec_list,
            'filter_view' => $filter_view,
            'indices' => $indexer,
            ]);
    }


    public function actionMy($id = null){
        $model = Resume::find()->where(["user_id" => $id])->all();
        $this->view->title = "my resume";
        return $this->render('my', ['model' => $model]);
    }
    public function actionChangePhoto($resume_id = -1){
        $r_model = Resume::find()->
            where(["id" => $resume_id])->
            one();
        $r_model->photo = UploadedFile::getInstance($r_model, 'photo');
        return $this->redirect(['/resume/edit?id='.$resume_id]);
    }
    private function save($resume_id = -1, $post_arr, $model = null){
        // var_dump($post_arr);
        // die;
        $model = Resume::find()->
        with([
            'user', 
            'spec', 
            'experience' => function($query){
                $query->orderBy(['begin'  => SORT_DESC]);
            },
            'contact']
        )->
        where(["id" => $resume_id])->
        one();
        $city_id = null;
        if(!empty($post_arr["City"])){
            $city_query = new Query();
            $city_row = $city_query->from("cities")->where(["name" => trim($post_arr["City"])])->one();
            if(!$city_row){
                $add_city_query = new Query();
                $add_city_query->createCommand()->insert("cities", ["name" => trim($post_arr["City"])])->execute();
                $city_row = $city_query->from("cities")->where(["name" => trim($post_arr["City"])])->one();
            }
            $city_id = $city_row['id'];
        }
        $user = User::find()->where(["id" => $model->user_id ])->one();
        if($user){
            $user->Name = $post_arr["Name"];
            $user->Surname =  $post_arr["Surname"];
            $user->MiddleName =  $post_arr["MiddleName"];
            $user->DateOfBirth = (new \DateTime($post_arr["DateOfBirth"]))->format("Y-m-d");
            $user->Gender_id = (isset($post_arr["radio-group"]))?(($post_arr["radio-group"]=="male")?(1):(0)):(-1);
            $user->City_id = $city_id;
            //$user->City = $post_arr["City"];
            $user->save();
        }
        if(isset($post_arr['about_me'])){
            $model->about_me = $post_arr['about_me'];
        }
        $contact = Contact::find()->where(["id" => $model->id ])->one();
        if(!$contact){
            $contact = new Contact();
            $contact->user_id = $model->user_id;
            $contact->id = $model->id;
        }
        if($contact){
            if(isset($post_arr['phone'])){$contact->phone = $post_arr['phone'];}
            if(isset($post_arr['email'])){ $contact->email = $post_arr['email'];}
            $contact->save();
        }

        //Empoyment begin
        if(isset($post_arr['Employment'])){
            $empl_post_arr = $post_arr['Employment'];
            if(in_array("empl_full", $empl_post_arr)){
                $model->empl_full = true;
            }else{
                $model->empl_full = false;
            }
            if(in_array("empl_part", $empl_post_arr)){
                $model->empl_part = true;
            }else{
                $model->empl_part = false;
            }
            if(in_array("empl_project", $empl_post_arr)){
                $model->empl_project = true;
            }else{
                $model->empl_project = false;
            }
            if(in_array("empl_volunteering", $empl_post_arr)){
                $model->empl_volunteering = true;
            }else{
                $model->empl_volunteering = false;
            }
            if(in_array("empl_internship", $empl_post_arr)){
                $model->empl_internship = true;
            }else{
                $model->empl_internship = false;
            }
        }
        else{
            $model->empl_full = false;
            $model->empl_part = false;
            $model->empl_project = false;
            $model->empl_volunteering = false;
            $model->empl_internship = false;
        }
         //Empoyment end
        
        //Schedule begin
        if(isset($post_arr['Schedule'])){
            $scdl_post_arr = $post_arr['Schedule'];
            if(in_array("scdl_full", $scdl_post_arr)){
                $model->scdl_full = true;
            }else{
                $model->scdl_full = false;
            }
            if(in_array("scdl_part", $scdl_post_arr)){
                $model->scdl_part = true;
            }else{
                $model->scdl_part = false;
            }
            if(in_array("scdl_flex", $scdl_post_arr)){
                $model->scdl_flex = true;
            }else{
                $model->scdl_flex = false;
            }
            if(in_array("scdl_remote", $scdl_post_arr)){
                $model->scdl_remote = true;
            }else{
                $model->scdl_remote = false;
            }
            if(in_array("scdl_rotational", $scdl_post_arr)){
                $model->scdl_rotational = true;
            }else{
                $model->scdl_rotational = false;
            }
        }else{
            $model->scdl_full = false;
            $model->scdl_part = false;
            $model->scdl_flex = false;
            $model->scdl_remote = false;
            $model->scdl_rotational = false;
        }
        //Schedule end

        //experiance begin
        if(isset($post_arr['experience'])){
            foreach($post_arr['experience'] as $exp){
                
                $row = Experience::find()->where(['id' => $exp['id']])->one();
                if($row){
                    $row->resume_id = $resume_id;
                    if(
                        isset($exp['year_begin']) && isset($exp['month_begin']) &&
                        !empty($exp['year_begin']) && !empty($exp['month_begin'])
                        ){
                            $row->begin = (new \DateTime($exp['year_begin']."-".$exp['month_begin']."-01"))->format('Y-m-d');
                        }
                    if(
                        isset($exp['year_end']) && isset($exp['month_end']) &&
                        !empty($exp['year_end']) && !empty($exp['month_end'])
                        ){
                        $row->end = (new \DateTime($exp['year_end']."-".$exp['month_end']."-01"))->format('Y-m-d');
                    }
                    $row->now =         (isset($exp['now']))?(1):(0);
                    $row->institution = (isset($exp['institution']))?($exp['institution']):("");
                    $row->position =    (isset($exp['position']))?($exp['position']):("");
                    $row->about =       (isset($exp['about']))?($exp['about']):("");
                    $row->save();
                }
            }
        }
        //experiance end


        if(isset( $post_arr["spec"])){
            $model->specialization = $post_arr["spec"];
        }
        $model->salary = $post_arr["salary"];
        $model->last_update = (new \DateTime())->format("Y-m-d h:i:s");
        $model->save();
    }
    public function actionEdit($id = -1){
        $post = Yii::$app->request->post();
        $model = Resume::findOne($id);//new Resume();
        if($model){
            $spec_enum = Specialization_list::find()->all(); 

            $model = Resume::find()->
                with([
                    'user', 
                    'spec', 
                    'experience' => function($query){
                        $query->orderBy(['begin'  => SORT_DESC]);
                    },
                    'contact']
                )->
                where(["id" => $id])->
                one();
            //$user->Name = 'Имя';
            // $user->Surname = 'Фамилия';
            // $user->MiddleName = 'Отчество';
            // $contact = new Contact();
            // $contact->phone = '55593000';
            // $user->link('contact', $contact);
            //$model->save();
            //$model = Resume::findOne($id);//new Resume();
            if(isset($post["save_form"])){
                $this->save($id, $post);
                // echo("_FILES = ");
                // var_dump($_FILES);
                // echo("<br>");
                // echo("<br>");
                // echo("_POST = ");
                // var_dump($_POST);
                // echo("<br>");
                // echo("<br>");
                // echo("_GET = ");
                // var_dump($_GET);
                // echo("<br>");
                // die();
                return $this->redirect(['/resume/edit?id='.$id]);
            }else{

            }
            $cities_list = (new Query)->from("cities")->all();
            return $this->render('edit', ["method"=>__METHOD__, "post_qwer" => $id, 
                'model'=>$model, 
                'spec_enum' => $spec_enum, 
                'post' => $post,
                'cities' => $cities_list,
                ]);
        }else{
            $model = new Resume();
        }
        //model get data
    }
    public function actionDelete($id = -1){
        $resume = Yii::$app->db->createCommand("SELECT * FROM `resume` WHERE `id`=$id")->queryOne();
        if($resume && isset($resume['user_id'])){
            $user_id = (int)$resume['user_id'];
            $resume_id = (int)$resume['id'];
            $similar_resumes = Yii::$app->db->createCommand("SELECT * FROM `resume` WHERE user_id=$user_id  AND id!=$resume_id")->queryAll();
            if(count($similar_resumes)==0){
                $users = Yii::$app->db->createCommand("SELECT * FROM `users` WHERE id=$user_id")->queryOne();
                if($users){
                    Yii::$app->db->createCommand("DELETE FROM `users` WHERE id=$user_id")->execute();
                }
            }
            $experience = Yii::$app->db->createCommand("SELECT * FROM `experience` WHERE resume_id=$resume_id")->queryAll();
            if($experience){
                Yii::$app->db->createCommand("DELETE FROM `experience` WHERE resume_id=$resume_id")->execute();
            }
            $contacts = Yii::$app->db->createCommand("SELECT * FROM `contacts` WHERE id=$resume_id")->queryOne();
            if($contacts){
                Yii::$app->db->createCommand("DELETE FROM `contacts` WHERE id=$resume_id")->execute();
            }
            Yii::$app->db->createCommand("DELETE FROM `resume` WHERE id=$resume_id")->execute();
            $this->redirect(['/resume/my?id='.$user_id]);
        }else{
            echo("Резюме не найдено."); 
            exit;
        }
        
    }
    public function actionCreate($user_id = -1){
        $model = new Resume();
        $model->user_id = $user_id;
        $user = Yii::$app->db->createCommand("SELECT * FROM `users` WHERE id=$user_id")->queryOne();
        if(!$user){
            Yii::$app->db->createCommand("INSERT INTO `users` (id) VALUES ($user_id)")->execute();
            $user = Yii::$app->db->createCommand("SELECT * FROM `users` WHERE id=$user_id")->queryOne();
        }
        $model->exp_interval = 0;
        $model->save();
        $contacts = Contact::find($model->id)->one();
        if(!$contacts){
            $contact = new Contact();
            $contact->id = $model->id;
            $contact->save();
        }
        $this->redirect(['/resume/my?id='.$user_id]);
    }
    public function actionDelete_exp($r_id = -1, $e_id = -1){
        //echo("r_id = $r_id<br>");
        //echo("e_id = $e_id<br>");
        //exit;
        $exp_row=Experience::find()->where(['id'=> $e_id])->one();
        if($exp_row){
            $exp_row->delete();
        }
        $this->redirect(['/resume/edit?id='.$r_id]);
    }
    public function actionAdd_exp($r_id = -1){
        //echo("r_id = $r_id<br>");
        //exit;
        
        $exp_row = new Experience();
        if($r_id>=0){
            if($exp_row){
                $exp_row->resume_id = $r_id;
                $exp_row->begin = (new \DateTime())->format("Y-m-d");
                $exp_row->save();
            }else{
                var_dump($exp_row );
                exit;
            }
        }
        $this->redirect(['/resume/edit?id='.$r_id]);
    }
    public function actionView($id = 5){
        $cities = Yii::$app->db->createCommand('SELECT * FROM cities')->queryAll();
        $model = Resume::find()->
            with([
                'user', 
                'spec', 
                'experience' => function($query){
                    $query->orderBy(['begin'  => SORT_DESC]);
                },
                'contact']
        )->where(["id" => $id])->one();
        return $this->render('view', 
            [
                'model' => $model,
                'cities' => $cities,
            ]);
    }

}
