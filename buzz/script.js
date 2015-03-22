/*      Copyright © 2015 - sayitagain.pw
 *      Author - Dmitry Kuznetsov
 */
var iid = null; var tid = null;
function addlearner() {
    var nick = $("#nick").val();
    var skype = $("#skype").val();
    var icq = $("#icq").val();
    var age = $("#age").val();
    var sex = $("#sex").val();
    var goal = $("#goal").val();
    var language = $("#language").val();
    var location = getString($("#location").val(),"--");
    var level = $("#level").val();
    saveUserInfo();
    $.ajax({
        type: "POST",
        url: "addlearner.php",
        data: {
                nick:nick,
                skype:skype,
                icq:icq,
                age:age,
                sex:sex,
                goal:goal,
                language:language,
                location:location,
                level:level
        },
        success: function(data){
            $("#submit").show();

            $("#learners").html(data);
        },
        dataType: "html"  
    });
    }

function saveUserInfo() {
    $.cookie('nick', $("#nick").val(), { expires: 365, path: '/' });
    $.cookie('skype', $("#skype").val(), { expires: 365, path: '/' });
    $.cookie('icq', $("#icq").val(), { expires: 365, path: '/' });
    $.cookie('age', $("#age").val(), { expires: 365, path: '/' });
    $.cookie('sex', $("#sex").val(), { expires: 365, path: '/' });
    $.cookie('goal', $("#goal").val(), { expires: 365, path: '/' });
    $.cookie('language', $("#language").val(), { expires: 365, path: '/' });
    $.cookie('location', $("#location").val(), { expires: 365, path: '/' });
    $.cookie('level',$("#level").val(), { expires: 365, path: '/' });
}
function getString(f,def) {
    r = (f =="" || f=="undefined" || f==null)? def : f;
    return r;
}
function restoreUserInfo() {
    $("#nick").val(getString($.cookie("nick"),""));
    $("#skype").val(getString($.cookie("skype"),""));
    $("#icq").val(getString($.cookie("icq"),""));
    $("#age").val(getString($.cookie("age"),"--"));
    $("#sex").val(getString($.cookie("sex"),"--"));
    $("#goal").val(getString($.cookie("goal"),"--"));
    $("#language").val(getString($.cookie("language"),"--"));
    $("#location").val(getString($.cookie("location"),"--"));
    $("#level").val(getString($.cookie("level"),"--"));
}
$(document).ready(function(){
    //tid = setTimeout(addlearner, 1000);
    iid = setInterval(addlearner, 870000);
    
    restoreUserInfo();
    $('.selectpicker').selectpicker();

    $("#submit").click(function(){
        $("#submit").hide();

        clearInterval(iid);
        clearTimeout(tid);
        tid = setTimeout(addlearner, 500);
        iid = setInterval(addlearner, 870000);
    });

    $('.input-group input[required], .input-group select[required]').on('keyup change', function() {
        var $form = $(this).closest('form'),
            $group = $(this).closest('.input-group'),
            $addon = $group.find('.input-group-addon'),
            $icon = $addon.find('span'),
            state = false;
        if (!$group.data('validate')) {
            state = $(this).val() ? true : false;
        }
        if (state) {
            $addon.removeClass('danger');
            $addon.addClass('success');
            $icon.attr('class', 'glyphicon glyphicon-ok');
        }
        else {
            $addon.removeClass('success');
            $addon.addClass('danger');
            $icon.attr('class', 'glyphicon glyphicon-remove');
        }
    });
    
    $('.input-group input[required], .input-group select[required]').trigger('keyup');
    
//    $form = $('.input-group input[required]').closest('form');
//    if ($form.find('.input-group-addon.danger').length == 0)
    $("#submit").trigger('click');
});