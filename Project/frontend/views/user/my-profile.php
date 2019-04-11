<?php

use frontend\models\MasterRoleTypes;
use frontend\models\User;
use frontend\models\Company;
use frontend\models\BranchManagers;
use frontend\models\Learners;
use frontend\models\Address;
use frontend\models\Countries;
use frontend\models\States;
use frontend\models\Cities;
use frontend\models\CoursesAssigned;
use yii\helpers\Html;
$base_url = Yii::$app->request->baseUrl;
$roll = Yii::$app->user->identity->role_type;
$base = Yii::$app->controller->id . "/" . Yii::$app->controller->action->id;

$this->title = 'My Profile';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .notavailable{
        color:red;
    }
    .btn.btn-primary, .btn.btn-primary:hover, .btn.btn-primary:focus, .btn.btn-primary:active, .btn.btn-primary.active, .btn.btn-primary:active:focus, .btn.btn-primary:active:hover, .btn.btn-primary.active:focus, .btn.btn-primary.active:hover{
        padding: 12px 1px 7px 1px !important;
        width: 80px !important;
        margin: 10px 3px;
        background: #e91e63;
    }
</style>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class=" col-md-12">
                <div class="card">
                    <div class="card-header1  card-header-text" data-background-color="blue">
                        <h4 class="card-title">MY PROFILE</h4>
                    </div>
                    <div class="card-content">
                         <div class="col-md-12" style="overflow-x: auto;">
                        <?php
                        if ($roll == 1) {
                            $user = User::findOne(['id' => $model->id]);
                            // print_r($details);exit;
                            ?>
                            <table  class="table table-striped table-bordered detail-view">
                                <tbody>

                                    <tr><th>First Name</th><td><?php echo $model->first_name ?></td></tr>
                                    <tr><th>Last Name</th><td><?php echo $model->last_name ?></td></tr>
                                    <tr><th>Email</th><td><?php echo $model->email ?> </td></tr>
                                    <tr><th>Phone</th><td><?php echo $model->phone ?></td></tr>
                                </tbody>
                            </table>
                            <?php
                        } elseif ($roll == 2) {
                            $user = User::findOne(['id' => $model->id]);
                            $company = Company::findOne(['id' => $model2->id]);
                            $address= Address::findOne(['id' => $company->address_id]);
                            $countries= Countries::findOne(['id' =>$address ->country]);
                            $states= States::findOne(['id' =>$address->state]);
                            $cities= Cities::findOne(['id' =>$address->city])
                            ?>                      
                            <table  class="table table-striped table-bordered detail-view">
                                <tbody>

                                    <tr><th>First Name</th><td><?php echo $user->first_name ?></td></tr>
                                    <tr><th>Last Name</th><td><?php echo $user->last_name ?></td></tr>
                                    <tr><th>Email</th><td><?php echo $user->email ?></td></tr>
                                    <tr><th>Phone</th><td><?php echo $user->phone ?></td></tr>
                                    <tr><th>Company Name</th><td><?php echo $company->company_name  ?></td></td></tr>
                                    <tr><th>Fax</th>
                                        
                                    <?php if($company->fax != '') 
                                         {?>
                                    <td><?php echo $company->fax ?></td></tr>
                                    <?php
                                         }else { ?>
                                    <td class="notavailable"><?php echo $company->fax = 'Not Available' ?></td></tr>
                                    <?php } ?>
                                         
                                    <tr><th>Website</th><td><?php echo $company->website ?></td></tr>                                    
                                    <tr><th>Country</th><td><?php echo $countries->country_name?></td></tr>
                                    <tr><th>State</th><td><?php echo $states->state_name ?></td></tr>
                                    <tr><th>City</th><td><?php echo $cities->city_name ?></td></tr>
                                    <tr><th>Street</th><td><?php echo $address->street ?></td></tr>
                                    <tr><th>Pincode</th><td><?php echo $address->pincode ?></td></tr>
                                </tbody>
                            </table>
                            <?php
                        } elseif ($roll == 3) {
                            $user = User::findOne(['id' => $model->id]);
                            $branchmanagers = BranchManagers::findOne(['id' => $model3->id]);
                            ?>
                            <table  class="table table-striped table-bordered detail-view">
                                <tbody>

                                    <tr><th>First Name</th><td><?php echo $user->first_name ?></td></tr>
                                    <tr><th>Last Name</th><td><?php echo $user->last_name ?></td></tr>
                                    <tr><th>Email</th><td><?php echo $user->email ?></td></tr>                                   
                                    <tr><th>Phone</th><td><?php echo $user->phone ?></td></tr>

                                </tbody>             
                            </table>
                            <?php
                        } elseif ($roll == 4) {
                            $user = User::findOne(['id' => $model->id]);
                            $learners = Learners::findOne(['id' => $model4->id]);
                            $address= Address::findOne(['id' => $learners->address_id]);
                            $countries= Countries::findOne(['id' =>$address ->country]);
                            $states= States::findOne(['id' =>$address->state]);
                            $cities= Cities::findOne(['id' =>$address->city])
                            ?>                      
                           
                                <table  class="table table-striped table-bordered detail-view">
                                    <tbody>

                                    <tr><th>First Name</th><td><?php echo $user->first_name ?></td></tr>
                                    <tr><th>Last Name</th><td><?php echo ucfirst($user->last_name) ?></td></tr>
                                    <tr><th>Email</th><td><?php echo $user->email ?></td></tr>
                                    <tr><th>Alternate Email</th>

                                    <?php if ($learners->alternate_email != '') {
                                                    ?>
                                                    <td><?php echo $learners->alternate_email ?></td></tr>
                                    <?php } else {
                                                ?>
                                            <td class="notavailable"><?php echo $learners->alternate_email = 'Not Available' ?></td></tr>
                                    <?php } ?>

                                    <tr><th>Phone</th><td><?php echo $user->phone ?></td></tr>
                                    <tr><th>Country</th><td><?php echo $countries->country_name ?></td></tr>
                                    <tr><th>State</th><td><?php echo $states->state_name ?></td></tr>
                                    <tr><th>City</th><td><?php echo $cities->city_name ?></td></tr>
                                    <tr><th>Street</th><td><?php echo $address->street ?></td></tr>
                                    <tr><th>Pincode</th><td><?php echo $address->pincode ?></td></tr>
                                    </tbody>             
                                </table>
                        <?php }
                         elseif ($roll == 6) {
                            $user = User::findOne(['id' => $model->id]);
                            $learners = Learners::findOne(['id' => $model->id]);
                            ?>
                            <table  class="table table-striped table-bordered detail-view">
                                <tbody>

                                    <tr><th>First Name</th><td><?php echo $user->first_name ?></td></tr>
                                    <tr><th>Last Name</th><td><?php echo $user->last_name ?></td></tr>
                                    <tr><th>Email</th><td><?php echo $user->email ?></td></tr>                                 
                                    <tr><th>Phone</th><td><?php echo $user->phone ?></td></tr>

                                </tbody>             
                            </table>
                        <?php }?>
<div class="form-group">
    <?= Html::a('back', ['/site/index'], ['class' => 'btn btn-primary pull-right']) ?>  
</div>
                    </div>
                </div>
</div>
            </div>
        </div>
    </div>
</div>