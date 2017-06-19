/*      Copyright © 2015 - sayitagain.pw
 *      Author - Dmitry Kuznetsov
 */
var iid = null; var tid = null;
function addlearner() {
    const nick = $("#nick").val(),
        skype = $("#skype").val(),
        icq = $("#icq").val(),
        age = $("#age").val(),
        sex = $("#sex").val(),
        goal = $("#goal").val(),
        language = $("#language").val(),
        location = getString($("#location").val(),"--"),
        level = $("#level").val();

    // saveUserInfo
    $.cookie('nick', nick, { expires: 365, path: '/' });
    $.cookie('skype', skype, { expires: 365, path: '/' });
    $.cookie('icq', icq, { expires: 365, path: '/' });
    $.cookie('age', age, { expires: 365, path: '/' });
    $.cookie('sex', sex, { expires: 365, path: '/' });
    $.cookie('goal', goal, { expires: 365, path: '/' });
    $.cookie('language', language, { expires: 365, path: '/' });
    $.cookie('location', location, { expires: 365, path: '/' });
    $.cookie('level', level, { expires: 365, path: '/' });


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
            $("#learners").html(data);
        },
        complete: function(){
            $("#loader").hide();
            $("#submit").show();
        },
        dataType: "html"  
    });
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
        $("#learners").html('');
        $(this).hide();
        $("#loader").show();
        
        clearInterval(iid);
        clearTimeout(tid);
        tid = setTimeout(addlearner, 500);
        iid = setInterval(addlearner, 870000);
    });

    $('.input-group input[required], .input-group select[required]').on('keyup change', function() {
        var $this = $(this),
            $form = $this.closest('form'),
            $group = $this.closest('.input-group'),
            $addon = $group.find('.input-group-addon'),
            $icon = $addon.find('span'),
            state = false;
        if (!$group.data('validate')) {
            state = $this.val() ? true : false;
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