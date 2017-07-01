/*      Copyright © 2015 - sayitagain.pw
 *      Author - Dmitry Kuznetsov
 */
var iid = null; var tid = null;
function goalRendering($f) {
    switch($f) {
        case 0:
            $goal = "Chat";
            break;
        case 1:
            $goal = "Friend";
            break;
        case 2:
            $goal = "Student";
            break;
        case 3:
            $goal = "Teacher";
            break;
        default:
            $goal = "--";
    }
    return $goal;
}
function goalTitleRendering($f) {
    switch($f) {
        case 0:
            $goalTitle = "I just want to improve my skills.";
            break;
        case 1:
            $goalTitle = "I just want to find a friend to learn a language together.";
            break;
        case 2:
            $goalTitle = "I just want to find a students to teach them.";
            break;
        case 3:
            $goalTitle = "I just want to find a teacher to learn a language with them.";
            break;
        default:
            $goalTitle = "";
    }
    return $goalTitle;
}
function genderRendering($f) {
    switch($f) {
        case 0:
            $gender = "F";
            break;
        case 1:
            $gender = "M";
            break;
        case 2:
            $gender = "X";
            break;
        default:
            $gender = "--";
            break;
    }
    return $gender;
}
function genderTitleRendering($s) {
    switch($s) {
        case "M":
            $genderTitle = "Male";
            break;
       case "F":
            $genderTitle = "Female";
            break;
        case "X":
            $genderTitle = "Other";
            break;
        default:
            $genderTitle = "";
            break;
    }
    return $genderTitle;
}
function levelRendering($f) {
    switch($f) {
        case 0:
            $level = "Starter";
            break;
        case 1:
            $level = "Elementary";
            break;
        case 2:
            $level = "Pre-intermediate";
            break;
        case 3:
            $level = "Intermediate";
            break;
        case 4:
            $level = "Upper-Intermediate";
            break;
        case 5:
            $level = "Advanced";
            break;
        case 6:
            $level = "Proficient";
            break;
        default:
            $level = "--";
            break;
    }
    return $level;
}
function addlearner() {
    const nick = $("#nick").val(),
        skype = $("#skype").val(),
        icq = $("#icq").val(),
        age = $("#age").val(),
        gender = $("#gender").val(),
        goal = $("#goal").val(),
        language = $("#language").val(),
        location = getString($("#location").val(),"--"),
        level = $("#level").val();

    // saveUserInfo
    $.cookie('nick', nick, { expires: 365, path: '/' });
    $.cookie('skype', skype, { expires: 365, path: '/' });
    $.cookie('icq', icq, { expires: 365, path: '/' });
    $.cookie('age', age, { expires: 365, path: '/' });
    $.cookie('gender', gender, { expires: 365, path: '/' });
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
                gender:gender,
                goal:goal,
                language:language,
                location:location,
                level:level
        },
        success: function(data){
            var html = '';
            switch (data[0]) {
                case 'table':
                    html += "<table class=\"learners table table-condensed table-hover\"><thead><tr>"
                    + "<th>Nickname</th>"
                    + "<th>Age</th>"
                    + "<th>Gender</th>"
                    + "<th>Goal</th>"
                    + "<th>Location</th>"
                    + "<th>Level</th>"
                    + "<th>Skype/ICQ</th>"
                    + "<th class=\"last-time-info-updated\">Time</th>"
                    + "</tr></thead><tbody>";

                    data.shift(); 
                    data.forEach(function(item) {
                         var goalText = goalRendering(item.goal),
                            goalTitle = goalTitleRendering(item.goal),
                            goaltd = (goalTitle =="")? goalText : "<abbr title=\"" + goalTitle + "\">" + goalText + "</abbr>",
                            gender = genderRendering(item.gender),
                            genderTitle = genderTitleRendering(gender),
                            gendertd = (genderTitle =="") ? gender : "<abbr title=\"" + genderTitle + "\">" + gender + "</abbr>",
                            level = levelRendering(item.level),
                            age = (item.age != -1)? item.age : "--",
                            skype_url = (item.skype != null && item.skype != "--") ? "<a href=\"skype:" + item.skype + "?chat\"><img alt=\"skype:" + item.skype + "?chat\" title=\"skype:" + item.skype + "?chat\" src=\"skype12.png\" /><a>" : "",
                            icq_url =  (item.icq != null && item.icq != "--") ? "<a href=\"icq:" + item.icq + "\"><img src=\"icq.png\" alt=\"icq:" + item.icq + "\" title=\"icq:" + item.icq + "\" /><a>" : "";
                        
                        html += "<tr><td><kbd>"
                             + item.nick
                             + "</kbd></td><td><kbd>"
                             + age
                             + "</kbd></td><td><kbd>"
                             + gendertd
                             + "</kbd></td><td><kbd>"
                             + goaltd
                             + "</kbd></td><td><img id=\"flag\" alt=\""
                             + item.location
                             + "\" title=\""
                             + item.location
                             + "\" src=\"http://www.geonames.org/flags/x/"
                             + item.location
                             + ".gif\" /></td><td><kbd>"
                             + level
                             + "</kbd></td><td>"
                             + skype_url + icq_url
                             + "</td><td class=\"last-time-info-updated\"><kbd>"
                             + item.visitedtime
                             + "</kbd></td></tr>";
                    });
                    html += "</tbody></table>";
                    break;
                case 'quote':
                    html = "<span>A quote for language learners* :</span><blockquote>"
                        + data[1]['blockquote']
                        + "<footer>"
                        + data[1]['footer']
                        + "</footer></blockquote><br /><br /><br /><br /><br /><br /><span class=\"mark\">* A quote appears if there are no learners of a chosen language or if you have just visited this web-site. Enjoy it anyway.</span>";
                    break;
                default:
                    break;
            }
            $("#learners").html(html);
        },
        complete: function(){
            $("#loader").hide();
        },
        dataType: "json"  
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
    $("#gender").val(getString($.cookie("gender"),"--"));
    $("#goal").val(getString($.cookie("goal"),"--"));
    $("#language").val(getString($.cookie("language"),"--"));
    $("#location").val(getString($.cookie("location"),"--"));
    $("#level").val(getString($.cookie("level"),"--"));
}
$(document).ready(function(){
    iid = setInterval(addlearner, 870000);
    
    restoreUserInfo();
    $('.selectpicker').selectpicker();

    $("#submit").click(function(){
        $("#learners").html('');
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
    
    $("#submit").trigger('click');
});