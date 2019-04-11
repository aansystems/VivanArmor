
<?php


use frontend\models\SuperAdminNotifications;
use frontend\models\CompanyNotifications;
use frontend\models\User;


$roll = Yii::$app->user->identity->role_type;
$added_by = Yii::$app->user->identity->created_by;
$base = Yii::$app->controller->id . "/" . Yii::$app->controller->action->id;
?>

<style>
    @media (max-width: 767px){
    .main-header .navbar{
        position: fixed;
    } 
    }
    </style>
    <header class="main-header">
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" id="clickButton" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <?php if($base == 'courses-assigned/my-courses'){ ?>
      <a class="navbar-brand" style="font-weight: 300;"> <strong>Adaptive Learning System</strong> </a>
      <?php } else { ?>
      <a class="navbar-brand" style="font-weight: 300;"> <strong>Vivaan-Armor</strong> </a>
      <?php } ?>
      <div class="navbar-custom-menu">
       
        <ul class="nav navbar-nav">
        
          <!-- Notifications: style can be found in dropdown.less -->
          <li class="dropdown notifications-menu">
             <?php if ($roll == 1) { ?> 
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell"></i>
              <span class="notification">                                    <?php
                                    $start_date = date('Y-m-01');  //hard coded date for month start
                                    $end_date = date('Y-m-t'); //hard coded date for month end
                                    $notifications = SuperAdminNotifications::find()->OrderBy(['id' => SORT_DESC])
                                                    ->where(['between', 'start_date', $start_date, $end_date])->all();
                                    $count = count($notifications);
                                    ?>
                                    <?php echo $count; ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <?php echo $count; ?> notifications</li>
              <li>
                 <?php } elseif ($roll == 2) { ?>
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="notification">                                    <?php
                                    $start_date = date('Y-m-01');  //hard coded date for month start
                                    $end_date = date('Y-m-t'); //hard coded date for month end
                                    $notifications = SuperAdminNotifications::find()->OrderBy(['id' => SORT_DESC])
                                                    ->where(['assigned_to' => Yii::$app->user->identity->id])
                                                    ->andWhere(['between', 'end_date', $start_date, $end_date])->all();
                                    $count = count($notifications);
                                    ?>
                                    <?php echo $count; ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <?php echo $count; ?> notifications</li>
              <li>
                   <?php } elseif ($roll == 3) { ?>
                                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-bell-o"></i>
              <span class="notification">                                    <?php
                                    $start_date = date('Y-m-01');  //hard coded date for month start
                                    $end_date = date('Y-m-t'); //hard coded date for month end
                                    $notifications = CompanyNotifications::find()->OrderBy(['id' => SORT_DESC])
                                                    ->where(['assigned_to' => Yii::$app->user->identity->id])
                                                    ->andWhere(['between', 'end_date', $start_date, $end_date])->all();
                                    $count = count($notifications);
                                    ?>
                                    <?php echo $count; ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <?php echo $count; ?> notifications</li>
              <li>
                  <?php } elseif ($roll == 4) { ?>
                  
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
              <i class="fa fa-bell-o"></i>
              <span class="notification">                
                          <?php
                                    /* query to fetch the created_by based on loged in user */
                                    $user = User::findOne(['id' => Yii::$app->user->identity->id]);
                                    $created_by = $user->created_by;
                                    if ($created_by == 1) {
                                        $start_date = date('Y-m-d'); //to take current date
                                        $end_date = date('Y-m-t');  //hard coded date for month end
                                        $notifications = SuperAdminNotifications::find()->OrderBy(['id' => SORT_DESC])
                                                        ->where(['assigned_to' => Yii::$app->user->identity->id])
                                                        ->andWhere(['between', 'end_date', $start_date, $end_date])->all();
                                        $count = count($notifications);
                                    } else {
                                        $start_date = date('Y-m-d'); //to take current date
                                        $end_date = date('Y-m-t');  //hard coded date for month end
                                        $notifications = CompanyNotifications::find()->OrderBy(['id' => SORT_DESC])
                                                        ->where(['assigned_to' => Yii::$app->user->identity->id])
                                                        ->andWhere(['between', 'end_date', $start_date, $end_date])->all();
                                        $count = count($notifications);
                                    }
                                    ?>
                                    <?php echo $count; ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="header">You have <?php echo $count; ?> notifications</li>
              <li>
                  
                  <?php }else{} ?> 
                <!-- inner menu: contains the actual data -->
                <ul class="menu">
                                    <?php if (!empty($notifications)) { ?>
                                    <?php foreach ($notifications as $notification) { ?>
                                        <?php $id = $notification->id; ?>
                                        <li id="myList">
                                            <a href="<?= Yii::$app->request->baseUrl ?>/site/notifications?id=<?= $id ?>">   
                                             <?php echo $notification->message; ?> </a>
                                        </li>
                                    <?php } ?>
                                    
                                    <?php  } ?>

           
              
                 
                </ul>
              </li>
             
            </ul>
          </li>


        </ul>
      </div>
    </nav>
  </header>
