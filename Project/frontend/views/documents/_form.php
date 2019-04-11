
<?php
$base_url = Yii::$app->request->baseUrl;
$base = Yii::$app->controller->id . "/" . Yii::$app->controller->action->id;

$this->title = 'DMS Form';
$this->params['breadcrumbs'][] = $this->title;

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use frontend\models\MasterDocTemplates;
use frontend\models\User;
use kartik\date\DatePicker;

$this->registerCssFile('@web/css/progressbar.css', ['depends' => [\frontend\assets\AppAsset::className()], 'position' => \yii\web\View::POS_HEAD]);
?>

<style>
    .help-block  {
        margin-top: 15px;
    }
    .form-group input[type=file]{
        opacity: 1 !important;
        position: initial;
        padding-top:10px;
        z-index: 1;
    }
    .form-control{
        background-color: white;
    }

    .final-form{
        margin-top: 30px;

    }

    .select2-container .select2-selection--single .select2-selection__rendered {
        padding:5px !important;

        .hide {
            display: none;
        }

        .select-drop select{
            margin-top: 20px !important;
        } 
        .form-group{
            height: 100px;
        }
        
    </style>

    <?php $form = ActiveForm::begin(); ?>
    <div class="content" id="questions-module">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header1 card-header-text" data-background-color="blue">
                            <h4 class="card-title">DMS FORM</h4>
                        </div>

                        <div class="card-content">           
                            <div class="document row">
                                <h3 class="heading">Document Details</h3>
                                <div class="col-md-4 col-sm-12" style="height:100px !important;" >
                                    <div class="form-group required">
                                        <?= $form->field($model, 'document_name')->textInput(['maxlength' => true]) ?>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6" style="height:100px !important;" >
                                    <div class="form-group required">
                                        <?=
                                        $form->field($model, 'document_type')->widget(Select2::classname(), [
                                            'options' => ['placeholder' => 'Select Template Type','id'=>'doc_type'],
                                            'data' => ArrayHelper::map(MasterDocTemplates::find()->all(), 'id', 'template_name'),
                                            'pluginOptions' => [
                                                'allowClear' => true,
                                                
                                            ],
                                        ])->label('Template Type')
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-4 col-sm-6" style="height:100px !important;" >
                                    <div class="form-group required">
                                        <?= $form->field($model, 'file')->fileInput()->label('Upload'); ?>
                                    </div>
                                </div>
                              <div class="row" style="margin-top: 30px !important;" >
                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group required">
                                        <?= $form->field($model, 'document_description')->textarea(['rows' => 3]) ?>
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12">
                                    <div class="form-group required">
                                        <?= $form->field($model, 'author_comment')->textarea(['rows' => 3])->label('Author Comments') ?>
                                    </div>
                                </div>
                                </div>
                            </div>


                            <div class="author row">

                                <div class="row">
                                    <div class="col-md-3">  <h3 class="heading">Workflow Details</h3></div>
                                </div>

                                <div class="row">
                                    <div class="col-md-2"> <label class="final-form" style="color:black;">Next Steps:</label></div>
                                    <div class="col-md-4" style="margin-top: 20px !important;">
                                        <select class="div-toggle" data-target=".my-info-1" style="padding: 8px;background-color:#c1c1c1;font-weight:400; ">
                                            <option  data-show=".fina">Finalize Document</option>
                                            <option  data-show=".revie">Assign For Review</option>
                                        </select>
                                    </div>
                                </div>


                                    <div class="my-info-1" >

                                        <div class="fina hide">
                                               <div class="row">
                                              <div class="col-md-4">
                                                <div class="form-group required">

                                                    <?php
                                                    echo '<label class="control-label">Document Expiry Date</label>';
                                                    echo DatePicker::widget([
                                                        'model' => $model2,
                                                        'attribute' => 'expiry_date',
                                                        'name' => 'Expiry_date',
                                                        'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                                        'pluginOptions' => [
                                                            'autoclose' => true,
                                                            'format' => 'yyyy-mm-dd',
                                                            'startDate' => date("Y-m-d"),
                                                            'todayHighlight' => true,
                                                        ]
                                                    ]);
                                                    ?>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="row">
                                            <div class="col-md-6" style="margin-top: 35px !important;">
                                                <div class="form-group required">

                                                    <?=
                                                    $form->field($model2, 'assigned_for_view')->widget(Select2::classname(), [
                                                        'options' => ['placeholder' => 'Select Who Can Only View Document', 'id'=>'select1'],
                                                     'data' => ArrayHelper::map(User::find()->where(['<>', 'id', Yii::$app->user->identity->id])->andWhere(['=', 'status', 10])->all(), 'id', 'email'),
                                                        'pluginOptions' => [
                                                            'allowClear' => true,
                                                            'multiple' => 'multiple',
                                                          
                                                        ],
                                                    ])->label('View only')
                                                    ?>
                                                </div>
                                            </div>
                                           
                                            <div class="col-md-6" style="margin-top: 35px !important;">
                                                <div class="form-group required">

                                                    <?=
                                                    $form->field($model2, 'assigned_for_download')->widget(Select2::classname(), [
                                                        'options' => ['placeholder' => 'Select Who Can View and Download Document', 'id'=>'select2'],
                                                        'data' => ArrayHelper::map(User::find()->where(['<>', 'id', Yii::$app->user->identity->id])->andWhere(['=', 'status', 10])->all(), 'id', 'email'),
                                                        'pluginOptions' => [
                                                            'allowClear' => true,
                                                            'multiple' => 'multiple',
                                                            
                                                        ],
                                                    ])->label('View And Download')
                                                    ?>
                                                </div>
                                            </div>
                                            </div>
                                            
                                             <div class="row">
                                            <div class="col-md-6" style="margin-top: 35px !important;">
                                                <div class="form-group required">

                                                    <?=
                                                    $form->field($model2, 'security')->widget(Select2::classname(),[
                                                        
                                                            'data' => ['Restricted' => 'Restricted', 'Confidential' => 'Confidential', 'Internal Use' => 'Internal Use','Public' => 'Public'] 
                                                    ])->label('Security For Documents')
                                                    ?>
                                                         </div>
                                            </div>
                                             </div>
                                          
                                        </div>


                                        <div class="revie hide">
                                            <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group required">

                                                    <?php
                                                    echo '<label class="control-label">Workflow Expiry Date</label>';
                                                    echo DatePicker::widget([
                                                        'model' => $model1,
                                                        'attribute' => 'workflow_expiry_date',
                                                        'name' => 'workflow_expiry_date',
                                                        'type' => DatePicker::TYPE_COMPONENT_APPEND,
                                                        'pluginOptions' => [
                                                            'autoclose' => true,
                                                            'format' => 'yyyy-mm-dd',
                                                            'todayHighlight' => true,
                                                        ]
                                                    ]);
                                                    ?>
                                                </div>
                                            </div>
                                            </div>
                                            
                                            <div class="col-md-5" style="margin-top: 35px !important;">
                                                <div class="form-group required">

                                                    <?=
                                                    $form->field($model1, 'assigned_to')->widget(Select2::classname(), [
                                                        'options' => ['placeholder' => 'Select User To Assign'],
                                                      'data' => ArrayHelper::map(User::find()
                                                                        ->where("`id`" . " !='" . Yii::$app->user->identity->id . "'")
                                                                        ->andwhere(['status' => 10])
                                                                        ->all(), 'id', 'email'),
                                                        'pluginOptions' => [
                                                            'allowClear' => true,
                                                        ],
                                                    ])->label('Assign For Review')
                                                    ?>
                                                </div>
                                            </div>

                                            
                                        </div>
                                    </div>
                                </div>                            
                            </div>


                            <div class="form-group pull-right">
                                <?= Html::a('Cancel', ['/documents/index'], ['class' => 'btn btn-danger']) ?>
                                <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
                            </div>
                        </div>
                    </div></div></div></div></div>
    <?php ActiveForm::end(); ?>
    <script>
        function myFunction() {
            $('.preview-template').show();
        }

        $(document).ready(function () {
            $(document).on('change', '.div-toggle', function () {

                var target = $(this).data('target');
                var show = $("option:selected", this).data('show');
                $(target).children().addClass('hide');
                $(show).removeClass('hide');
            });
        });
        $(document).ready(function () {
            $('.div-toggle').trigger('change');
        });
        
var ids = [];
    var i = 0;
    $('#select1').change(function () {
        ids = $(this).val();
        var options=$('#select1 option').clone();
        $('#select2').html( options.clone());
          for (i = 0; i < ids.length; i++) {
            $('#select2 option[value= ' + ids[i] + ']').remove();
        }
    });
    </script>
