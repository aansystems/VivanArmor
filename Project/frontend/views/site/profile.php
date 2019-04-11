<?php

use frontend\models\MasterRoleTypes;
use frontend\models\User;
use frontend\models\Company;
use frontend\models\BranchManagers;
use frontend\models\Learners;
use frontend\models\Address;

$base_url = Yii::$app->request->baseUrl;
$roll = Yii::$app->user->identity->role_type;
$base = Yii::$app->controller->id . "/" . Yii::$app->controller->action->id;
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class=" col-md-12">
                <div class="card">
                    <div class="card-header1  card-header-text" data-background-color="blue">
                        <h4 class="card-title">MY DETAILS</h4>
                    </div>
                    <div class="card-content">
                        <?php
                        if ($roll == 1) {
                            $user = Yii::$app->user->identity;
                            // print_r($details);exit;
                            ?>
                            <table  class="table table-striped table-bordered detail-view">
                                <tbody>
                                    <tr><th>First Name</th><td><?php echo $user->first_name ?></td></tr>
                                    <tr><th>Last Name</th><td><?php echo $user->last_name ?></td></tr>
                                    <tr><th>Email</th><td><?php echo $user->email ?> </td></tr>
                                    <tr><th>Phone</th><td><?php echo $user->phone ?></td></tr>
                                </tbody>
                            </table>
                            <?php
                        } elseif ($roll == 2) {
                            $user = Yii::$app->user->identity;
                            $company = Company::findOne(['id' => $model2->id]);
                            ?>                      
                            <table  class="table table-striped table-bordered detail-view">
                                <tbody>
                                    <tr><th>First Name</th><td><?php echo $user->first_name ?></td></tr>
                                    <tr><th>Last Name</th><td><?php echo $user->last_name ?></td></tr>
                                    <tr><th>Email</th><td><?php echo $user->email ?></td></tr>
                                    <tr><th>Phone</th><td><?php echo $user->phone ?></td></tr>
                                    <tr><th>Company Name</th><td><?php echo $company->company_name ?></td></td></tr>
                                    <tr><th>Fax</th><td><?php echo $company->fax ?></td></tr>
                                    <tr><th>Website</th><td><?php echo $company->website ?></td></tr>
                                    <tr><th>Country</th><td></td></tr>
                                    <tr><th>State</th><td></td></tr>
                                    <tr><th>City</th><td></td></tr>
                                    <tr><th>Street</th><td></td></tr>
                                    <tr><th>Pincode</th><td></td></tr>
                                    <tr><th>Courses Assigned</th><td></td></tr>
                                    <tr><th>Tiles Assigned</th><td></td></tr>
                                </tbody>
                            </table>

                            <?php
                        } elseif ($roll == 3) {
                            $user = Yii::$app->user->identity;
                            $branchmanagers = BranchManagers::findOne(['id' => $model3->id]);
                            ?>
                            <table  class="table table-striped table-bordered detail-view">
                                <tbody>
                                    <tr><th>First Name</th><td><?php echo $user->first_name ?></td></tr>
                                    <tr><th>Last Name</th><td><?php echo $user->last_name ?></td></tr>
                                    <tr><th>Email</th><td><?php echo $user->email ?></td></tr>
                                    <tr><th>Alternate Email</th><td></td></tr>
                                    <tr><th>Phone</th><td><td><?php echo $user->phone ?></td></tr>
                                    <tr><th>Mobile Number</th><td></td></tr>
                                    <tr><th>Country</th><td></td></tr>
                                    <tr><th>State</th><td></td></tr>
                                    <tr><th>City</th><td></td></tr>
                                    <tr><th>Street</th><td></td></tr>
                                    <tr><th>Pincode</th><td></td></tr>
                                    <tr><th>Courses Assigned</th><td></td></tr>
                                    <tr><th>Tiles Assigned</th><td></td></tr>
                                </tbody>             
                            </table>
                            <?php
                        } elseif ($roll == 4) {
                            $user = Yii::$app->user->identity;
                            $learners = Learners::findOne(['id' => $model4->id]);
                            ?>
                            <table  class="table table-striped table-bordered detail-view">
                                <tbody>
                                    <tr><th>First Name</th><td><?php echo $user->first_name ?></td></tr>
                                    <tr><th>Last Name</th><td><?php echo $user->last_name ?></td></tr>
                                    <tr><th>Email</th><td><?php echo $user->email ?></td></tr>
                                    <tr><th>Alternate Email</th><td><?php echo $learners->alternate_email ?></td></tr>
                                    <tr><th>Phone</th><td><?php echo $user->phone ?></td></tr>
                                    <tr><th>Mobile Number</th><td><?php echo $learners->alternate_phone ?></td></tr>
                                    <tr><th>Contact person</th><td><?php echo $learners->company_contact_person ?></td></tr>
                                    <tr><th>Country</th><td></td></tr>
                                    <tr><th>State</th><td></td></tr>
                                    <tr><th>City</th><td></td></tr>
                                    <tr><th>Street</th><td></td></tr>
                                    <tr><th>Pincode</th><td></td></tr>
                                    <tr><th>Courses Assigned</th><td></td></tr>
                                    <tr><th>Tiles Assigned</th><td></td></tr>
                                </tbody>             
                            </table>
                        <?php } ?>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>