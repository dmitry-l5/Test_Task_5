    <div class="content p-rel">
        <?php 
            //var_dump($model);
            //var_dump($spec_enum);
            //(isset($model)&&!empty($model))?(var_dump($model)):("jopa");
            //(isset($post)&&!empty($post))?(var_dump($post)):("jopa");
        ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mt8 mb40"><a href="#"><img src="/images/blue-left-arrow.svg" alt="arrow"> Вернуться без
                        сохранения</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="main-title mb24">Новое резюме</div>
                </div>
            </div>
            <div class="col-12">
                <form action="/resume/edit?id=<?=$model->id?>" method="post">
                    <input type="hidden" name="<?=Yii::$app->request->csrfParam; ?>" value="<?=Yii::$app->request->getCsrfToken(); ?>" />
                    <div class="row mb32">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div  class="paragraph">Фото</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <div class="profile-foto-upload mb8"><img src="/images/users_img/<?=$model->id?>.jpg" alt="foto">
                            </div>
                            <label class="custom-file-upload">
                                <input name="photo" type="file"/>
                                Изменить фото
                            </label>
                        </div>
                    </div>
                    <div class="row mb16">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="paragraph">Фамилия</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <input type="text" class="dor-input w100" name="Surname" value=<?= (isset($model->user->Surname))?($model->user->Surname):(""); ?>>
                        </div>
                    </div>
                    <div class="row mb16">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="paragraph">Имя</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <input type="text" class="dor-input w100" name="Name" value=<?= (isset($model->user->Name))?($model->user->Name):(""); ?>>
                        </div>
                    </div>
                    <div class="row mb16">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="paragraph">Отчество</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <input type="text" class="dor-input w100" name="MiddleName" value=<?= (isset($model->user->MiddleName))?($model->user->MiddleName):(""); ?>>
                        </div>
                    </div>
                    <div class="row mb24">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="paragraph">Дата рождения</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <div class="datepicker-wrap input-group date">
                                <input type="text" class="dor-input dpicker datepicker-input" name="DateOfBirth" value=<?= (isset($model->user->DateOfBirth))?((new DateTime($model->user->DateOfBirth))->format("d.m.Y")):(""); ?>>
                                <img src="/images/mdi_calendar_today.svg" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="row mb16">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="paragraph">Пол</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <ul class="card-ul-radio profile-radio-list">
                                <li>
                                    <input type="radio" id="test1" name="radio-group" value="male" <?= (isset($model->user->Gender_id)&&($model->user->Gender_id == 1))?("checked"):("")?>>
                                    <label for="test1">Мужской</label>
                                </li>
                                <li>
                                    <input type="radio" id="test2" name="radio-group" value="female"  <?= (isset($model->user->Gender_id)&&($model->user->Gender_id == 0))?("checked"):("")?>>
                                    <label for="test2">Женский</label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row mb16">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="paragraph">Город проживания</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <input type="text" class="dor-input w100" name="City" value=<?php if($model->user->City_id){
                                foreach($cities as $city){
                                    if($city["id"] == $model->user->City_id){
                                        echo($city["name"]);
                                    }
                                }
                            }?>>
                        </div>
                    </div>
                    <div class="row mb16">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="heading">Способы связи</div>
                        </div>
                        <div class="col-lg-7 col-10"></div>
                    </div>
                    <div class="row mb24">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="paragraph">Электронная почта</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <div class="p-rel">
                                <input name="email" type="text" class="dor-input w100" value=<?= (isset($model->contact->email))?($model->contact->email):(""); ?>>
                            </div>
                        </div>
                    </div>
                    <div class="row mb32">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="paragraph">Телефон</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <div style="width: 140px;" class="p-rel mobile-w100">
                                <input name="phone" type="text" class="dor-input w100" placeholder="+7 ___ ___-__-__" value=<?= (isset($model->contact->phone))?($model->contact->phone):(""); ?>>
                            </div>
                        </div>
                    </div>
                    <div class="row mb24">
                        <div class="col-12">
                            <div class="heading">Желаемая должность</div>
                        </div>
                    </div>
                    <div class="row mb16">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="paragraph">Специализация</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <div class="citizenship-select">
                                <select class="bug_nselect-1" name="spec" data-title="<?= (isset($model->spec->name))?($model->spec->name):(""); ?>">
                                    <?php foreach($spec_enum as $spec): ?>
                                        <option value="<?= $spec->id ?>"><?= $spec->name ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mb16">
                        <div class="col-lg-2 col-md-3 dflex-acenter">
                            <div class="paragraph">Зарплата</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <div class="p-rel">
                                <input placeholder="От" type="text" class="dor-input w100" name="salary" value=<?= (isset($model->salary))?($model->salary):(""); ?>>
                                <img class="rub-icon" src="/images/rub-icon.svg" alt="rub-icon">
                            </div>
                        </div>
                    </div>
                    <div class="row mb32">
                        <div class="col-lg-2 col-md-3">
                            <div class="paragraph">Занятость</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <div class="profile-info">
                                <div class="form-check d-flex">
                                    <input type="checkbox" name="Employment[]" value="empl_full" class="form-check-input" id="exampleCheck1"
                                        <?php if($model->empl_full){echo("checked");} ?>
                                    >
                                    <label class="form-check-label" for="exampleCheck1"></label>
                                    <label for="exampleCheck1" class="profile-info__check-text job-resolution-checkbox">Полная
                                        занятость</label>
                                </div>
                                <div class="form-check d-flex">
                                    <input type="checkbox" name="Employment[]" value="empl_part" class="form-check-input" id="exampleCheck2"
                                        <?php if($model->empl_part){echo("checked");} ?>
                                    >
                                    <label class="form-check-label" for="exampleCheck2"></label>
                                    <label for="exampleCheck2" class="profile-info__check-text job-resolution-checkbox">Частичная
                                        занятость</label>
                                </div>
                                <div class="form-check d-flex">
                                    <input type="checkbox" name="Employment[]" value="empl_project" class="form-check-input" id="exampleCheck3"
                                        <?php if($model->empl_project){echo("checked");} ?>
                                    >
                                    <label class="form-check-label" for="exampleCheck3"></label>
                                    <label for="exampleCheck3" class="profile-info__check-text job-resolution-checkbox">Проектная/Временная
                                        работа</label>
                                </div>
                                <div class="form-check d-flex">
                                    <input type="checkbox" name="Employment[]" value="empl_volunteering" class="form-check-input" id="exampleCheck4"
                                        <?php if($model->empl_volunteering){echo("checked");} ?>
                                    >
                                    <label class="form-check-label" for="exampleCheck4"></label>
                                    <label for="exampleCheck4" class="profile-info__check-text job-resolution-checkbox">Волонтёрство</label>
                                </div>
                                <div class="form-check d-flex">
                                    <input type="checkbox" name="Employment[]" value="empl_internship" class="form-check-input" id="exampleCheck5"
                                        <?php if($model->empl_internship){echo("checked");} ?>
                                    >
                                    <label class="form-check-label" for="exampleCheck5"></label>
                                    <label for="exampleCheck5" class="profile-info__check-text job-resolution-checkbox">Стажировка</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mb32">
                        <div class="col-lg-2 col-md-3">
                            <div class="paragraph">График работы</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <div class="profile-info">



                                <div class="form-check d-flex">
                                    <input type="checkbox" name="Schedule[]" value="scdl_full" class="form-check-input" id="exampleCheck6"
                                        <?php if($model->scdl_full){echo("checked");} ?>
                                    >
                                    <label class="form-check-label" for="exampleCheck6"></label>
                                    <label for="exampleCheck6" class="profile-info__check-text job-resolution-checkbox">Полный
                                        день</label>
                                </div>
                                <div class="form-check d-flex">
                                    <input type="checkbox" name="Schedule[]" value="scdl_part" class="form-check-input" id="exampleCheck7"
                                        <?php if($model->scdl_part){echo("checked");} ?>
                                    >
                                    <label class="form-check-label" for="exampleCheck7"></label>
                                    <label for="exampleCheck7" class="profile-info__check-text job-resolution-checkbox">Сменный
                                        график</label>
                                </div>
                                <div class="form-check d-flex">
                                    <input type="checkbox" name="Schedule[]" value="scdl_flex" class="form-check-input" id="exampleCheck8"
                                        <?php if($model->scdl_flex){echo("checked");} ?>
                                    >
                                    <label class="form-check-label" for="exampleCheck8"></label>
                                    <label for="exampleCheck8" class="profile-info__check-text job-resolution-checkbox">Гибкий
                                        график</label>
                                </div>
                                <div class="form-check d-flex">
                                    <input type="checkbox" name="Schedule[]" value="scdl_remote" class="form-check-input" id="exampleCheck9"
                                        <?php if($model->scdl_remote){echo("checked");} ?>
                                    >
                                    <label class="form-check-label" for="exampleCheck9"></label>
                                    <label for="exampleCheck9" class="profile-info__check-text job-resolution-checkbox">Удалённая
                                        работа</label>
                                </div>
                                <div class="form-check d-flex">
                                    <input type="checkbox" name="Schedule[]" value="scdl_rotational" class="form-check-input" id="exampleCheck10"
                                        <?php if($model->scdl_rotational){echo("checked");} ?>
                                    >
                                    <label class="form-check-label" for="exampleCheck10"></label>
                                    <label for="exampleCheck10"
                                           class="profile-info__check-text job-resolution-checkbox">Вахтовый
                                        метод</label>
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="row mb32">
                        <div class="col-12">
                            <div class="heading">Опыт работы</div>
                        </div>
                    </div>
                    <div class="row mb32">
                        <div class="col-lg-2 col-md-3">
                            <div class="paragraph">Опыт работы</div>
                        </div>
                        <div class="col-lg-3 col-md-4 col-11">
                            <ul class="card-ul-radio profile-radio-list">
                                <li>
                                    <input type="radio" id="test9131" name="radio-group3123" <?= (isset($model->haveExperience)&&($model->haveExperience == 1))?("checked"):("")?>>
                                    <label for="test9131">Нет опыта работы</label>
                                </li>
                                <li>
                                    <input type="radio" id="test10242" name="radio-group3123" <?= (isset($model->haveExperience)&&($model->haveExperience == 0))?("checked"):("")?>>
                                    <label for="test10242">Есть опыт работы</label>
                                </li>
                            </ul>
                        </div>
                    </div>






                    <?php foreach($model->experience as $exp):?>
                        <input type="hidden" name="experience[<?=$exp->id?>][id]" value="<?=$exp->id?>">
                        <div class="row mb24">
                            <div class="col-lg-2 col-md-3 dflex-acenter">
                                <div class="paragraph">Начало работы</div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-11">
                                <div class="d-flex justify-content-between">
                                    <div class="citizenship-select w100 mr16">
                                        <select name="experience[<?=$exp->id?>][month_begin]" class="bug_nselect-1" >
                                            <option value="01" <?=((new DateTime($exp->begin))->format("m")=="01")?("selected"):(""); ?> >Январь</option>
                                            <option value="02" <?=((new DateTime($exp->begin))->format("m")=="02")?("selected"):(""); ?> >Февраль</option>
                                            <option value="03" <?=((new DateTime($exp->begin))->format("m")=="03")?("selected"):(""); ?> >Март</option>
                                            <option value="04" <?=((new DateTime($exp->begin))->format("m")=="04")?("selected"):(""); ?>  >Апрель</option>
                                            <option value="05" <?=((new DateTime($exp->begin))->format("m")=="05")?("selected"):(""); ?> >Май</option>
                                            <option value="06" <?=((new DateTime($exp->begin))->format("m")=="06")?("selected"):(""); ?> >Июнь</option>
                                            <option value="07" <?=((new DateTime($exp->begin))->format("m")=="07")?("selected"):(""); ?> >Июль</option>
                                            <option value="08" <?=((new DateTime($exp->begin))->format("m")=="08")?("selected"):(""); ?> >Август</option>
                                            <option value="09" <?=((new DateTime($exp->begin))->format("m")=="09")?("selected"):(""); ?> >Сентябрь</option>
                                            <option value="10" <?=((new DateTime($exp->begin))->format("m")=="10")?("selected"):(""); ?> >Октябрь</option>
                                            <option value="11" <?=((new DateTime($exp->begin))->format("m")=="11")?("selected"):(""); ?> >Ноябрь</option>
                                            <option value="12" <?=((new DateTime($exp->begin))->format("m")=="12")?("selected"):(""); ?> >Декабрь</option>
                                        </select>
                                    </div>
                                    <div class="citizenship-select w100">
                                        <input placeholder="1900" type="text" class="dor-input w100" name="experience[<?=$exp->id?>][year_begin]"   
                                            value="<?php echo((int)((new \DateTime($exp->begin))->format("Y")));?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb8">
                            <div class="col-lg-2 col-md-3 dflex-acenter">
                                <div class="paragraph">Окончание работы</div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-11">
                                <div class="d-flex justify-content-between">
                                    <div class="citizenship-select w100 mr16">
                                        <select name="experience[<?=$exp->id?>][month_end]"  class="bug_nselect-1" data-title="Март" >
                                            <option value="01" <?=((new \DateTime($exp->end))->format("m")=="01")?("selected"):(""); ?> >Январь</option>
                                            <option value="02" <?=((new \DateTime($exp->end))->format("m")=="02")?("selected"):(""); ?> >Февраль</option>
                                            <option value="03" <?=((new \DateTime($exp->end))->format("m")=="03")?("selected"):(""); ?> >Март</option>
                                            <option value="04" <?=((new \DateTime($exp->end))->format("m")=="04")?("selected"):(""); ?>  >Апрель</option>
                                            <option value="05" <?=((new \DateTime($exp->end))->format("m")=="05")?("selected"):(""); ?> >Май</option>
                                            <option value="06" <?=((new \DateTime($exp->end))->format("m")=="06")?("selected"):(""); ?> >Июнь</option>
                                            <option value="07" <?=((new \DateTime($exp->end))->format("m")=="07")?("selected"):(""); ?> >Июль</option>
                                            <option value="08" <?=((new \DateTime($exp->end))->format("m")=="08")?("selected"):(""); ?> >Август</option>
                                            <option value="09" <?=((new \DateTime($exp->end))->format("m")=="09")?("selected"):(""); ?> >Сентябрь</option>
                                            <option value="10" <?=((new \DateTime($exp->end))->format("m")=="10")?("selected"):(""); ?> >Октябрь</option>
                                            <option value="11" <?=((new \DateTime($exp->end))->format("m")=="11")?("selected"):(""); ?> >Ноябрь</option>
                                            <option value="12" <?=((new \DateTime($exp->end))->format("m")=="12")?("selected"):(""); ?> >Декабрь</option>
                                        </select>
                                    </div>
                                    <div class="citizenship-select w100">
                                        <input name="experience[<?=$exp->id?>][year_end]"  placeholder="1900" type="number" class="dor-input w100" 
                                            value="<?php if(!empty($exp->end)){echo((int)((new \DateTime($exp->end))->format("Y")));}?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb32">
                            <div class="col-lg-2 col-md-3">
                            </div>
                            <div class="col-lg-3 col-md-4 col-11">
                                <div class="profile-info">
                                    <div class="form-check d-flex">
                                        <input name="experience[<?=$exp->id?>][now]" type="checkbox" class="form-check-input" id="exampleCheck111" <?=(!($exp->end))?("checked"):(""); ?>>
                                        <label class="form-check-label" for="exampleCheck111"></label>
                                        <label for="exampleCheck111" class="profile-info__check-text job-resolution-checkbox">
                                               По настоящее время
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mb16">
                            <div class="col-lg-2 col-md-3 dflex-acenter">
                                <div class="paragraph">Организация</div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-11">
                                <input name="experience[<?=$exp->id?>][institution]" type="text" class="dor-input w100" value="<?=$exp->institution?>">
                            </div>
                        </div>
                        <div class="row mb16">
                            <div class="col-lg-2 col-md-3 dflex-acenter">
                                <div class="paragraph">Должность</div>
                            </div>
                            <div class="col-lg-3 col-md-4 col-11">
                                <input name="experience[<?=$exp->id?>][position]" type="text" class="dor-input w100"  value="<?=$exp->position?>">
                            </div>
                        </div>
                        <div class="row mb16">
                            <div class="col-lg-2 col-md-3">
                                <div class="paragraph">Обязанности, функции, достижения</div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12">
                                <textarea name="experience[<?=$exp->id?>][about]" class="dor-input w100 h96 mb8"
                                          placeholder="Расскажите о своих обязанностях, функциях и достижениях"
                                          ><?= $exp->about?></textarea>
                                <div><a href="/resume/delete_exp?r_id=<?=$model->id?>&e_id=<?=$exp->id?>">Удалить место работы</a></div>
                            </div>
                        </div>
                    <?php endforeach;?>


                    <div class="row mb64 mobile-mb32">
                        <div class="col-lg-2 col-md-3">
                        </div>
                        <div class="col-lg-4 col-md-6 col-12">
                           <div>
                               <a href="/resume/add_exp?r_id=<?=$model->id?>">+ Добавить место работы</a>
                            </div>
                        </div>
                    </div>
                    <div class="row mb32">
                        <div class="col-12">
                            <div class="heading">Расскажите о себе</div>
                        </div>
                    </div>
                    <div class="row mb64 mobile-mb32">
                        <div class="col-lg-2 col-md-3">
                            <div class="paragraph">О себе</div>
                        </div>
                        <div class="col-lg-5 col-md-7 col-12">
                            <textarea name="about_me" class="dor-input w100 h176 mb8"><?php if(isset($model->about_me)){
                                    echo($model->about_me);
                                }?></textarea>
                        </div>
                    </div>
                    <div class="row mb128 mobile-mb64">
                        <div class="col-lg-2 col-md-3">
                            </div>
                            <div class="col-lg-10 col-md-9">
                            <!--a href="/resume/create" class="orange-btn link-orange-btn">Сохранить</a-->
                            <button type="submit" class="orange-btn link-orange-btn" name='save_form'>Сохранить</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

