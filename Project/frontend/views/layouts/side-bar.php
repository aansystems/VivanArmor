<?php

use frontend\models\MasterRoleTypes;
use frontend\models\User;
use frontend\models\Company;
use frontend\models\BranchManagers;
use frontend\models\License;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

$base_url = Yii::$app->request->baseUrl;
$role = Yii::$app->user->identity->role_type;
$base = Yii::$app->controller->id . "/" . Yii::$app->controller->action->id;
$name = User::findOne(['id' => Yii::$app->user->identity->id]);

?>
<style>

    .sidebar-collapse>.wrapper>.main-sidebar>.sidebar>.user-panel>.image>.fa{
        font-size: 30px;
        color: white;
    }
    .main-sidebar>.sidebar>.user-panel>.image>.fa{
        font-size: 40px;
        color: white;
    }
    ul li span {
        font-weight: 500;
    }
    .modal-content .modal-body {
        padding-top: 15px;
        padding-left: 45px;
        min-height: auto;
    }
    @media (min-width: 767px){    
        .sidebar-mini.sidebar-collapse .sidebar-menu>li:hover>a>span:not(.pull-right),
        .sidebar-mini.sidebar-collapse .sidebar-menu>li:hover>.treeview-menu{
            display:block !important;position:absolute;width:220px;left:50px
        }
        .sidebar-menu li>a>.pull-right-container>.fa-angle-left{
            margin-right: 0px !important;
        }
        .sidebar-mini.sidebar-collapse .sidebar-menu>li:hover>a>.pull-right-container{
            position:relative!important;
            float:right;
            width:auto!important;
            left:200px !important;
            top:-22px !important;
            z-index:900
        }
    }
    @media (min-width: 768px) and (max-width: 910px){
        .sidebar-menu{
            margin-top: 20px !important;
        }
    }
    @media (max-width: 979px) and (min-width: 768px){
        ul li span{
            font-size: 12px !important;
        }
        .sidebar-menu li>a>.pull-right-container>.fa-angle-left{
            margin-right: 10px !important;
        }
        .sidebar-menu .treeview-menu>li>a {
            padding: 5px 5px 5px 5px;
            display: block;
            font-size: 12px;
        }
    }
    @media (max-width: 767px){
        .sidebar-menu{
            margin-left: -10px !important;
        }
    }

    @media (min-width: 767px){
        .sidebar{
            overflow-y:scroll;
        }
    }
    .sidebar{
        -ms-overflow-style:none; 
    }

    ::-webkit-scrollbar {
        width: 0px;
    }
    select.privilege {
        margin: 0px 10px;
        width: 210px;
    }
    .privileged{
        display: none;
    }
    .sidebar-mini.sidebar-collapse .sidebar-menu>li>a .security{
        margin-top: -10px !important;
        height: 12px;
    }
</style>

<aside class="main-sidebar" style="display:flex">
    <section class="sidebar">
        <header class="main-header">
            <!-- Logo -->
            <a class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><img class="smu_logo" src="<?= Yii::$app->request->baseUrl ?>/images/lms.jpg" alt="vivaan" width="50"></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><img class="smu_logo" src="<?= Yii::$app->request->baseUrl ?>/images/vivaan-armor.png" alt="vivaan" width="150"></span>
            </a></header>
        <!-- Sidebar user panel -->
        <div class="user-panel testing">
            <div class="pull-left image">
                <i class="fa fa-user-circle-o img"></i>
            </div>
            <div class="pull-left info">
                <p><?= $name->first_name . ' ' . ucfirst($name->last_name); ?></p>
                <p>(<?= MasterRoleTypes::findOne(['id' => Yii::$app->user->identity->role_type])->role_name; ?>)</p>
            </div>      
        </div>
        <ul class="sidebar-menu">
            <?php if ($name->privilege == 1) { ?>  
                <li style="margin-bottom:10px;">
                    <?php if ($role == 3) { ?>
                        <?=
                        Html::dropDownList('ld', null, ['3' => 'Branch Admin', '4' => 'Learner'], ['class' => 'form-control privilege', 'options' => [2 => ['Selected' => 'selected']]]);
                        ?>
                    <?php } else { ?>
                        <?=
                        Html::dropDownList('ld', null, ['2' => 'Company Admin', '4' => 'Learner'], ['class' => 'form-control privilege', 'options' => [2 => ['Selected' => 'selected']]]);
                        ?>
                    <?php } ?>
                </li>
            <?php } ?>
            <?php if ($role == 4 || $role == 7) { ?> 

            <?php } else { ?>
                <li<?php if ($base == 'site/index') { ?>  class="active treeview"<?php } else { ?> class="treeview"<?php } ?>>
                    <a href="<?= Yii::$app->request->baseUrl ?>/site">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>
            <?php } ?>
            <?php if ($role == 1) { ?>
                <li<?php
                if ($base == 'company/index' || $base == 'company/create' ||
                        $base == 'company/update' || $base == 'company/view' || $base == 'company/block-courses' || $base == 'learners/index' ||
                        $base == 'learners/create' || $base == 'learners/update' || $base == 'learners/view') {
                    ?> class="active treeview"<?php } else { ?> class="treeview"<?php } ?> >
                    <a href="#">
                        <i class="fa fa-group"></i>
                        <span>Users</span>
                        <span class="pull-right-container">
                            <span class="fa fa-angle-left pull-right"></span>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li<?php if ($base == "company/update" || $base == "company/index" || $base == "company/view" || $base == "company/create" || $base == "company/blocked-courses") { ?> class="active"<?php } ?>>
                            <a href="<?= Yii::$app->request->baseUrl ?>/company/"><i class="fa fa-circle-o"></i>Company Admin </a> </li>                                                       
                        <li<?php if ($base == "learners/update" || $base == "learners/index" || $base == "learners/view" || $base == "learners/create" || $base == "learners/blocked-courses") { ?> class="active"<?php } ?>>
                            <a href="<?= Yii::$app->request->baseUrl ?>/learners/"><i class="fa fa-circle-o"></i>Learners  </a> </li>
                    </ul>
                </li>                         
                <li<?php
                if ($base == 'master-course-types/index' || $base == 'master-course-types/create' || $base == 'master-course-types/update' || $base == 'master-course-types/view' ||
                        $base == 'courses/index' || $base == 'courses/create' || $base == 'courses/update' || $base == 'courses/view' ||
                        $base == 'countries/create' || $base == 'countries/update' || $base == 'countries/index' || $base == 'countries/view' || $base == 'states/view' || $base == 'states/view' || $base == 'states/view' || $base == 'states/view' || $base == 'states/index' || $base == 'cities/view' || $base == 'cities/view' || $base == 'cities/view' || $base == 'cities/view' || $base == 'cities/index' || $base == 'license/index' || $base == 'license/create' || $base == 'license/update' || $base == 'license/view' || $base == 'cities/create' || $base == 'states/create') {
                    ?> class="active treeview"  <?php } else { ?> class="treeview" <?php } ?>>
                    <a href="#">
                        <i class="fa fa-database"></i>
                        <span>Masters</span>
                        <span class="pull-right-container">
                            <span class="fa fa-angle-left pull-right"></span>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li <?php if ($base == 'master-course-types/index' || $base == 'master-course-types/create' || $base == 'master-course-types/update' || $base == 'master-course-types/view') { ?> class="active"<?php } ?>> <a href="<?= Yii::$app->request->baseUrl ?>/master-course-types/"><i class="fa fa-circle-o"></i> Course Type Manager  </a> </li>
                        <li<?php if ($base == 'courses/index' || $base == 'courses/create' || $base == 'courses/update' || $base == 'courses/view') { ?> class="active"<?php } ?>> <a href="<?= Yii::$app->request->baseUrl ?>/courses/"><i class="fa fa-circle-o"></i> Course Manager </a> </li>
                        <li<?php if ($base == 'license/index' || $base == 'license/create' || $base == 'license/update' || $base == 'license/view') { ?> class="active"<?php } ?>> <a href="<?= Yii::$app->request->baseUrl ?>/license/"><i class="fa fa-circle-o"></i> License Manager </a> </li>
                        <li<?php if ($base == 'countries/index' || $base == 'countries/create' || $base == 'countries/view' || $base == 'countries/update') { ?> class="active"<?php } ?>> <a href="<?= Yii::$app->request->baseUrl ?>/countries/"> <i class="fa fa-circle-o"></i> Countries Manager  </a></li>
                        <li<?php if ($base == 'states/index' || $base == 'states/create' || $base == 'states/view' || $base == 'states/update' || $base == 'states/create') { ?> class="active"<?php } ?>> <a href="<?= Yii::$app->request->baseUrl ?>/states/"> <i class="fa fa-circle-o"></i> States Manager  </a></li>
                        <li <?php if ($base == 'cities/index' || $base == 'cities/create' || $base == 'cities/view' || $base == 'cities/update' || $base == 'cities/create') { ?> class="active"<?php } ?>> <a href="<?= Yii::$app->request->baseUrl ?>/cities/"> <i class="fa fa-circle-o"></i> Cities Manager  </a></li>
                    </ul>
                </li>
                <li<?php if ($base == 'test-assigned/index' || $base == 'test-assigned/create' || $base == 'test-assigned/update' || $base == 'test-assigned/view' || $base == 'test-assigned/approve-test') { ?> class="active"<?php } ?>>
                    <a href="#">
                        <i class="fa fa-flask"></i>
                        <span>Test Manager</span>
                        <span class="pull-right-container">
                            <span class="fa fa-angle-left pull-right"></span>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li<?php if ($base == 'test-assigned/index' || $base == 'test-assigned/create' || $base == 'test-assigned/update' || $base == 'test-assigned/view') { ?> class="active"<?php } ?>> <a href="<?= Yii::$app->request->baseUrl ?>/test-assigned/"><i class="fa fa-circle-o"></i> Test Assign </a> </li>
                        <li<?php if ($base == 'test-assigned/approve-test') { ?> class="active"<?php } ?>> <a href="<?= Yii::$app->request->baseUrl ?>/test-assigned/approve-test"><i class="fa fa-circle-o"></i> Test Requests </a> </li>
                    </ul> 
                </li>
                <li<?php if ($base == 'site/documents-data-log') { ?>  class="active treeview"<?php } else { ?> class="treeview"<?php } ?>>
                    <a href="<?= Yii::$app->request->baseUrl ?>/site/documents-data-log">
                        <i class="fa fa-certificate"></i> <span>Documents Log</span>
                    </a>
                </li>
                <li<?php if ($base == 'super-admin-notifications/index' || $base == 'super-admin-notifications/create' || $base == 'super-admin-notifications/view' || $base == 'super-admin-notifications/update' || $base == 'home-screen-messages/index' || $base == 'home-screen-messages/create' || $base == 'home-screen-messages/update' || $base == 'home-screen-messages/view') { ?> class="active"<?php } ?>>
                    <a href="#">
                        <i class="fa fa-bell"></i>
                        <span>Notifications</span>
                        <span class="pull-right-container">
                            <span class="fa fa-angle-left pull-right"></span>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li <?php if ($base == 'super-admin-notifications/index' || $base == 'super-admin-notifications/create' || $base == 'super-admin-notifications/view' || $base == 'super-admin-notifications/update') { ?> class="active"<?php } ?>> <a href="<?= Yii::$app->request->baseUrl ?>/super-admin-notifications/"><i class="fa fa-circle-o"></i> Push Notifications  </a> </li>
                        <li<?php if ($base == 'home-screen-messages/index' || $base == 'home-screen-messages/create' || $base == 'home-screen-messages/update' || $base == 'home-screen-messages/view') { ?> class="active"<?php } ?>> <a href="<?= Yii::$app->request->baseUrl ?>/home-screen-messages/"><i class="fa fa-circle-o"></i> Message Box </a> </li>

                    </ul>
                </li>
            <?php } ?> 

            <?php if ($role == 2) { ?>

                <li<?php if ($base == 'branches/index' || $base == 'branches/create' || $base == 'branches/view' || $base == 'branches/update') { ?>  class="active treeview"<?php } else { ?> class="treeview"<?php } ?>>
                    <a href="<?= Yii::$app->request->baseUrl ?>/branches/">
                        <i class="fa fa-university"></i> <span>Branch Master</span>
                    </a>
                </li>
                <li<?php if ($base == 'branch-managers/index' || $base == 'branch-managers/create' || $base == 'branch-managers/view' || $base == 'branch-managers/update') { ?>  class="active treeview"<?php } else { ?> class="treeview"<?php } ?>>
                    <a href="<?= Yii::$app->request->baseUrl ?>/branch-managers/">
                        <i class="fa fa-user"></i> <span>Branch Manager</span>
                    </a>
                </li>

                <li<?php if ($base == 'site/documents-data-log') { ?>  class="active treeview"<?php } else { ?> class="treeview"<?php } ?>>
                    <a href="<?= Yii::$app->request->baseUrl ?>/site/documents-data-log">
                        <i class="fa fa-certificate"></i> <span>Documents Log</span>
                    </a>
                </li>


                <li<?php if ($base == 'certificates/company-admin-certificate') { ?>  class="active treeview"<?php } else { ?> class="treeview"<?php } ?>>
                    <a href="<?= Yii::$app->request->baseUrl ?>/certificates/company-admin-certificate">
                        <i class="fa fa-certificate"></i> <span>Certificates</span>
                    </a>
                </li>
                       <li<?php if ($base == 'test-assigned/index' || $base == 'test-assigned/create' || $base == 'test-assigned/update' || $base == 'test-assigned/view') { ?>  class="active treeview"<?php } else { ?> class="treeview"<?php } ?>>
                    <a href="<?= Yii::$app->request->baseUrl ?>/test-assigned/">
                        <i class="fa fa-flask"></i> <span>Test Manager</span>
                    </a>
                </li>
                <li<?php
                if ($base == 'courses-assigned/index' || $base == 'courses-assigned/view' || $base == 'blocked-courses/index') {
                    ?> class="active treeview"<?php } else { ?> class="treeview"<?php } ?> >
                    <a href="#">
                        <i class="fa fa-book"></i>
                        <span>Courses</span>
                        <span class="pull-right-container">
                            <span class="fa fa-angle-left pull-right"></span>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li <?php if ($base == "courses-assigned/index" || $base == "courses-assigned/view") { ?> class="active"<?php } ?>>
                            <a href="<?= Yii::$app->request->baseUrl ?>/courses-assigned/"><i class="fa fa-circle-o"></i>Available Courses </a> </li>                                                       
                        <li<?php if ($base == "blocked-courses/index") { ?> class="active"<?php } ?>>
                            <a href="<?= Yii::$app->request->baseUrl ?>/blocked-courses/"><i class="fa fa-circle-o"></i>Blocked Courses </a> </li>
                    </ul>
                </li>

                <li<?php if ($base == 'company-notifications/index' || $base == 'company-notifications/create' || $base == 'company-notifications/view' || $base == 'company-notifications/update' || $base == 'home-screen-messages/index' || $base == 'home-screen-messages/create' || $base == 'home-screen-messages/update' || $base == 'home-screen-messages/view') { ?> class="active"<?php } ?>>
                    <a href="#">
                        <i class="fa fa-bell"></i>
                        <span>Notifications</span>
                        <span class="pull-right-container">
                            <span class="fa fa-angle-left pull-right"></span>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li <?php if ($base == 'company-notifications/index' || $base == 'company-notifications/create' || $base == 'company-notifications/view' || $base == 'company-notifications/update') { ?> class="active"<?php } ?>> <a href="<?= Yii::$app->request->baseUrl ?>/company-notifications/"><i class="fa fa-circle-o"></i> Push Notifications  </a> </li>
                        <li<?php if ($base == 'home-screen-messages/index' || $base == 'home-screen-messages/create' || $base == 'home-screen-messages/update' || $base == 'home-screen-messages/view') { ?> class="active"<?php } ?>> <a href="<?= Yii::$app->request->baseUrl ?>/home-screen-messages/"><i class="fa fa-circle-o"></i> Message Box </a> </li>

                    </ul>
                </li>
                <?php if ($name->privilege == 1) { ?>
                    <li class="privileged"<?php
                    if ($base == 'courses-assigned/my-courses' || $base == 'courses/my-review-material' || $base == 'learner-activity/lessons' || $base == 'courses/my-review-material' ||
                            $base == 'learner-scoring/questions' || $base == 'review-material-scoring/review-material-score' || $base == 'courses-assigned/ebooks' || $base == 'courses-assigned/tiles' ||
                            $base == 'courses-assigned/daily' || $base == 'courses-assigned/weekly' || $base == 'courses-assigned/monthly' || $base == 'site/dashboard-learner' || $base == 'timed-quiz/index' || $base == 'certificates/index') {
                        ?> class="active treeview" <?php } else { ?> class="treeview"<?php } ?>  >
                        <a href="#">
                            <i class="fa fa-book"></i>
                            <span>Learning Manager</span>
                            <span class="pull-right-container">
                                <span class="fa fa-angle-left pull-right"></span>
                            </span>
                        </a>
                        <ul class="active treeview-menu">                     
                            <li<?php if ($base == 'courses-assigned/my-courses') { ?>  class="active"<?php } ?>>  <a href="<?= Yii::$app->request->baseUrl ?>/courses-assigned/my-courses"><i class="fa fa-circle-o"></i> My Courses</a></li>                                                
                            <li<?php if ($base == 'site/dashboard-learner') { ?> class="active"<?php } ?>><a href="<?= Yii::$app->request->baseUrl ?>/site/dashboard-learner"> <i class="fa fa-circle-o"></i> My Progress </a></li>
                            <li<?php if ($base == 'timed-quiz/index') { ?> class="active"<?php } ?>> <a href="<?= Yii::$app->request->baseUrl ?>/timed-quiz"> <i class="fa fa-circle-o"></i> My Tests</a></li>
                            <li<?php if ($base == 'certificates/index') { ?> class="active"<?php } ?>> <a href="<?= Yii::$app->request->baseUrl ?>/certificates/index"> <i class="fa fa-circle-o"></i> My Certificates</a></li>   
                        </ul>
                    </li>
                <?php } ?>

            <?php } ?>

            <?php if ($role == 3) { ?> 
                <li <?php if ($base == 'learners/index' || $base == 'learners/create' || $base == 'learners/view' || $base == 'learners/update' || $base == 'learners/blocked-courses') { ?> class="active"<?php } ?>>
                    <a href="<?= Yii::$app->request->baseUrl ?>/learners/index">
                        <i class="fa fa-users"></i>
                        <span>Users/Learners</span>
                    </a>
                </li>
                <li <?php if ($base == 'courses-assigned/index' || $base == 'courses-assigned/view') { ?> class="active"<?php } ?>>
                    <a href="<?= Yii::$app->request->baseUrl ?>/courses-assigned/">
                        <i class="fa fa-book"></i>
                        <span>Courses</span>
                    </a>
                </li>

                <li<?php if ($base == 'site/documents-data-log') { ?>  class="active treeview"<?php } else { ?> class="treeview"<?php } ?>>
                    <a href="<?= Yii::$app->request->baseUrl ?>/site/documents-data-log">
                        <i class="fa fa-certificate"></i> <span>Documents Log</span>
                    </a>
                </li>


                <li<?php if ($base == 'certificates/branch-manager-certificate') { ?>  class="active treeview"<?php } else { ?> class="treeview"<?php } ?>>
                    <a href="<?= Yii::$app->request->baseUrl ?>/certificates/branch-manager-certificate">
                        <i class="fa fa-certificate"></i> <span>Certificates</span>
                    </a>
                </li>
                <li<?php if ($base == 'test-assigned/index' || $base == 'test-assigned/create' || $base == 'test-assigned/update' || $base == 'test-assigned/view' || $base == 'test-assigned/approve-test') { ?> class="active"<?php } ?>>
                    <a href="#">
                        <i class="fa fa-flask"></i>
                        <span>Test Manager</span>
                        <span class="pull-right-container">
                            <span class="fa fa-angle-left pull-right"></span>
                        </span>
                    </a>
                    <ul class="treeview-menu">
                        <li<?php if ($base == 'test-assigned/index' || $base == 'test-assigned/create' || $base == 'test-assigned/update' || $base == 'test-assigned/view') { ?> class="active"<?php } ?>> <a href="<?= Yii::$app->request->baseUrl ?>/test-assigned/"><i class="fa fa-circle-o"></i> Test Assign </a> </li>
                        <li<?php if ($base == 'test-assigned/approve-test') { ?> class="active"<?php } ?>> <a href="<?= Yii::$app->request->baseUrl ?>/test-assigned/approve-test"><i class="fa fa-circle-o"></i> Test Requests </a> </li>
                    </ul> 
                </li>
                <?php if ($name->privilege == 1) { ?>
                    <li class="privileged"<?php
                    if ($base == 'courses-assigned/my-courses' || $base == 'courses/my-review-material' || $base == 'learner-activity/lessons' || $base == 'courses/my-review-material' ||
                            $base == 'learner-scoring/questions' || $base == 'review-material-scoring/review-material-score' || $base == 'courses-assigned/ebooks' || $base == 'courses-assigned/tiles' ||
                            $base == 'courses-assigned/daily' || $base == 'courses-assigned/weekly' || $base == 'courses-assigned/monthly' || $base == 'site/dashboard-learner' || $base == 'timed-quiz/index' || $base == 'certificates/index') {
                        ?> class="active treeview" <?php } else { ?> class="treeview"<?php } ?>  >
                        <a href="#">
                            <i class="fa fa-book"></i>
                            <span>Learning Manager</span>
                            <span class="pull-right-container">
                                <span class="fa fa-angle-left pull-right"></span>
                            </span>
                        </a>
                        <ul class="active treeview-menu">                     
                            <li<?php if ($base == 'courses-assigned/my-courses') { ?>  class="active"<?php } ?>>  <a href="<?= Yii::$app->request->baseUrl ?>/courses-assigned/my-courses"><i class="fa fa-circle-o"></i> My Courses</a></li>                                                
                            <li<?php if ($base == 'site/dashboard-learner') { ?> class="active"<?php } ?>><a href="<?= Yii::$app->request->baseUrl ?>/site/dashboard-learner"> <i class="fa fa-circle-o"></i> My Progress </a></li>
                            <li<?php if ($base == 'timed-quiz/index') { ?> class="active"<?php } ?>> <a href="<?= Yii::$app->request->baseUrl ?>/timed-quiz"> <i class="fa fa-circle-o"></i> My Tests</a></li>
                            <li<?php if ($base == 'certificates/index') { ?> class="active"<?php } ?>> <a href="<?= Yii::$app->request->baseUrl ?>/certificates/index"> <i class="fa fa-circle-o"></i> My Certificates</a></li>   
                        </ul>
                    </li>

                <?php }
            } ?>
<?php if ($role == 4) { ?>

                <li<?php
                    if ($base == 'site/index') {
                        ?> class="active"<?php } ?>>
                    <a href="<?= Yii::$app->request->baseUrl ?>/site/index">
                        <i class="fa fa-home"></i> <span>Home</span>
                    </a>
                </li>

                <li<?php
                if ($base == 'courses-assigned/my-courses' || $base == 'courses/my-review-material' || $base == 'learner-activity/lessons' || $base == 'courses/my-review-material' ||
                        $base == 'learner-scoring/questions' || $base == 'review-material-scoring/review-material-score' || $base == 'courses-assigned/ebooks' || $base == 'courses-assigned/tiles' ||
                        $base == 'courses-assigned/daily' || $base == 'courses-assigned/weekly' || $base == 'courses-assigned/monthly' || $base == 'site/dashboard-learner' || $base == 'timed-quiz/index' || $base == 'certificates/index') {
                    ?> class="active treeview" <?php } else { ?> class="treeview"<?php } ?>  >
                    <a href="#">
                        <i class="fa fa-book"></i>
                        <span>Learning Manager</span>
                        <span class="pull-right-container">
                            <span class="fa fa-angle-left pull-right"></span>
                        </span>
                    </a>
                    <ul class="active treeview-menu">                     
                        <li<?php if ($base == 'courses-assigned/my-courses') { ?>  class="active"<?php } ?>>  <a href="<?= Yii::$app->request->baseUrl ?>/courses-assigned/my-courses"><i class="fa fa-circle-o"></i> My Courses</a></li>                                                
                        <li<?php if ($base == 'site/dashboard-learner') { ?> class="active"<?php } ?>><a href="<?= Yii::$app->request->baseUrl ?>/site/dashboard-learner"> <i class="fa fa-circle-o"></i> My Progress </a></li>
                        <li<?php if ($base == 'timed-quiz/index') { ?> class="active"<?php } ?>> <a href="<?= Yii::$app->request->baseUrl ?>/timed-quiz"> <i class="fa fa-circle-o"></i> My Tests</a></li>
                        <li<?php if ($base == 'certificates/index') { ?> class="active"<?php } ?>> <a href="<?= Yii::$app->request->baseUrl ?>/certificates/index"> <i class="fa fa-circle-o"></i> My Certificates</a></li>   
                    </ul>
                </li>

                <li<?php if ($base == 'master-doc-templates/index' || $base == 'documents/index' || $base == 'documents/final-doc' || $base == 'site/dms-dashboard' || $base == 'documents/list' || $base == 'documents/create') { ?> class="active treeview" <?php } else { ?> class="treeview"<?php } ?>  >

                    <a href="#">
                        <i class="fa fa-file-text"></i>
                        <span>Document Manager</span>
                        <span class="pull-right-container">
                            <span class="fa fa-angle-left pull-right"></span>
                        </span>
                    </a>
                    <ul class="active treeview-menu">                     
                        <li<?php if ($base == 'master-doc-templates/index') { ?>  class="active"<?php } ?>>  <a href="<?= Yii::$app->request->baseUrl ?>/master-doc-templates/"><i class="fa fa-circle-o"></i> Document Templates</a></li>                                                
                        <li<?php if ($base == 'documents/index') { ?>  class="active"<?php } ?>>  <a href="<?= Yii::$app->request->baseUrl ?>/documents/index"> <i class="fa fa-circle-o"></i> Document Work Flow </a></li>
                        <li<?php if ($base == 'documents/list') { ?>  class="active"<?php } ?>> <a href="<?= Yii::$app->request->baseUrl ?>/documents/list"> <i class="fa fa-circle-o"></i> My Documents </a></li>
                        <li<?php if ($base == 'documents/final-doc') { ?>  class="active"<?php } ?>> <a href="<?= Yii::$app->request->baseUrl ?>/documents/final-doc"> <i class="fa fa-circle-o"></i> Document Library </a></li>
                    </ul>
                </li>

                <li<?php if ($base == 'contents/create' || $base == 'contents/index' || $base == 'contents/content-manager') { ?> class="active treeview" <?php } else { ?> class="treeview"<?php } ?>  >
                    <a href="#">
                        <i class="fa fa-window-restore"></i>
                        <span>Content Manager</span>
                        <span class="pull-right-container">
                            <span class="fa fa-angle-left pull-right"></span>
                        </span>
                    </a>
                    <ul class="treeview-menu">     
                        <li<?php if ($base == 'contents/create') { ?> class="active"<?php } ?>><a href="<?= Yii::$app->request->baseUrl ?>/contents/create"> <i class="fa fa-circle-o"></i> Upload Content</a></li>
                        <li<?php if ($base == 'contents/index') { ?> class="active"<?php } ?>> <a href="<?= Yii::$app->request->baseUrl ?>/contents/index"> <i class="fa fa-circle-o"></i> My Content</a></li> 
                        <li<?php if ($base == 'contents/content-manager') { ?> class="active"<?php } ?>> <a href="<?= Yii::$app->request->baseUrl ?>/contents/content-manager"> <i class="fa fa-circle-o"></i> Content Library</a></li>   
                    </ul>
                </li>

            <?php } ?>
<?php if ($role == 7) { ?>
                <li<?php if ($base == 'cyber-analytics/about' || $base == 'cyber-analytics/dashboard' || $base == 'cyber-analytics/learn' || $base == 'cyber-analytics/process' || $base == 'cyber-analytics/tech') { ?> class="active treeview" <?php } else { ?> class="treeview"<?php } ?>  >
                    <a href="#">
                        <i class="fa fa-dashboard"></i>
                        <span>Resiliency Index</span>
                        <span class="pull-right-container">
                            <span class="fa fa-angle-left pull-down"></span>
                        </span>
                    </a>
                    <ul class="treeview-menu">                     
                        <li<?php if ($base == 'cyber-analytics/about') { ?>  class="active"<?php } ?>>  <a href="<?= Yii::$app->request->baseUrl ?>/cyber-analytics/about"><i class="fa fa-circle-o"></i> About Resiliency Index</a></li>                                                
                        <li<?php if ($base == 'cyber-analytics/' || $base == 'cyber-analytics/dashboard') { ?>  class="active"<?php } ?>>  <a href="<?= Yii::$app->request->baseUrl ?>/cyber-analytics/dashboard"><i class="fa fa-circle-o"></i> Resiliency Dashboard</a></li>                                                
                        <li<?php if ($base == 'cyber-analytics/learn') { ?>  class="active"<?php } ?>>  <a href="<?= Yii::$app->request->baseUrl ?>/cyber-analytics/learn"><i class="fa fa-circle-o"></i> Learning Index</a></li>                                                
                        <li<?php if ($base == 'cyber-analytics/process') { ?> class="active"<?php } ?>><a href="<?= Yii::$app->request->baseUrl ?>/cyber-analytics/process"> <i class="fa fa-circle-o"></i> Process Index</a></li>
                        <li<?php if ($base == 'cyber-analytics/tech') { ?> class="active"<?php } ?>> <a href="<?= Yii::$app->request->baseUrl ?>/cyber-analytics/tech"> <i class="fa fa-circle-o"></i> Technical Index</a></li>   
                    </ul>
                </li>
                <li<?php if ($base == 'cyber-analytics/process-dashboard' || $base == 'cyber-analytics/process-templates' || $base == 'cso-templates' || $base == 'cso-templates/index') { ?> class="active treeview" <?php } else { ?> class="treeview"<?php } ?>  >
                    <a href="#">
                        <i class="fa fa-book"></i>
                        <span>Process Documents</span>
                        <span class="pull-right-container">
                            <span class="fa fa-angle-left pull-right"></span>
                        </span>
                    </a>
                    <ul class="active treeview-menu">                     
                        <li<?php if ($base == 'cyber-analytics/process-dashboard') { ?>  class="active"<?php } ?>>  <a href="<?= Yii::$app->request->baseUrl ?>/cyber-analytics/process-dashboard"><i class="fa fa-circle-o"></i> Dashboard</a></li>                                                
                        <li<?php if ($base == 'cyber-analytics/process-templates') { ?> class="active"<?php } ?>><a href="<?= Yii::$app->request->baseUrl ?>/cyber-analytics/process-templates"> <i class="fa fa-circle-o"></i> Templates</a></li>
                    </ul>
                </li>
                <li<?php if ($base == 'cyber-analytics/tech-controls') { ?>  class="active treeview"<?php } else { ?> class="treeview"<?php } ?>>
                    <a href="<?= Yii::$app->request->baseUrl ?>/cyber-analytics/tech-controls">
                        <i class="fa fa-users"></i> <span>Technical Controls</span>
                    </a>
                </li>
<?php } ?>


            <li<?php if ($base == 'cyber-analytics/about' || $base == 'cyber-analytics/dashboard' || $base == 'cyber-analytics/learn' || $base == 'cyber-analytics/process' || $base == 'cyber-analytics/tech' || $base == 'cyber-analytics/process-dashboard' || $base == 'cyber-analytics/process-templates' || $base == 'cyber-analytics/tech-controls') { ?> class="active treeview" <?php } else { ?> class="treeview"<?php } ?>  >
                <a href="#">
                    <i class="fa fa-cogs"></i>
                    <span>Security Manager</span>
                    <span class="pull-right-container security">
                        <span class="fa fa-angle-left pull-down"></span>
                    </span>
                </a>
                <ul class="treeview-menu">                     
                    <li<?php if ($base == 'cyber-analytics/about' || $base == 'cyber-analytics/dashboard' || $base == 'cyber-analytics/learn' || $base == 'cyber-analytics/process' || $base == 'cyber-analytics/tech') { ?> class="active treeview" <?php } else { ?> class="treeview"<?php } ?>  >
                        <a href="#">
                            <i class="fa fa-dashboard"></i>
                            <span>Resiliency Index</span>
                            <span class="pull-right-container">
                                <span class="fa fa-angle-left pull-down"></span>
                            </span>
                        </a>
                        <ul class="treeview-menu">                     
                            <li<?php if ($base == 'cyber-analytics/about') { ?>  class="active"<?php } ?>>  <a href="<?= Yii::$app->request->baseUrl ?>/cyber-analytics/about"><i class="fa fa-circle-o"></i> About Resiliency Index</a></li>                                                
                            <li<?php if ($base == 'cyber-analytics/' || $base == 'cyber-analytics/dashboard') { ?>  class="active"<?php } ?>>  <a href="<?= Yii::$app->request->baseUrl ?>/cyber-analytics/dashboard"><i class="fa fa-circle-o"></i> Resiliency Dashboard</a></li>                                                
                            <li<?php if ($base == 'cyber-analytics/learn') { ?>  class="active"<?php } ?>>  <a href="<?= Yii::$app->request->baseUrl ?>/cyber-analytics/learn"><i class="fa fa-circle-o"></i> Learning Index</a></li>                                                
                            <li<?php if ($base == 'cyber-analytics/process') { ?> class="active"<?php } ?>><a href="<?= Yii::$app->request->baseUrl ?>/cyber-analytics/process"> <i class="fa fa-circle-o"></i> Process Index</a></li>
                            <li<?php if ($base == 'cyber-analytics/tech') { ?> class="active"<?php } ?>> <a href="<?= Yii::$app->request->baseUrl ?>/cyber-analytics/tech"> <i class="fa fa-circle-o"></i> Technical Index</a></li>   
                        </ul>
                    </li>
                    <li<?php if ($base == 'cyber-analytics/process-dashboard' || $base == 'cyber-analytics/process-templates' || $base == 'cso-templates' || $base == 'cso-templates/index') { ?> class="active treeview" <?php } else { ?> class="treeview"<?php } ?>  >
                        <a href="#">
                            <i class="fa fa-book"></i>
                            <span>Process Documents</span>
                            <span class="pull-right-container">
                                <span class="fa fa-angle-left pull-right"></span>
                            </span>
                        </a>
                        <ul class="active treeview-menu">                     
                            <li<?php if ($base == 'cyber-analytics/process-dashboard') { ?>  class="active"<?php } ?>>  <a href="<?= Yii::$app->request->baseUrl ?>/cyber-analytics/process-dashboard"><i class="fa fa-circle-o"></i> Dashboard</a></li>                                                
                            <li<?php if ($base == 'cyber-analytics/process-templates') { ?> class="active"<?php } ?>><a href="<?= Yii::$app->request->baseUrl ?>/cyber-analytics/process-templates"> <i class="fa fa-circle-o"></i> Templates</a></li>
                        </ul>
                    </li>
                    <li<?php if ($base == 'cyber-analytics/tech-controls') { ?>  class="active treeview"<?php } else { ?> class="treeview"<?php } ?>>
                        <a href="<?= Yii::$app->request->baseUrl ?>/cyber-analytics/tech-controls">
                            <i class="fa fa-users"></i> <span>Technical Controls</span>
                        </a>
                    </li>
                </ul>
            </li>           
            <li<?php if ($base == 'compliance/hipaa' || $base == 'compliance/hipaa-checklist' || $base == 'compliance/pci' || $base == 'compliance/pci-checklist' || $base == 'compliance/gdpr' || $base == 'compliance/gdpr-checklist') { ?> class="active treeview" <?php } else { ?> class="treeview"<?php } ?>  >
                <a href="#">
                    <i class="fa fa-book"></i>
                    <span>Compliance Manager</span>
                    <span class="pull-right-container">
                        <span class="fa fa-angle-left pull-right"></span>
                    </span>
                </a>
                <ul class="active treeview-menu">
                    <li<?php if ($base == 'compliance/hipaa' || $base == 'compliance/hipaa-checklist') { ?> class="active treeview" <?php } else { ?> class="treeview"<?php } ?>  >
                        <a href="#">
                            <i class="fa fa-book"></i>
                            <span>HIPAA</span>
                            <span class="pull-right-container">
                                <span class="fa fa-angle-left pull-right"></span>
                            </span>
                        </a>
                        <ul class="active treeview-menu">                     
                            <li<?php if ($base == 'compliance/hipaa') { ?>  class="active"<?php } ?>>  <a href="<?= Yii::$app->request->baseUrl ?>/compliance/hipaa"><i class="fa fa-circle-o"></i> Dashboard</a></li>                                                
                            <li<?php if ($base == 'compliance/hipaa-checklist') { ?> class="active"<?php } ?>><a href="<?= Yii::$app->request->baseUrl ?>/compliance/hipaa-checklist"> <i class="fa fa-circle-o"></i> Checklist</a></li>
                        </ul>
                    </li>
                    <li<?php if ($base == 'compliance/pci' || $base == 'compliance/pci-checklist') { ?> class="active treeview" <?php } else { ?> class="treeview"<?php } ?>  >
                        <a href="#">
                            <i class="fa fa-book"></i>
                            <span>PCI</span>
                            <span class="pull-right-container">
                                <span class="fa fa-angle-left pull-right"></span>
                            </span>
                        </a>
                        <ul class="active treeview-menu">                     
                            <li<?php if ($base == 'compliance/pci') { ?>  class="active"<?php } ?>>  <a href="<?= Yii::$app->request->baseUrl ?>/compliance/pci"><i class="fa fa-circle-o"></i> Dashboard</a></li>                                                
                            <li<?php if ($base == 'compliance/pci-checklist') { ?> class="active"<?php } ?>><a href="<?= Yii::$app->request->baseUrl ?>/compliance/pci-checklist"> <i class="fa fa-circle-o"></i> Checklist</a></li>
                        </ul>
                    </li>
                    <li<?php if ($base == 'compliance/gdpr' || $base == 'compliance/gdpr-checklist') { ?> class="active treeview" <?php } else { ?> class="treeview"<?php } ?>  >
                        <a href="#">
                            <i class="fa fa-book"></i>
                            <span>GDPR</span>
                            <span class="pull-right-container">
                                <span class="fa fa-angle-left pull-right"></span>
                            </span>
                        </a>
                        <ul class="active treeview-menu">                     
                            <li<?php if ($base == 'compliance/gdpr') { ?>  class="active"<?php } ?>>  <a href="<?= Yii::$app->request->baseUrl ?>/compliance/gdpr"><i class="fa fa-circle-o"></i> Dashboard</a></li>                                                
                            <li<?php if ($base == 'compliance/gdpr-checklist') { ?> class="active"<?php } ?>><a href="<?= Yii::$app->request->baseUrl ?>/compliance/gdpr-checklist"> <i class="fa fa-circle-o"></i> Checklist</a></li>
                        </ul>
                    </li>
                </ul>
            </li>



<?php if ($role == 4) { ?>
                <li <?php if ($base == 'master-faq/index') { ?> class="active" <?php } ?>>
                    <a href="<?= Yii::$app->request->baseUrl ?>/master-faq">
                        <i class="fa fa-question-circle-o"></i>
                        <span>FAQ</span>
                    </a>
                </li>
<?php } ?>
            <li<?php if ($base == 'user/my-profile' || $base == 'user/edit-profile' || $base == 'settings/change-password') { ?> class="active treeview" <?php } else { ?> class="treeview"<?php } ?>  >
                <a href="#">
                    <i class="fa fa-gear"></i>
                    <span>Settings</span>
                    <span class="pull-right-container">
                        <span class="fa fa-angle-left pull-right"></span>
                    </span>
                </a>
                <ul class="active treeview-menu">                     
                    <li<?php if ($base == 'user/my-profile') { ?>  class="active"<?php } ?>>  <a href="<?= Yii::$app->request->baseUrl ?>/user/my-profile"><i class="fa fa-circle-o"></i> My Profile</a></li>                                                
                    <li<?php if ($base == 'user/edit-profile') { ?> class="active"<?php } ?>><a href="<?= Yii::$app->request->baseUrl ?>/user/edit-profile?id=<?= Yii::$app->user->identity->id ?>"> <i class="fa fa-circle-o"></i> Edit Profile </a></li>
                    <li<?php if ($base == 'settings/change-password') { ?> class="active"<?php } ?>> <a href="<?= Yii::$app->request->baseUrl ?>/settings/change-password"> <i class="fa fa-circle-o"></i> Password Change</a></li>   
                </ul>
            </li>
            <li><a href="<?= Yii::$app->request->baseUrl ?>/site/logout" data-method="POST"> 
                    <i class="fa fa-power-off"></i>
                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </section>
</aside>
<!-- Modal -->
<div id="comingsoon" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">HIPPA/HL7 and PCI/DSS</h4>
            </div>
            <div class="modal-body">
                <p>Coming Soon!</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
    var selectedVal;
    $(document).ready(function () {
        selectedVal = localStorage.getItem("selected-val");
        if (selectedVal) {
            $(".privilege").val(selectedVal);
            if (selectedVal == 4) {
                $('.privileged').css('display', 'block');
            }
        }
    });
    $('.privilege').change(function () {
        selectedVal = $(this).val();
        if (selectedVal == 4) {
            $('.privileged').css('display', 'block');
            window.location.href = "<?= Yii::$app->request->baseUrl ?>/courses-assigned/my-courses";
        } else {
            $('.privileged').css('display', 'none');
            window.location.href = "<?= Yii::$app->request->baseUrl ?>/site/index";
        }
        localStorage.setItem("selected-val", selectedVal, {expires: 365, path: '/'})
    });

    var body = document.body,
            html = document.documentElement;
    var height = Math.max(body.scrollHeight, body.offsetHeight,
            html.clientHeight, html.scrollHeight, html.offsetHeight);
    window.onload = function () {
        var x = height - 50;
        $('.sidebar').css('height', x);
        $.SidebarState = {};
        $.SidebarState.options = {
            EnableRemember: true,
            NoTransitionAfterReload: true
                    //Removes the transition after page reload.
        };
        $(function () {
            "use strict";
            $("body").on("collapsed.pushMenu", function () {
                if ($.SidebarState.options.EnableRemember) {
                    localStorage.setItem("toggleState", "closed");
                }
            });

            $("body").on("expanded.pushMenu", function () {
                if ($.SidebarState.options.EnableRemember) {
                    localStorage.setItem("toggleState", "opened");
                }
            });

            if ($.SidebarState.options.EnableRemember) {
                var toggleState = localStorage.getItem("toggleState");
                if (toggleState == 'closed') {
                    if (screen.width >= 767) {
                        $('.sidebar').css('overflow-y', 'unset');
                    }
                    if ($.SidebarState.options.NoTransitionAfterReload) {
                        $("body").addClass('sidebar-collapse hold-transition').delay(100).queue(function () {
                            $(this).removeClass('hold-transition');
                        });
                    } else {
                        $("body").addClass('sidebar-collapse');
                    }
                }
            }
        });
    }
</script>