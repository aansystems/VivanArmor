<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
$this->title = 'Dashboard';
?>
<style>
    .wrapper {
    height:auto !important;
}
.active-learners, .nonactive-learners {

    width: 43% !important;

}
.card-stats .title {
    margin: 0px;
    margin-top: 1%;
}
@media (max-width:1266px) and (min-width:1200px){
    .non_active{
            margin-top: -14px !important;
    }
}  
.card .card-header {
     margin: -20px 15px 0px 0px !important;

}

.form-control{
    margin-top: -12px;
}
.col-md-offset-2 {
    margin-left: 11.666667%;
}
.col-md-4 {
    width: 31.333333%;
}
#dropDown{
    margin: 2px 2px;
}
</style>
<div class="content" id="course">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header pull-right" data-background-color="blue">
                        <i class="fa fa-user-o" aria-hidden="true"></i>
                    </div>
                    <div class="dashblock">
                        <p class="category">Individual Learners</p>
                        <h3 class="title"><?= $users_ind ?></h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">update</i><span> Just new user registered</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header pull-right" data-background-color="blue">
                        <i class="fa fa-user" aria-hidden="true"></i>
                    </div>
                    <div class="dashblock">
                        <p class="category">Corporate Learners</p>
                        <h3 class="title"><?= $users_corp ?></h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">date_range</i><span> Last 24 Hours one corporate has registered</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header pull-right" data-background-color="blue">
                        <i class="material-icons">record_voice_over</i>
                    </div>
                    <div class="dashblock">
                       
                        <p class="category active-learners">
                             
                             <span><i class="fa fa-circle" aria-hidden="true" style="color:green;font-size: 9px"></i> &nbsp; Active learners</span>
                        </p>
                        <h3 class="title"><?= $users_ind +$users_corp ?></h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">access_time</i><span> Last 24 Hours</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header pull-right" data-background-color="blue">
                        <i class="fa fa-bed" aria-hidden="true"></i>
                    </div>
                    <div class="dashblock">

                        <p class="category nonactive-learners">
                              
                               <span> <i class="fa fa-circle" aria-hidden="true" style="color:red;font-size: 9px"></i> &nbsp;Non Active learners</span>
                        </p>
                        <h3 class="title non_active"><?= $users_nactive ?></h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">access_time</i><span> Last 24 Hours</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row" id="graph_container">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="blue">
                        <i class="material-icons">timeline</i><span class="headings">USERS TRENDS</span>
                    </div>
                    <div id="container_one"></div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="blue">
                        <i class="material-icons">timeline</i><span class="headings">COMPANIES PER MONTH</span>
                    </div>
                    <div id="container_two"></div>
                </div>
            </div>
        </div>

        <div class="row" id="graph_container">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header card-header-icon" data-background-color="blue">
                        <i class="material-icons">timeline</i><span class="headings">LEARNERS PER COURSE</span>
                    </div>
                    <div id="container_three"></div>
                    <div>
                    <div class="form-group text-center">
                        <div class="col-md-offset-2 col-md-4">
                        <label for="exampleFormControlSelect1" id="dropDown">
                            SELECT MONTH :</label>
                            </div>
                        <div class="col-md-3">
                        <select id="month_id" name="month" class="form-control">
                            <!-- <option value="" disabled="">Select...</option> -->
                            <?php
                            // Get first month for default display
                            $first_month = '';
                            $selectedstate = '';
                            foreach ($months_array2 as $months) {
                                if ($first_month == '') {
                                    $first_month = $months;
                                    $selectedstate = 'selected';
                                } else {
                                    $selectedstate = '';
                                }
                                ?>
                                <option value="<?= $months ?>" <?= $selectedstate ?>><?= date('M', strtotime($months)) ?></option>
                            <?php } ?>
                                
                        </select>
                    </div>
                        </div>
                                                </div>

                </div>
            </div>

            <div class="col-md-6">
                <div class="card more_info">
                    <div class="card-header card-header-icon" data-background-color="blue">
                        <i class="material-icons">info_outline</i><span class="headings">MORE INFO</span>
                    </div>
                    <div class="card-content">
                        <h3>Notes</h3>
                        <textarea class="text-area">Each Master Course has one instructor designated as the Administrator for that course. This Administrator has additional privileges over other instructors, including the ability to create new class sections, and new instructors and to change Master Course properties.</textarea>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header pull-right" data-background-color="blue">
                        <i class="fa fa-users" aria-hidden="true"></i>
                    </div>
                    <div class="dashblock">
                        <p class="category">Total Learners</p>
                        <h3 class="title"><?=  $users_ind +$users_corp+ $users_nactive ?></h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">access_time</i><span>Total Number Of Learners Registered </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="card card-stats">
                    <div class="card-header pull-right" data-background-color="blue">
                        <i class="fa fa-book" aria-hidden="true"></i>
                    </div>
                    <div class="dashblock">
                        <p class="category">Courses</p>
                        <h3 class="title"><?= $total_coursess ?></h3>
                    </div>
                    <div class="card-footer">
                        <div class="stats">
                            <i class="material-icons">access_time</i><span>Total Number Of Courses </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (Yii::$app->user->isGuest) {
    $menuItems[] = ['label' => 'Login', 'url' => ['/site/login']];
} else {
    $menuItems[] = '<li>'
            . Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                    'Logout (' . Yii::$app->user->identity->email . ')', ['class' => 'btn btn-link logout']
            )
            . Html::endForm()
            . '</li>';
}
?>

<script type="text/javascript">
    $(document).ready(function () {

        /*----- User Trends -----*/

        Highcharts.chart('container_one', {
            chart: {
                type: 'column'
            },
            title: {
                text: ''
            },
            xAxis: {
                categories: [<?= $final_months_array1 ?>],
                crosshair: true

            },
            yAxis: {
                title: {
                    text: null
                }
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                    name: 'Total no of Corporate Learners',
                    data: [<?= $final_company_users ?>],
                    color: '#4472C4'

                }, {
                    name: 'Total no of Individual Learners',
                    data: [<?= $final_individual_users ?>],
                    color: '#ED7D31'
                }]
        });

        /*----- Companies Per Month -----*/

        chart = Highcharts.chart('container_two', {
            title: {
                text: ''
            },
            xAxis: {
                categories: [<?= $final_months_array ?>]

            },
            series: [{
                    name: 'Total no of Companies',
                    data: [<?= $final_company_array ?>]
                }]
        });


        /*----- Start Show default Learners per Cource -----*/
         $('#month_id option:first').trigger('click'); 
    
        start_date = $('#month_id option:first').val();
        
        jQuery.get('site/course', {date: start_date}, function (data) {
            var data2 = [];
            var data = JSON.parse(data);
//             alert(data);
            
            for (var i = 0; i < data.length; i++) {
                for (var j = 0; j < data[0].length; j++) {
                    data2.push({'name': data[1][j], 'y': data[0][j]});

                }
                break;
            }
           

            Highcharts.chart('container_three', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: ''
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: false
                        },
                        showInLegend: true
                    }
                },
                series: [{
                        data: data2
                    }]
            });
       
    });


        /*----- End Show default Learners per Cource -----*/

    


    /*----- Learners Per Course -----*/

    jQuery('#month_id').change(function () {
        start_date = jQuery(this).val();
        jQuery.get('site/course', {date: start_date}, function (data) {
            var data2 = [];
            var data = JSON.parse(data);

            for (var i = 0; i < data.length; i++) {
                for (var j = 0; j < data[0].length; j++) {
                    data2.push({'name': data[1][j], 'y': data[0][j]});

                }
                break;
            }

            Highcharts.chart('container_three', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: ''
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: false
                        },
                        showInLegend: true
                    }
                },
                series: [{
                        data: data2
                    }]
            });
        });
    });
    });
</script>