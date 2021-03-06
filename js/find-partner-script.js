(function() {
    var iid = null,
        tid = null;

    function setCookie(cname, cvalue, exdays = 365) {
        var d = new Date();

        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));

        var expires = "expires="+d.toUTCString();

        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }
        
    function getCookie(cname) {
        var name = cname + "=",
            ca = document.cookie.split(';');

        for(var i = 0; i < ca.length; i++) {
            var c = ca[i];

            while (c.charAt(0) === ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) === 0) {
                return c.substring(name.length, c.length);
            }
        }
        return null;
    }

    function goalRendering(goal) {
        var goalString;

        switch(goal) {
            case 0:
                goalString = "Chat";
                break;
            case 1:
                goalString = "Friend";
                break;
            case 2:
                goalString = "Student";
                break;
            case 3:
                goalString = "Teacher";
                break;
            default:
                goalString = "--";
        }
        return goalString;
    }

    function goalTitleRendering(goalString) {
        var goalTitle;

        switch(goalString) {
            case 0:
                goalTitle = "I just want to improve my skills.";
                break;
            case 1:
                goalTitle = "I just want to find a friend to learn a language together.";
                break;
            case 2:
                goalTitle = "I just want to find a student to teach them.";
                break;
            case 3:
                goalTitle = "I just want to find a teacher to learn a language with them.";
                break;
            default:
                goalTitle = "";
        }
        return goalTitle;
    }

    function genderRendering(gender) {
        var genderString;

        switch(gender) {
            case 0:
                genderString = "F";
                break;
            case 1:
                genderString = "M";
                break;
            case 2:
                genderString = "X";
                break;
            default:
                genderString = "--";
                break;
        }
        return genderString;
    }

    function genderTitleRendering(genderString) {
        var genderTitle;

        switch(genderString) {
            case "M":
                genderTitle = "Male";
                break;
        case "F":
                genderTitle = "Female";
                break;
            case "X":
                genderTitle = "Other";
                break;
            default:
                genderTitle = "";
                break;
        }
        return genderTitle;
    }

    function levelRendering(level) {
        var levelString;

        switch(level) {
            case 0:
                levelString = "Starter";
                break;
            case 1:
                levelString = "Elementary";
                break;
            case 2:
                levelString = "Pre-intermediate";
                break;
            case 3:
                levelString = "Intermediate";
                break;
            case 4:
                levelString = "Upper-intermediate";
                break;
            case 5:
                levelString = "Advanced";
                break;
            case 6:
                levelString = "Proficient";
                break;
            default:
                levelString = "--";
                break;
        }
        return levelString;
    }

    function addLearner() {
        const $inputForm = $("#input-form"),
            nick = $inputForm.find("#nick").val(),
            skype = $inputForm.find("#skype").val(),
            icq = $inputForm.find("#icq").val(),
            age = $inputForm.find("#age").val(),
            gender = $inputForm.find("#gender").val(),
            goal = $inputForm.find("#goal").val(),
            language = $inputForm.find("#language").val(),
            location = getString($inputForm.find("#location").val(),"--"),
            level = $inputForm.find("#level").val();

        // saveUserInfo
        setCookie('nick', nick);
        setCookie('skype', skype);
        setCookie('icq', icq);
        setCookie('age', age);
        setCookie('gender', gender);
        setCookie('goal', goal);
        setCookie('language', language);
        setCookie('location', location);
        setCookie('level', level);

        $.ajax({
            type: "POST",
            url: "add_learner.php",
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
            success: function(jsonData){
                var html = '';

                switch (jsonData["type"]) {
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

                        jsonData["data"].forEach(function(item) {
                            var goalString = goalRendering(item.goal),
                                goalTitle = goalTitleRendering(item.goal),
                                goaltd = (goalTitle === "")? goalString : "<abbr title=\"" + goalTitle + "\">" + goalString + "</abbr>",
                                gender = genderRendering(item.gender),
                                genderTitle = genderTitleRendering(gender),
                                gendertd = (genderTitle === "") ? gender : "<abbr title=\"" + genderTitle + "\">" + gender + "</abbr>",
                                level = levelRendering(item.level),
                                age = (item.age !== -1)? item.age : "--",
                                skype_url = (item.skype != null && item.skype !== "--") ? "<a href=\"skype:" + item.skype + "?chat\"><img alt=\"skype:" + item.skype + "?chat\" title=\"skype:" + item.skype + "?chat\" src=\"../img/skype12.png\" /><a>" : "",
                                icq_url =  (item.icq != null && item.icq !== "--") ? "<a href=\"icq:" + item.icq + "\"><img src=\"../img/icq.png\" alt=\"icq:" + item.icq + "\" title=\"icq:" + item.icq + "\" /><a>" : "";
                            
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
                                + "\" src=\"http://www.geognos.com/api/en/countries/flag/"
                                + item.location
                                + ".png\" /></td><td><kbd>"
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
                            + jsonData["data"]['blockquote']
                            + "<footer>"
                            + jsonData["data"]['footer']
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

    function getString(f, def) {
        r = (f === "" || f === "undefined" || f == null) ? def : f;
        return r;
    }

    function restoreUserInfo() {
        var $inputForm = $("#input-form");

        $inputForm.find("#nick").val(getString(getCookie("nick"),""));
        $inputForm.find("#skype").val(getString(getCookie("skype"),""));
        $inputForm.find("#icq").val(getString(getCookie("icq"),""));
        $inputForm.find("#age").val(getString(getCookie("age"),"-1"));
        
        $inputForm.find("#gender").val(getString(getCookie("gender"),"-1"));
        $inputForm.find("#goal").val(getString(getCookie("goal"),"-1"));
        $inputForm.find("#language").val(getString(getCookie("language"),"English"));
        $inputForm.find("#location").val(getString(getCookie("location")," "));
        $inputForm.find("#level").val(getString(getCookie("level"),"-1"));
    }

    $(document).ready(function(){        
        restoreUserInfo();
        
        $("#submit").click(function(){
            $("#learners").html('');
            $("#loader").show();
            
            clearInterval(iid);
            clearTimeout(tid);
            tid = setTimeout(addLearner, 500);
            iid = setInterval(addLearner, 870000);
        });

        $('.input-group input[required], .input-group select[required]').on('keyup change', function() {
            var $this = $(this),
                $group = $this.closest('.input-group'),
                $addon = $group.find('.input-group-addon'),
                $icon = $addon.find('span'),
                state = false;

            if (!$group.data('validate')) {
                state = !!$this.val().trim();
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
        }).trigger('keyup');
        
        addLearner();
        iid = setInterval(addLearner, 870000);
    });
})();