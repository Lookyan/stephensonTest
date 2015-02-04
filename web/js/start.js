$(document).ready(function(){
    init();

    function init() {
        nextStatement(true);
    }

    $("#next").click(function (event) {
        event.preventDefault();
        $("#next").attr('disabled','disabled');
        $("#statement").animate({ width: "hide" }, 300);
        nextStatement(false);
    });

    function nextStatement(isFirst) {
        var href = $("#next").attr('href');
        var data;
        if(isFirst) {
            data = "";
        } else {
            data = "selection=" + $("input[name=selection]:checked").val();
        }
        $.ajax({
            type: "POST",
            url: href,
            data: data + '&_csrf=' + yii.getCsrfToken(),
            success: function(msg){
                if(msg.status == "OK") {
                    $("#statement").text(msg.statement);
                    var q_number = $("#q_number");
                    q_number.text(Number(q_number.text()) + 1);
                    $("#statement").animate({ width: "show" }, 300);
                    $("#next").removeAttr("disabled");
                } else if(msg.status == "finish") {
                    window.location.href = $("#next").data("compute");
                }
            }
        });
    }

});