$(document).ready(function () {
    startSlider(0);
});


function startSlider(idx) {
    $img = $("#slide div img").eq(idx);

    $img.fadeIn('slow', function () {
        $img.delay(5000).fadeOut('slow', function () {
            if ($("#slide div img").length - 1 == idx) {
                startSlider(0);
            } else {
                startSlider(idx + 1);
            }
        });
    });
}


$(document).ready(function () {
    $("div.bhoechie-tab-menu>div.list-group>a").click(function (e) {
        e.preventDefault();
        $(this).siblings('a.active').removeClass("active");
        $(this).addClass("active");
        var index = $(this).index();
        $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
        $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
    });
});