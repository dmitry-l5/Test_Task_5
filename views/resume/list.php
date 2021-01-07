<?php //var_dump($model) ?>
<div class="header-search">
        <div class="container">
            <div class="header-search__wrap">
                <form class="header-search__form">
                    <a href="#"><img src="/images/dark-search.svg" alt="search"
                                     class="dark-search-icon header-search__icon"></a>
                    <input class="header-search__input" type="text" placeholder="Поиск по резюме и навыкам">
                    <button type="button" class="blue-btn header-search__btn">Найти</button>
                </form>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container">
            <h1 class="main-title mt24 mb16">PHP разработчики в Кемерово</h1>
            <button class="vacancy-filter-btn">Фильтр</button>
            <div class="row">
                <div class="col-lg-9 desctop-992-pr-16">
                    <div class="d-flex align-items-center flex-wrap mb8">
                        <span class="paragraph mr16">Найдено <?=$indices["resume_count"]?> резюме</span>
                        <div class="vakancy-page-header-dropdowns">
                            <div class="vakancy-page-wrap show mr16">
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a class="dropdown-item" href="#">За день</a>
                                    <a class="dropdown-item" href="#">За год</a>
                                    <a class="dropdown-item" href="#">За все время</a>
                                </div>
                            </div>
                            <div class="vakancy-page-wrap show">
                                <a class="vakancy-page-btn vakancy-btn dropdown-toggle" href="#" role="button"
                                   id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                   aria-expanded="false">
                                    <?php
                                        if(isset($filter_view['sort'])){
                                            switch($filter_view['sort']){
                                                case "new_desc":
                                                    echo("По новизне");
                                                    break;
                                                case "salary_asc":
                                                    echo("По возрастанию зарплаты");
                                                    break;
                                                case "salary_desc":
                                                    echo("По убыванию зарплаты");
                                                    break;
                                                default:
                                                    echo("По новизне");
                                                    break;
                                            }
                                        }else{echo("По новизне");}
                                    ?>
                                    <i class="fas fa-angle-<?=(isset($filter_view['sort'])&&($filter_view['sort'] == 'salary_asc'))?'up':'down'?> arrowDown"></i>
                                </a>
                                
                                <script>
                                    function writeToHidden_sort(event){
                                        event.preventDefault();
                                        sort_input.value = event.target.getAttribute("value");
                                        sort_input.dispatchEvent(new Event('change', {bubbles: true}));
                                    }
                                </script>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                    <a onclick="writeToHidden_sort(event)" name="sort_salary_" value="new_desc" class="dropdown-item" href="#">По новизне</a>
                                    <a onclick="writeToHidden_sort(event)" name="sort_salary_" value="salary_asc" class="dropdown-item" href="#">По возрастанию зарплаты</a>
                                    <a onclick="writeToHidden_sort(event)" name="sort_salary_" value="salary_desc" class="dropdown-item" href="#">По убыванию зарплаты</a>
                                </div>
                            </div>
                        </div>
                    </div>


                    <?php foreach($model as $key => $value): ?>
                        <a href="/resume/view?id=<?=$value['id']?>" style="text-decoration:none">
                            <div class="vakancy-page-block company-list-search__block resume-list__block p-rel mb16">
                                <?php //var_dump($value);exit;?>
                                <div class="company-list-search__block-left">
                                    <div class="resume-list__block-img mb8">
                                        <img src="/images/profile-foto.jpg" alt="profile">
                                    </div>
                                </div>
                                <div class="company-list-search__block-right">
                                    <div class="mini-paragraph cadet-blue mobile-mb12">Обновлено 1 апреля 2020 в 15:00</div>
                                    <h3 class="mini-title mobile-off"><?= $value['spec_name']?></h3>
                                    <div class="d-flex align-items-center flex-wrap mb8 ">
                                        <span class="mr16 paragraph"><?= $value["salary"]?> ₽</span>
                                        <span class="mr16 paragraph">Опыт работы 3 года</span>
                                        <span class="mr16 paragraph">
                                            <?php 
                                                $interval = (new DateTime($value['DateOfBirth']))->diff(new DateTime());
                                                echo $interval->format('%Y');
                                                ?> лет
                                        </span>
                                        <span class="mr16 paragraph"><?php foreach($cities as $city){if($city['id']==$value['City_id']){echo($city['name']);break;}}?></span>
                                    </div>
                                    <p class="paragraph tbold mobile-off">Последнее место работы</p>
                                </div>
                                <div class="company-list-search__block-middle">
                                    <h3 class="mini-title desktop-off">PHP разработчик</h3>
                                    <p class="paragraph mb16 mobile-mb32">
                                        <?=(isset($value->experience[0]))?($value->experience[0]->position):("null!");?> в 
                                        <?=(isset($value->experience[0]))?($value->experience[0]->institution):("null!");?> ,
                                        <?=(isset($value->experience[0]))?($value->experience[0]->begin):("null!");?>
                                        <?=(isset($value->experience[0]))?($value->experience[0]->now):("null!");?>
                                        <?php 
                                            if(isset($value->experience[0]) && $value->experience[0]->end){
                                                echo(" - ".$value->experience[0]->end);
                                            }else{
                                                echo(' - по настоящее время');
                                            }
                                            ?>
                                    </p>
                                </div>
                            </div>
                        </a>
                    <?php endforeach;?>
<!--
                    <div class="vakancy-page-block company-list-search__block resume-list__block p-rel mb16">
                        <div class="company-list-search__block-left">
                            <div class="resume-list__block-img mb8">
                                <img src="/images/profile-foto.jpg" alt="profile">
                            </div>
                        </div>
                        <div class="company-list-search__block-right">
                            <div class="mini-paragraph cadet-blue mobile-mb12">Обновлено 1 апреля 2020 в 15:00</div>
                            <h3 class="mini-title mobile-off">PHP разработчик</h3>
                            <div class="d-flex align-items-center flex-wrap mb8 ">
                                <span class="mr16 paragraph">120 000 ₽</span>
                                <span class="mr16 paragraph">Опыт работы 3 года</span>
                                <span class="mr16 paragraph">43 года</span>
                                <span class="mr16 paragraph">Кемерово</span>
                            </div>
                            <p class="paragraph tbold mobile-off">Последнее место работы</p>
                        </div>
                        <div class="company-list-search__block-middle">
                            <h3 class="mini-title desktop-off">PHP разработчик</h3>
                            <p class="paragraph mb16 mobile-mb32">Младший PHP разработчик в ООО «ТЕПЛОВОЕ
                                ОБОРУДОВАНИЕ»,
                                Октябрь 2010 — по настоящее время </p>
                        </div>
                    </div>
-->
                    <script>
                        function writeToHidden_page(event){
                            event.preventDefault();
                            page_input.value = event.target.getAttribute("value");
                            page_input.dispatchEvent(new Event('change', {bubbles: true}));
                        }
                    </script>
                    <ul id="page_index" use_as="indices" class="dor-pagination mb128" >
                        <li onclick="writeToHidden_page(event)" name="page" value="prev" class="page-link-prev"><a href="#" style="pointer-events: none;"><img class="mr8"
                            src="/images/mini-left-arrow.svg" alt="arrow" > Назад</a>
                        </li>
                        <li onclick="writeToHidden_page(event)" name="page" value="-1"><a  href="#" style="pointer-events: none;">1</a></li>
                        <li onclick="writeToHidden_page(event)" name="page"><a class="_grey" href="#" style="pointer-events: none;">...</a></li>
                        <li onclick="writeToHidden_page(event)" name="page" value="-1" class=""><a href="#" style="pointer-events: none;">3</a></li>
                        <li onclick="writeToHidden_page(event)" name="page" value="-1" class="active"><a href="#" style="pointer-events: none;">4</a></li>
                        <li onclick="writeToHidden_page(event)" name="page" value="-1"><a href="#" style="pointer-events: none;">5</a></li>
                        <li onclick="writeToHidden_page(event)" name="page"><a class="_grey" href="#" style="pointer-events: none;">...</a></li>
                        <li onclick="writeToHidden_page(event)" name="page" value="-1"><a href="#" style="pointer-events: none;">10</a></li>
                        <li onclick="writeToHidden_page(event)" name="page" value="next" class="page-link-next"><a href="#" style="pointer-events: none;">Далее <img class="ml8"
                                                                          src="/images/mini-right-arrow.svg" alt="arrow"></a>
                        </li>
                    </ul>
                    <script>
                        console.log("indices['count'] = " + <?=$indices['count']?>);
                        console.log("indices['current'] = " + <?=$indices['current']?>);
                        function Index(count, current, base = null){
                            this._page_count = count;
                            this._page_current = current;
                            this.base = base;
                            this.numbers = this.base.querySelectorAll("[name=page] > a");
                            for(let i = 0; i < this.numbers.length; i++){
                                this.numbers[i].parentElement.style.display="none";
                            }
                            this.numbers[4].innerHTML = this._page_current;
                            this.numbers[4].value = this._page_current;
                            this.numbers[4].parentElement.style="";
                            let leftOffset = this._page_current - 3;
                            if(leftOffset > 0){
                                this.numbers[1].parentElement.style = "";
                                this.numbers[1].innerHTML = 1;
                                this.numbers[1].parentElement.value = 1;
                                this.numbers[2].parentElement.style = "";
                                this.numbers[2].innerHTML = "...";
                                this.numbers[3].parentElement.style = "";
                                this.numbers[3].innerHTML = this._page_current - 1;
                                this.numbers[3].parentElement.value = this._page_current - 1;
                            }else if(leftOffset > -1){
                                this.numbers[2].parentElement.style = "";
                                this.numbers[2].innerHTML = this._page_current - 2;
                                this.numbers[2].parentElement.value = this._page_current - 2;
                                this.numbers[3].parentElement.style = "";
                                this.numbers[3].innerHTML = this._page_current - 1;
                                this.numbers[3].parentElement.value = this._page_current - 1;
                            }else if(leftOffset > -2){
                                this.numbers[3].parentElement.style = "";
                                this.numbers[3].innerHTML = this._page_current - 1;
                                this.numbers[3].parentElement.value = this._page_current - 1;
                            }
                            if(leftOffset > -2){
                                this.numbers[0].parentElement.style = "";
                                this.numbers[0].parentElement.value = this._page_current - 1;
                                }
                            let rightOffset =  this._page_count - this._page_current;
                            if(rightOffset > 2){
                                this.numbers[5].parentElement.style = "";
                                this.numbers[5].innerHTML = this._page_current + 1;
                                this.numbers[5].parentElement.value = this._page_current + 1;
                                this.numbers[6].parentElement.style = "";
                                this.numbers[6].innerHTML = "...";
                                this.numbers[7].parentElement.style = "";
                                this.numbers[7].innerHTML = this._page_count;
                                this.numbers[7].parentElement.value = this._page_count;
                            }else if(rightOffset > 1){
                                this.numbers[5].parentElement.style = "";
                                this.numbers[5].innerHTML = this._page_current + 1;
                                this.numbers[5].parentElement.value = this._page_current + 1;
                                this.numbers[6].parentElement.style = "";
                                this.numbers[6].innerHTML = this._page_current + 2;
                                this.numbers[6].parentElement.value = this._page_current + 2;
                            }else if(rightOffset > 0){
                                this.numbers[5].parentElement.style = "";
                                this.numbers[5].innerHTML = this._page_current + 1;
                                this.numbers[5].parentElement.value = this._page_current + 1;
                            }
                            if(rightOffset > 0){
                                this.numbers[8].parentElement.style = "";
                                this.numbers[8].parentElement.value = this._page_current + 1;
                                }
                        }
                        var indices = new Index( <?=$indices['count']?>, <?=$indices['current']?>, page_index);
                    </script>
                </div>

                <!-- Фильтр -->
                <div id="filter_base" class="col-lg-3 desctop-992-pl-16 d-flex flex-column vakancy-page-filter-block vakancy-page-filter-block-dnone">
                        <input use_as="filter_item" type="hidden" name="page" value=""   id="page_input"  >
                        <input use_as="filter_item" type="hidden" name="sort" value="<?php if(isset($filter_view['sort'])){echo($filter_view['sort']);} ?>"   id="sort_input"  >
                        <input use_as="filter_item" type="hidden" name="gender" value="<?php if(isset($filter_view['gender'])){echo($filter_view['gender']);} ?>" id="gender_input">
                    <div
                            class="vakancy-page-filter-block__row mobile-flex-992 mb24 d-flex justify-content-between align-items-center">
                        <div class="heading">Фильтр</div>
                        <img class="cursor-p" src="/images/big-cancel.svg" alt="cancel">
                    </div>
                    <div class="signin-modal__switch-btns-wrap resume-list__switch-btns-wrap mb16">
                        <script>
                            function writeToHidden_gender(event){
                                event.preventDefault();
                                gender_input.value = event.target.getAttribute("value");
                                gender_input.dispatchEvent(new Event('change', {bubbles: true}));
                            }
                        </script>
                        <a onclick="writeToHidden_gender(event)" value="all" href="#" class="signin-modal__switch-btn <?php if(!isset($filter_view['gender']) || ( isset($filter_view['gender'])&&$filter_view['gender']=='all')){echo('active');} ?>">Все</a>
                        <a onclick="writeToHidden_gender(event)" value="male" href="#" class="signin-modal__switch-btn <?php if(isset($filter_view['gender'])&&$filter_view['gender']=='male'){echo('active');} ?>">Мужчины</a>
                        <a onclick="writeToHidden_gender(event)" value="female" href="#" class="signin-modal__switch-btn <?php if(isset($filter_view['gender'])&&$filter_view['gender']=='female'){echo('active');} ?>">Женщины</a>
                    </div>
                    <script>
                        console.log("city : <?php if(isset($filter_view['city'])){ echo($filter_view['city']); } ?>");
                    </script>

                    <div class="vakancy-page-filter-block__row mb24">
                        <div class="paragraph cadet-blue">Город</div>
                        <div class="citizenship-select">
                            <select name="city" use_as="filter_item" >
                                <option value="" disabled <?php if(!isset($filter_view['city'])){echo("selected");}?> >Город</option>
                                <?php foreach( $cities as $city): ?>
                                    <option value=<?= $city["id"]?> <?php if(isset($filter_view['city']) && ($filter_view['city'] ==$city["id"])){echo("selected");}?>>
                                        <?=$city['name']?>
                                    </option>
                                <?php endforeach ?>
                           </select>
                        </div>
                    </div>

                    <div class="vakancy-page-filter-block__row mb24">
                        <div class="paragraph cadet-blue">Зарплата</div>
                        <div class="p-rel">
                            <input name="salary" use_as="filter_item" placeholder="Любая" type="text" class="dor-input w100" value="<?php  if(isset($filter_view['salary'])){echo($filter_view['salary']);} ?>" >
                            <img class="rub-icon" src="/images/rub-icon.svg" alt="rub-icon">
                        </div>
                    </div>
                    <div class="vakancy-page-filter-block__row mb24">
                        <div class="paragraph cadet-blue">Специализация</div>
                        <div class="citizenship-select">
                            <select name="spec" use_as="filter_item" >
                                <option value="" disabled selected>Специализация</option>
                                <?php foreach( $spec_list as $spec): ?>
                                    <option value=<?= $spec["id"]?> <?php if(isset($filter_view["spec"])&&($filter_view["spec"] == $spec["id"])){echo('selected');} ?>><?=$spec['name']?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                    </div>
                    <div class="vakancy-page-filter-block__row mb24">
                        <div class="paragraph cadet-blue">Возраст</div>
                        <div class="d-flex">
                            <input name="min_age" use_as="filter_item" placeholder="От" type="text" class="dor-input w100" value="<?php if(isset($filter_view['min_age'])){echo($filter_view['min_age']);} ?>">
                            <input name="max_age" use_as="filter_item" placeholder="До" type="text" class="dor-input w100" value="<?php if(isset($filter_view['max_age'])){echo($filter_view['max_age']);} ?>">
                        </div>
                    </div>
                    <div class="vakancy-page-filter-block__row mb24">
                        <div class="paragraph cadet-blue">Опыт работы</div>
                        <div class="profile-info">
                            <div class="form-check d-flex">
                                <input name="exp_without" use_as="filter_item" type="checkbox" class="form-check-input" id="exampleCheck1"
                                    <?php if(isset($filter_view['exp_without'])){echo"checked";}?>
                                >
                                <label class="form-check-label" for="exampleCheck1"></label>
                                <label for="exampleCheck1" class="profile-info__check-text">Без опыта</label>
                            </div>
                            <div class="form-check d-flex">
                                <input name="exp_1to3" use_as="filter_item" type="checkbox" class="form-check-input" id="exampleCheck2"
                                    <?php if(isset($filter_view['exp_1to3'])){echo"checked";}?>
                                >
                                <label class="form-check-label" for="exampleCheck2"></label>
                                <label for="exampleCheck2" class="profile-info__check-text">От 1 года до 3
                                    лет</label>
                            </div>
                            <div class="form-check d-flex">
                                <input name="exp_3to6" use_as="filter_item" type="checkbox" class="form-check-input" id="exampleCheck3"
                                    <?php if(isset($filter_view['exp_3to6'])){echo"checked";}?>
                                >
                                <label class="form-check-label" for="exampleCheck3"></label>
                                <label for="exampleCheck3" class="profile-info__check-text">От 3 лет до 6
                                    лет</label>
                            </div>
                            <div class="form-check d-flex">
                                <input name="exp_morethen6" use_as="filter_item" type="checkbox" class="form-check-input" id="exampleCheck4"
                                    <?php if(isset($filter_view['exp_morethen6'])){echo"checked";}?>
                                >
                                <label class="form-check-label" for="exampleCheck4"></label>
                                <label for="exampleCheck4" class="profile-info__check-text">Более 6 лет</label>
                            </div>
                        </div>
                    </div>
                    <div class="vakancy-page-filter-block__row mb24">
                        <div class="paragraph cadet-blue">Тип занятости</div>
                        <div class="profile-info">
                            <div class="form-check d-flex">
                                <input name="empl_full" use_as="filter_item" type="checkbox" class="form-check-input" id="exampleCheck5"
                                    <?php if(isset($filter_view['empl_full'])){echo"checked";}?>
                                >
                                <label class="form-check-label" for="exampleCheck5"></label>
                                <label for="exampleCheck5" class="profile-info__check-text">Полная занятость</label>
                            </div>
                            <div class="form-check d-flex">
                                <input name="empl_part" use_as="filter_item" type="checkbox" class="form-check-input" id="exampleCheck6"
                                    <?php if(isset($filter_view['empl_part'])){echo"checked";}?>
                                >
                                <label class="form-check-label" for="exampleCheck6"></label>
                                <label for="exampleCheck6" class="profile-info__check-text">Частичная
                                    занятость</label>
                            </div>
                            <div class="form-check d-flex">
                                <input name="empl_project" use_as="filter_item" type="checkbox" class="form-check-input" id="exampleCheck7"
                                    <?php if(isset($filter_view['empl_project'])){echo"checked";}?>
                                >
                                <label class="form-check-label" for="exampleCheck7"></label>
                                <label for="exampleCheck7" class="profile-info__check-text">Проектная работа</label>
                            </div>
                            <div class="form-check d-flex">
                                <input name="empl_internship" use_as="filter_item" type="checkbox" class="form-check-input" id="exampleCheck8"
                                    <?php if(isset($filter_view['empl_internship'])){echo"checked";}?>
                                >
                                <label class="form-check-label" for="exampleCheck8"></label>
                                <label for="exampleCheck8" class="profile-info__check-text">Стажировка</label>
                            </div>
                            <div class="form-check d-flex">
                                <input name="empl_volunteering" use_as="filter_item" type="checkbox" class="form-check-input" id="exampleCheck9"
                                    <?php if(isset($filter_view['empl_volunteering'])){echo"checked";}?>
                                >
                                <label class="form-check-label" for="exampleCheck9"></label>
                                <label for="exampleCheck9" class="profile-info__check-text">Волонтёрство</label>
                            </div>
                        </div>
                    </div>
                    <div class="vakancy-page-filter-block__row mb24">
                        <div class="paragraph cadet-blue">График работы</div>
                        <div class="profile-info">
                            <div class="form-check d-flex">
                                <input name="scdl_full" use_as="filter_item" type="checkbox" class="form-check-input" id="exampleCheck10"
                                    <?php if(isset($filter_view['scdl_full'])){echo"checked";}?>
                                >
                                <label class="form-check-label" for="exampleCheck10"></label>
                                <label for="exampleCheck10" class="profile-info__check-text">Полный день</label>
                            </div>
                            <div class="form-check d-flex">
                                <input name="scdl_part" use_as="filter_item"  type="checkbox" class="form-check-input" id="exampleCheck11"
                                    <?php if(isset($filter_view['scdl_part'])){echo"checked";}?>
                                >
                                <label class="form-check-label" for="exampleCheck11"></label>
                                <label for="exampleCheck11" class="profile-info__check-text">Сменный график</label>
                            </div>
                            <div class="form-check d-flex">
                                <input name="scdl_rotational" use_as="filter_item"  type="checkbox" class="form-check-input" id="exampleCheck12"
                                    <?php if(isset($filter_view['scdl_rotational'])){echo"checked";}?>
                                >
                                <label class="form-check-label" for="exampleCheck12"></label>
                                <label for="exampleCheck12" class="profile-info__check-text">Вахтовый метод</label>
                            </div>
                            <div class="form-check d-flex">
                                <input name="scdl_flex" use_as="filter_item"  type="checkbox" class="form-check-input" id="exampleCheck13"
                                    <?php if(isset($filter_view['scdl_flex'])){echo"checked";}?>
                                >
                                <label class="form-check-label" for="exampleCheck13"></label>
                                <label for="exampleCheck13" class="profile-info__check-text">Гибкий график</label>
                            </div>
                            <div class="form-check d-flex">
                                <input name="scdl_remote" use_as="filter_item"  type="checkbox" class="form-check-input" id="exampleCheck14"
                                    <?php if(isset($filter_view['scdl_remote'])){echo"checked";}?>
                                >
                                <label class="form-check-label" for="exampleCheck14"></label>
                                <label for="exampleCheck14" class="profile-info__check-text">Удалённая
                                    работа</label>
                            </div>
                        </div>
                    </div>
                    <div
                            class="vakancy-page-filter-block__row vakancy-page-filter-block__show-vakancy-btns mb24 d-flex flex-wrap align-items-center mobile-jus-cont-center">
                        <a class="link-orange-btn orange-btn mr24 mobile-mb12" href="#">Показать <span>1 230</span>
                            вакансии</a>
                        <a href="#">Сбросить все</a>
                    </div>
                </div>
            </div>
            <script>
                function Filter(base){
                    this._page = 1;
                    this._sort = "new_inc";
                    this._base = base;
                    this._indices = document.querySelectorAll("[use_as=indices] > li");
                    this._inputs = this._base.querySelectorAll("[use_as=filter_item]");
                    console.log("this._indices : ");
                    for(let i = 0; i < this._indices.length; i++){
                        //console.log(this._indices[i]);
                        if(!this._indices[i].hasAttribute('name') && !this._indices[i].value){continue;}
                        this._indices[i].addEventListener('click', function(event){
                            this._page = event.target.value
                            console.log(event.target.value);
                            console.log(this._page);
                            window.requestBuilder({page});});
                    }

                    this.getString = function(){
                        let outStr ="";
                        for(let i = 0; i < this._inputs.length; i++){
                            if(!this._inputs[i].hasAttribute('name')){continue;}
                            if(!this._inputs[i].value){continue;}
                            if(this._inputs[i].type=="radio" && !this._inputs[i].checked){continue;}
                            if(this._inputs[i].type=="checkbox" && !this._inputs[i].checked){continue;}
                            outStr = outStr + "&" + this._inputs[i].getAttribute('name') + "=" + this._inputs[i].value;
                        };
                        return outStr;
                    }
                    this._base.addEventListener('change', (event)=>{
                        let outStr = this.getString();
                        //console.log(outStr);
                        document.location.href = `/resume/list?${outStr}`;
                    });
                    this.print = function(){
                        for( let i = 0; i < this._inputs.length; i++){
                            console.log(this._inputs[i]);
                        }
                    };
                };
                window.filter = new Filter(filter_base);
            </script>
            <!-- Фильтр -->
        </div>
    </div>


