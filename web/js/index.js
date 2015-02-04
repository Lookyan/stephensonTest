$(document).ready(function(){
    $("#start-test").submit(function(e) {
        if($.trim($("#fio").val()) == '') {
            alert("Необходимо ввести ФИО!");
            e.preventDefault();
        }
    });
});