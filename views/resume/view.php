    <div class="content p-rel">
        <?php 
            //var_dump($model);
        ?>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="mt8 mb32"><a href="#"><img src="/images/blue-left-arrow.svg" alt="arrow"> Резюме в
                        Кемерово</a>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-5 mobile-mb32">
                    <div class="profile-foto resume-profile-foto"><img src="/images/profile-foto.jpg" alt="profile-foto">
                    </div>
                </div>
                <div class="col-lg-8 col-md-7">
                    <div class="main-title d-md-flex justify-content-between align-items-center mobile-mb16">
                        <?= $model->spec->name?>
                    </div>
                    <div class="paragraph-lead mb16">
                        <span class="mr24"><?= $model["salary"]?> ₽</span>
                        <span>Опыт работы 3 года</span>
                    </div>
                    <div class="profile-info company-profile-info resume-view__info-blick">
                        <div class="profile-info__block company-profile-info__block mb8">
                            <div class="profile-info__block-left company-profile-info__block-left">Имя
                            </div>
                            <div class="profile-info__block-right company-profile-info__block-right">
                                <?= $model->user->Name ?>
                                <?= $model->user->Surname ?>
                                <?= $model->user->MiddleName ?>
                            </div>
                        </div>
                        <div class="profile-info__block company-profile-info__block mb8">
                            <div class="profile-info__block-left company-profile-info__block-left">Возраст
                            </div>
                            <div class="profile-info__block-right company-profile-info__block-right">
                                <?php 
                                    $interval = (new DateTime($model->user->DateOfBirth))->diff(new DateTime());
                                    echo $interval->format('%Y');
                                ?> года</div>
                        </div>
                        <div class="profile-info__block company-profile-info__block mb8">
                            <div class="profile-info__block-left company-profile-info__block-left">Занятость</div>
                            <div class="profile-info__block-right company-profile-info__block-right">
                                <span><?=$model->empl_full?"полная":""?></span>
                                <span><?=$model->empl_part?"частичная":""?></span>
                                <span><?=$model->empl_project?"проектная работа":""?></span>
                                <span><?=$model->empl_internship?"стажировка":""?></span>
                                <span><?=$model->empl_volunteering?"волонтёрство":""?></span>
                            </div>
                        </div>
                        <div class="profile-info__block company-profile-info__block mb8">
                            <div class="profile-info__block-left company-profile-info__block-left">График работы
                            </div>
                            <div class="profile-info__block-right company-profile-info__block-right">
                                <span><?=$model->scdl_full?"Полный день":""?></span>
                                <span><?=$model->scdl_part?"Сменный график":""?></span>
                                <span><?=$model->scdl_rotational?"Вахтовый метод":""?></span>
                                <span><?=$model->scdl_flex?"Гибкий график":""?></span>
                                <span><?=$model->scdl_remote?"Удалённая работа":""?></span>
                            </div>
                        </div>
                        <div class="profile-info__block company-profile-info__block mb8">
                            <div class="profile-info__block-left company-profile-info__block-left">Город проживания
                            </div>
                            <div class="profile-info__block-right company-profile-info__block-right">
                                <?php foreach($cities as $city){if($city['id']==$model->user->City_id){echo($city['name']);break;}}?>
                            </div>
                        </div>
                        <div class="profile-info__block company-profile-info__block mb8">
                            <div class="profile-info__block-left company-profile-info__block-left">
                                Электронная почта
                                <br>

                            </div>
                            <div class="profile-info__block-right company-profile-info__block-right"><a
                                    href="#">
                                        <?php if(!empty($model->contact && !empty($model->contact->email))):?>
                                            <?= $model->contact->email;?>
                                        <?php endif?>
                                    </a></div>
                        </div>
                        <div class="profile-info__block company-profile-info__block mb8">
                            <div class="profile-info__block-left company-profile-info__block-left">
                                Телефон
                            </div>
                            <div class="profile-info__block-right company-profile-info__block-right"><a
                                    href="#">+
                                        <?php if(!empty($model->contact && !empty($model->contact->phone))):?>
                                            <?= $model->contact->phone;?>
                                        <?php endif?>
                                    </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="devide-border mb32 mt50"></div>
                    <div class="tabs mb50">
                        <div class="tabs__content active">
                            <div class="row">
                                <div class="col-lg-10">
                                    <div class="row mb16">
                                        <div class="col-lg-12"><h3 class="heading mb16">Опыт работы 13 лет и 11 месяцев</h3></div>
                                    </div>
                                    <?php foreach($model->experience as $exp): ?>
                                        <div class="row mb16">
                                            <div class="col-md-4 mb16">
                                                <div class="paragraph tbold mb8">
                                                    <?= $exp->begin?>
                                                    -
                                                    <?= $exp->end?$exp->end:" по настоящее время" ?>
                                                </div>
                                                <div class="mini-paragraph">
                                                    <?=   $exp->end?
                                                        ((new DateTime($exp->end))->diff(new DateTime($exp->begin))->format("%Y лет %M месяцев ")):
                                                        ((new DateTime())->diff(new DateTime($exp->begin))->format("%Y лет %M месяцев ")); ?>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="paragraph tbold mb8">
                                                    <?= $exp->institution?>
                                                </div>
                                                <div class="paragraph tbold mb8">
                                                    <?= $exp->position?>
                                                </div>
                                                <div class="paragraph">
                                                    <?= $exp->about?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach?>
                                </div>
                                <div class="col-lg-7">
                                    <?php if(!empty($model->description) && !empty($model->description->text) ): ?>
                                        <div class="company-profile-text mb64">
                                            <h3 class="heading mb16">Обо мне</h3>
                                            <p>
                                                <?= $model->description->text; ?>
                                            </p>
                                        </div>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>