<style>
    .counter {
        background-image: linear-gradient(120deg, #fdfbfb 0%, #ebedee 100%);
        padding-top: 10px;
        padding-bottom: 0;
        border-radius: 5px;
        box-shadow: 0 1px 4px 0 rgba(7, 7, 7, 0.16);
    }

    .count-title {
        color: #6D6D6D;
        font-size: 40px;
        font-weight: 300;
        margin-top: 10px;
        margin-bottom: 0;
        text-align: center;
    }

    .count-text {
        font-size: 13px;
        font-weight: normal;
        margin-top: 10px;
        margin-bottom: 0;
        text-align: center;
    }

    .card-footer {
        padding-top: 5px !important;
        border-top: 1px solid #DADADA !important;
    }

    .card-footer h6 {
        font-weight: 600;
    }

    .col-md-offset-2 {
        margin-left: 12.8%;
    }

    .marks-scored-block {
        border-top: 5px solid #ffb347;
    }

    .marks-scored-block h2 {
        display: inline-block;
    }

    .marks-scored-block .card-footer h6 {
        color: #ffb347;
    }

    .marks-scored, .marks-scored:active, .marks-scored:focus {
        background-color: #ffb347 !important;
        background: #ffb347;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to right, #ffcc33, #ffb347);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #ffcc33, #ffb347); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
        border-radius: 50%;
        padding: 12px 16px !important;
    }

    .question-block {
        border-top: 5px solid #7259b5;
    }

    .question, .question:active, .question:focus {
        background-image: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-radius: 50%;
        color: #FFFFFF !important;
        padding: 12px 20px !important;
    }

    .question-block .card-footer h6 {
        color: #7259b5;
    }

    .correct-block {
        border-top: 5px solid #00e3ae;
    }

    .correct, .correct:active, .correct:focus {
        background-image: linear-gradient(to top, #9be15d 0%, #00e3ae 100%);
        border-radius: 50%;
        color: #FFFFFF !important;
        padding: 12px 14px !important;
    }

    .correct-block .card-footer h6 {
        color: #26dab0;
    }

    .wrong-block {
        border-top: 5px solid #FE5194;
    }

    .wrong, .wrong:active, .wrong:focus {
        background-color: #FE5194 !important;
        background-image: linear-gradient(to top, #f77062 0%, #fe5196 100%);
        border-radius: 50%;
        color: #FFFFFF !important;
        padding: 12px 17px !important;
    }

    .wrong-block .card-footer h6 {
        color: #FE5194;
    }

    .btn:not(.btn-just-icon):not(.btn-fab) .fa, .navbar .navbar-nav > li > a.btn:not(.btn-just-icon):not(.btn-fab) .fa {
        font-size: 30px;
    }
    .container-fluid{
    margin-top: 3% !important;
}
    @media (max-width: 1120px) and (min-width: 992px){
        .col-md-3 {
    width: 30%;
}
.col-md-offset-2 {
    margin-left: 5.8%;
}
.btn:not(.btn-just-icon):not(.btn-fab) .fa{
    margin-top: 0px;
}
.container-fluid{
    margin-top: 3% !important;
}
    }
    @media (max-width: 991px) and (min-width: 768px){
        .btn:not(.btn-just-icon):not(.btn-fab) .fa{
    margin-top: 0px;
}
.container-fluid{
    margin-top: 3% !important;
}
        .col-md-3 {
    width: 33%;
    padding-right: 10px;
    padding-left: 10px;
}
.col-md-offset-2 {
    margin-left: 0.8%;
}
.card .card-footer{
    margin: 0 0px 0px;
}.col-sm-4 {
    width: 40.33333333%;
}
.col-sm-offset-4 {
    margin-left: 29.333333%;
}
    }
    @media (max-width: 767px) and (min-width: 551px){
        .btn:not(.btn-just-icon):not(.btn-fab) .fa{
    margin-top: 0px;
}
.container-fluid{
    margin-top: 8% !important;
}
        .col-md-3 {
    width: 33%;
    padding-right: 10px;
    padding-left: 10px;
}
.col-md-offset-2 {
    margin-left: 0.8%;
}
.card .card-footer{
    margin: 0 0px 0px;
}.col-sm-4 {
    width: 40.33333333%;
}
.col-sm-offset-4 {
    margin-left: 29.333333%;
}
    }
  @media (max-width: 550px) and (min-width: 320px){  
      .wrong{
          padding: 7px 10px 7px 10px!important;
      }
      .correct{
          padding: 8px 10px 8px 10px!important;
      }
      .question{
          padding: 8px 12px 8px 12px!important;
      }
      .btn:not(.btn-just-icon):not(.btn-fab) .fa{
          font-size: 17px;
      }
      .count-title{
          font-size: 30px;
          margin-top: 3px;
      }
      .col-xs-offset-4 {
    margin-left: 21.333333%;
}
.col-xs-4 {
    width: 60.333333%;
}
.col-md-offset-2 {
    margin-left: -3.2%;
}
.col-xs-3 {
    width: 34%;
    padding-right: 5px;
    padding-left: 5px;
    
}
.card .card-footer{
    margin: 0 3px 3px;
}
.row {
    margin-right: -18px !important;
}
h6{
    font-size: 0.8em;
}
.container-fluid{
    margin-top: 12% !important;
}
  }
</style>

<div class="container-fluid">
    <div class="card">
        <div class="card-header1 card-header-text" data-background-color="blue">
            <h4 class="card-title text-uppercase">Quiz Result</h4>
        </div>
        <div class="card-content"><br/><br/>
            <div class="row text-center">
                <div class="col-md-4 col-sm-4 col-xs-4 col-md-offset-4 col-sm-offset-4 col-xs-offset-4">
                    <div class="counter marks-scored-block">
                        <button class="btn btn-sm marks-scored"><i class="fa fa-star"></i></button><br/>
                        <h2 class="timer count-title count-number" data-to="<?= $total_marks ?>" data-speed="1500"></h2><h2>%</h2>
                        <div class="card-footer">
                            <h6 class="text-uppercase">Marks Scored</h6>
                        </div>
                    </div>
                </div>
            </div><br/><br/>

            <div class="row text-center">
                <div class="col-md-3 col-sm-3 col-xs-3 col-md-offset-2 col-sm-offset-2 col-xs-offset-2">
                    <div class="counter question-block">
                        <button class="btn btn-sm question"><i class="fa fa-question"></i></button>
                        <h2 class="timer count-title count-number" data-to="<?= $question_count ?>" data-speed="1500"></h2>
                        <div class="card-footer">
                            <h6 class="text-uppercase">Total Questions</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <div class="counter correct-block">
                        <button class="btn btn-sm correct"><i class="fa fa-check"></i></button>
                        <h2 class="timer count-title count-number" data-to="<?= $total_correct ?>" data-speed="1500"></h2>
                        <div class="card-footer">
                            <h6 class="text-uppercase">Total Correct</h6>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <div class="counter wrong-block">
                        <button class="btn btn-sm wrong"><i class="fa fa-times"></i></button>
                        <h2 class="timer count-title count-number" data-to="<?= $total_incorrect ?>" data-speed="1500"></h2>
                        <div class="card-footer">
                            <h6 class="text-uppercase">Total Incorrect</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div><br/><br/><br/>
    </div>
</div>

<script>
    (function ($) {
        $.fn.countTo = function (options) {
            options = options || {};

            return $(this).each(function () {
                // set options for current element
                var settings = $.extend({}, $.fn.countTo.defaults, {
                    from: $(this).data('from'),
                    to: $(this).data('to'),
                    speed: $(this).data('speed'),
                    refreshInterval: $(this).data('refresh-interval'),
                    decimals: $(this).data('decimals')
                }, options);

                // how many times to update the value, and how much to increment the value on each update
                var loops = Math.ceil(settings.speed / settings.refreshInterval),
                        increment = (settings.to - settings.from) / loops;

                // references & variables that will change with each update
                var self = this,
                        $self = $(this),
                        loopCount = 0,
                        value = settings.from,
                        data = $self.data('countTo') || {};

                $self.data('countTo', data);

                // if an existing interval can be found, clear it first
                if (data.interval) {
                    clearInterval(data.interval);
                }
                data.interval = setInterval(updateTimer, settings.refreshInterval);

                // initialize the element with the starting value
                render(value);

                function updateTimer() {
                    value += increment;
                    loopCount++;

                    render(value);

                    if (typeof (settings.onUpdate) == 'function') {
                        settings.onUpdate.call(self, value);
                    }

                    if (loopCount >= loops) {
                        // remove the interval
                        $self.removeData('countTo');
                        clearInterval(data.interval);
                        value = settings.to;

                        if (typeof (settings.onComplete) == 'function') {
                            settings.onComplete.call(self, value);
                        }
                    }
                }

                function render(value) {
                    var formattedValue = settings.formatter.call(self, value, settings);
                    $self.html(formattedValue);
                }
            });
        };

        $.fn.countTo.defaults = {
            from: 0, // the number the element should start at
            to: 0, // the number the element should end at
            speed: 1000, // how long it should take to count between the target numbers
            refreshInterval: 100, // how often the element should be updated
            decimals: 0, // the number of decimal places to show
            formatter: formatter, // handler for formatting the value before rendering
            onUpdate: null, // callback method for every time the element is updated
            onComplete: null       // callback method for when the element finishes updating
        };

        function formatter(value, settings) {
            return value.toFixed(settings.decimals);
        }
    }(jQuery));

    jQuery(function ($) {
        // custom formatting example
        $('.count-number').data('countToOptions', {
            formatter: function (value, options) {
                return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
            }
        });

        // start all the timers
        $('.timer').each(count);

        function count(options) {
            var $this = $(this);
            options = $.extend({}, options || {}, $this.data('countToOptions') || {});
            $this.countTo(options);
        }
    });
</script>


