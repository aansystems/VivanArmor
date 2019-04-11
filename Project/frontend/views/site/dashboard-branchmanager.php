<?php
use yii\helpers\Json;

$this->title = 'Dashboard';
?>
<style>
    .wrapper {
    height:auto !important;
}
#branch .more_info {
    height: 498px !important;
}
.stickynotes-card{
    height: 498px !important;
}
@media (max-width: 767px) {
.content-wrapper{
            margin-top: 40px !important;
        }
}
</style>
<div class="content" id="branch">
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header pull-right" data-background-color="blue">
                    <i class="fa fa-book" aria-hidden="true"></i>
                </div>
                <div class="dashblock">
                    <p class="category">COURSES</p>
                    <h3 class="title"><?= $final_branch_courses ?></h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">update</i><span>Just new user registered</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="card card-stats">
                <div class="card-header pull-right" data-background-color="blue">
                    <i class="fa fa-users" aria-hidden="true"></i>
                </div>
                <div class="dashblock">
                    <p class="category">USERS</p>
                    <h3 class="title"><?= $final_branch_learners ?></h3>
                </div>
                <div class="card-footer">
                    <div class="stats">
                        <i class="material-icons">update</i><span>Just new user registered</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="graph_container">
       <div class="col-md-6">
            <div class="card more_info">
                <div class="card-header card-header-icon" data-background-color="blue">
                    <i class="material-icons">info_outline</i> <span class="headings"> MORE INFO</span>
                </div>
                <div class="card-content">
                    <h3>Notes</h3>
                    <textarea class="text-area">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean convallis bibendum commodo. Pellentesque mattis odio et ante rhoncus, vel cursus velit aliquam. Interdum et malesuada fames ac ante ipsum primis in faucibus. Morbi consectetur, quam ut mollis sollicitudin, odio nisi fermentum orci, non ultrices ex turpis et ipsum. Cras vel nulla sit amet quam fringilla semper. Fusce hendrerit lorem imperdiet est lobortis, ac dapibus sapien sodales. Fusce tellus sem, accumsan ut dui ac, ultrices pulvinar odio. Morbi convallis diam ut elit porta molestie. Curabitur lacinia consectetur faucibus.</textarea>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header card-header-icon" data-background-color="blue">
                    <i class="material-icons">timeline</i><span class="headings">USERS vs COURSE</span>
                </div>
                <div id="container_two"></div>

                <div class="form-group text-center">
                    <label for="exampleFormControlSelect1" id="dropDown">
                        SELECT COURSES :</label>
                    <select id="course_id" name="course">
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
        <div class="col-md-6">
            <div class="card stickynotes-card">
                <div class="card-header card-header-icon" data-background-color="blue">
                    <i class="material-icons">timeline</i><span class="headings">COURSE INDEX TREND</span>
                </div>

                <div class="learner-trend" id="container_three"></div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card more_info">
                <div class="card-header card-header-icon" data-background-color="blue">
                    <i class="material-icons">info_outline</i> <span class="headings"> MORE INFO</span>
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
if ($first_course != '') {
    ?>

            course_id = <?= $first_course['id'] ?>;
            jQuery.get('site/branch', {id: course_id}, function (data) {
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
                    categories: [learners_data.course_name],
                    title: {
                        text: null
                    }
                },
                yAxis: {
                    title: {
                        text: '',
                        align: 'high'
                    },
                    labels: {
                        overflow: 'justify'
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

    /*----- Users vs Course -----*/
    jQuery('#course_id').change(function () {
        course_id = jQuery(this).val();
        jQuery.get('site/branch', {id: course_id}, function (data) {
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
                    categories: [learners_data.course_name],
                    title: {
                        text: null
                    }
                },
                yAxis: {
                    title: {
                        text: '',
                        align: 'high'
                    },
                    labels: {
                        overflow: 'justify'
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