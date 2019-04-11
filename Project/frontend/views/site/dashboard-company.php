<?php


use yii\helpers\Json;

$this->title = 'Dashboard';
?>
<style>
    .wrapper {
    height:auto !important;
}
</style>
<div class="content" id="company">
    <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header pull-right" data-background-color="blue">
                    <i class="fa fa-book" aria-hidden="true"></i>
                </div>
                <div class="dashblock">
                    <p class="category">Total Courses</p>
                    <h3 class="title"><?= $total_courses ?></h3>
                </div>
                <div class="card-footer">
                    <div class="stats"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header pull-right" data-background-color="blue">
                    <i class="material-icons">people_outline</i>
                </div>
                <div class="dashblock">
                    <p class="category">Total Number of User License </p>
                    <h3 class="title"><?= $no_of_license ?> </h3>
                </div>
                <div class="card-footer">
                    <div class="stats"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header pull-right" data-background-color="blue">
                    <i class="material-icons">record_voice_over</i>
                </div>
                <div class="dashblock">
                    <p class="category">Active Users</p>
                    <h3 class="title"><?= $active_users ?></h3>
                </div>
                <div class="card-footer">
                    <div class="stats"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header pull-right" data-background-color="blue">
                    <i class="fa fa-bed" aria-hidden="true"></i>
                </div>
                <div class="dashblock">
                    <p class="category">Non Active Users</p>
                    <h3 class="title"><?= $non_active_users ?></h3>
                </div>
                <div class="card-footer">
                    <div class="stats"></div>
                </div>
            </div>
        </div>
    </div>


    <div class="row" id="graph_container">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="blue">
                    <i class="material-icons">timeline</i><span class="headings">Branch Stats</span>
                </div>              
                <div id="container_one"></div>

                <div class="form-group text-center">
                    <label for="exampleFormControlSelect1" id="dropDown">
                        SELECT BRANCH :</label>
                    <select id="branch_id" name="branch">
                        <!--                        <option value="" disabled="" selected>Select...</option>   -->
                        
                        <?php 
                         $first_branch = '';
                        $selectedbranch = '';
                        foreach ($branches as $branch) {
                            if ($first_branch == '') {
                                $first_branch = $branch;
                                 $selectedbranch = 'selected';
                            } else {
                                 $selectedbranch = '';
                            }
                            ?>
                            <option value="<?php echo $branch['id'] ?>"><?php echo $branch['branch_name'] ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="blue">
                    <i class="material-icons">timeline</i><span class="headings">Course Stats</span>
                </div>
                <div id="container_two"></div>

                <div class="form-group text-center">
                    <label for="exampleFormControlSelect1" id="dropDown">
                        SELECT COURSES :</label>
                    <select id="course_id" name="course">
                        <!--                        <option value="" disabled="" selected>Select...</option>   -->
                        <?php
                        $first_course = '';
                        $selectedcourse = '';
                        foreach ($assigned_courses as $courses) {
                            if ($first_course == '') {
                                $first_course = $courses;
                                 $selectedcourse = 'selected';
                            } else {
                                 $selectedcourse = '';
                            }
                            ?>
                            <option value="<?= $courses['id'] ?>"><?= $courses['course_name'] ?></option>
<?php } ?>
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="graph_container">
        <div class="col-md-6" >
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="blue">
                    <i class="material-icons">timeline</i><span class="headings">Course Index Trend</span>
                </div>
                <div  class="learner-trend" id="container_three"></div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card more_info">
                <div class="card-header card-header-icon" data-background-color="blue">
                    <i class="material-icons">info_outline</i> <span class="headings">More Info</span>
                </div>
                <div class="card-content">
                    <h3>Notes</h3>
                    <textarea class="text-area">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean convallis bibendum commodo. Pellentesque mattis odio et ante rhoncus, vel cursus velit aliquam. Interdum et malesuada fames ac ante ipsum primis in faucibus. Morbi consectetur, quam ut mollis sollicitudin, odio nisi fermentum orci, non ultrices ex turpis et ipsum. Cras vel nulla sit amet quam fringilla semper. Fusce hendrerit lorem imperdiet est lobortis, ac dapibus sapien sodales. Fusce tellus sem, accumsan ut dui ac, ultrices pulvinar odio. Morbi convallis diam ut elit porta molestie. Curabitur lacinia consectetur faucibus.</textarea>
                </div>              
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    <?php
if ($first_branch != '') {
    ?>

            branch_id = <?= $first_branch['id'] ?>;
            jQuery.get('site/company', {id: branch_id}, function (data) {
            branch_data = jQuery.parseJSON(data);
            count = branch_data.count_learners;

            course_data = jQuery.parseJSON(data);
            count = course_data.count_courses;

            tile_data = jQuery.parseJSON(data);
            count = tile_data.count_tiles;

            Highcharts.chart('container_one', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: ''
                },

                xAxis: {
                    categories: [branch_data.branch_name],
                    title: {
                        text: null
                    }
                },
                yAxis: {
                    title: {
                        text: ''
                    }
                },
                series: [{
                        name: 'No of Learners',
                        data: JSON.parse("[" + branch_data.count_learners + "]"),
                        color: '#4472C4'

                    }, {
                        name: 'No of Courses',
                        data: JSON.parse("[" + course_data.count_courses + "]"),
                        color: '#ED7D31'
                    }, {
                        name: 'No of Key Materials',
                        data: JSON.parse("[" + tile_data.count_tiles + "]"),
                        color: '#A5A5A5'
                    }]
            });
        });

    <?php
}
?>
</script>
<script type="text/javascript">
    
    /*----- Branch Stats -----*/
    jQuery('#branch_id').change(function () {
        branch_id = jQuery(this).val();
        jQuery.get('site/company', {id: branch_id}, function (data) {
            branch_data = jQuery.parseJSON(data);
            count = branch_data.count_learners;

            course_data = jQuery.parseJSON(data);
            count = course_data.count_courses;

            tile_data = jQuery.parseJSON(data);
            count = tile_data.count_tiles;

            Highcharts.chart('container_one', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: ''
                },

                xAxis: {
                    categories: [branch_data.branch_name],
                    title: {
                        text: null
                    }
                },
                yAxis: {
                    title: {
                        text: ''
                    }
                },
                series: [{
                        name: 'No of Learners',
                        data: JSON.parse("[" + branch_data.count_learners + "]"),
                        color: '#4472C4'

                    }, {
                        name: 'No of Courses',
                        data: JSON.parse("[" + course_data.count_courses + "]"),
                        color: '#ED7D31'
                    }, {
                        name: 'No of Key Materials',
                        data: JSON.parse("[" + tile_data.count_tiles + "]"),
                        color: '#A5A5A5'
                    }]
            });
        });
    });
</script>
<script type="text/javascript">
    <?php
if ($first_course != '') {
    ?>

            course_id = <?= $first_course['id'] ?>;
            jQuery.get('site/companyone', {id: course_id}, function (data) {
                //alert(data);
            learners_data = jQuery.parseJSON(data);
            count = learners_data.count_learners;

            course_data = jQuery.parseJSON(data);
            count = course_data.count_score;

            Highcharts.chart('container_two', {
                chart: {
                    type: 'bar'
                },
                title: {
                    text: ''
                },
                xAxis: {
                    categories: [learners_data.course_name]
                },
                yAxis: {
                    title: {
                        text: '',
                        align: 'high'
                    }
                },
                series: [{
                        name: 'Current Score Index',
                        data: JSON.parse("[" + course_data.count_score + "]"),
                        color: '#ED7D31'
                    }, {
                        name: 'No of Learners',
                        data: JSON.parse("[" + learners_data.count_learners + "]"),
                        color: '#4472C4'
                    }]
            });
        });

    <?php
}
?>
</script>
<script type="text/javascript">

    /*----- Course Stats -----*/
    jQuery('#course_id').change(function () {
        course_id = jQuery(this).val();
        jQuery.get('site/companyone', {id: course_id}, function (data) {
            learners_data = jQuery.parseJSON(data);
            count = learners_data.count_learners;

            course_data = jQuery.parseJSON(data);
            count = course_data.count_score;

            Highcharts.chart('container_two', {
                chart: {
                    type: 'bar'
                },
                title: {
                    text: ''
                },
                xAxis: {
                    categories: [learners_data.course_name]
                },
                yAxis: {
                    title: {
                        text: '',
                        align: 'high'
                    }
                },
                series: [{
                        name: 'Current Score Index',
                        data: JSON.parse("[" + course_data.count_score + "]"),
                        color: '#ED7D31'
                    }, {
                        name: 'No of Learners',
                        data: JSON.parse("[" + learners_data.count_learners + "]"),
                        color: '#4472C4'
                    }]
            });
        });
    });
</script>

<script type="text/javascript">

    /*----- Course Index Trend -----*/
    var courses = [];
    $(document).ready(function () {
        var data =<?php echo Json::encode($final_courses); ?>;
        data = JSON.parse(data);
        for (var i = 0; i < data.length; i++) {
            for (var j = 0; j < data[i].length; j++) {
                courses.push(data[i][j]);
            }
        }

        Array.prototype.getDuplicates = function () {
            var duplicates = {};
            for (var i = 0; i < this.length; i++) {
                if (duplicates.hasOwnProperty(this[i].course_name)) {
                    duplicates[this[i].course_name].push(i);
                } else if (this.lastIndexOf(this[i].course_name) !== i) {
                    duplicates[this[i].course_name] = [i];
                }
            }
            return duplicates;
        };

        var finalData = [];
        var remainingData = courses.getDuplicates();
        for (var key in remainingData) {
            var arr = [];
            for (var i = 0; i < remainingData[key].length; i++) {
                arr.push(Number(courses[remainingData[key][i]].count_courses));
            }
            finalData.push({"name": key, "data": arr});
        }

        Highcharts.chart('container_three', {
            chart: {
                type: 'line'
            },
            title: {
                text: ''
            },
            xAxis: {
                categories: [<?= $final_months_array ?>]
            },
            yAxis: {
                min: 0,
                max: 100,
                tickInterval: 20,
                lineColor: '',
                lineWidth: 3,
                title: {
                    text: ''
                }
            },

           plotOptions: {
                line: {
                    dataLabels: {
                        enabled: false
                    },
                    enableMouseTracking: true
                }
            },
            series: finalData
        });
    });
</script>
