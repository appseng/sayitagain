<!--	Copyright © 2015 - www.sayitagain.pw 
        Author - Dmitry Kuznetsov                       -->
<?php
include 'dbinfo.php';

mb_internal_encoding("UTF-8");
function check($field, $def,$len=1) {
    global $conn;
    $f = (isset($field) && $field !="")? $field : $def;
    if ($f != $def) {
        $f = trim($f);
        $f = stripslashes($f);
        $f = mysqli_real_escape_string($conn, $f);
        $f = htmlentities($f);
//        $f = htmlspecialchars($f);
        if (is_string($f) && mb_strlen($f)>$len) {
//            echo "L=".$len;
            $f = mb_substr($f,0,$len);
//            echo "F=".$f.";";
        }
    }  
    return $f;
}
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
            $goal = "I just want to improve my skills.";
            break;
        case 1:
            $goal = "I just want to find a friend to learn a language together.";
            break;
        case 2:
            $goal = "I just want to find a students to teach them.";
            break;
        case 3:
            $goal = "I just want to find a teacher to learn a language with them.";
            break;
        default:
            $goal = "";
    }
    return $goal;
}
function sexRendering($f) {
    switch($f) {
        case 0:
            $sex = "F";
            break;
        case 1:
            $sex = "M";
            break;
        default:
            $sex = "--";
            break;
    }
    return $sex;
}
function sexTitleRendering($s) {
    switch($s) {
        case "M":
            $sexTitle = "Male";
            break;
       case "F":
            $sexTitle = "Female";
            break;
        default:
            $sexTitle = "";
            break;
    }
    return $sexTitle;
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
function sql_die() {
    mysqli_query($conn, "ROLLBACK");
    die(mysql_error());
}
function tableContent($stmt) {
    $result = "";
    mysqli_stmt_bind_result($stmt, $nick, $skype, $icq, $age, $sex, $goal, $location, $language, $level, $visitedtime);
    while (mysqli_stmt_fetch($stmt)) {
        $goal = goalRendering($goal);
        $goalTitle = goalTitleRendering($goal);
        $goaltd = ($goalTitle =="")? $goal : "<abbr title=\"$goalTitle\">$goal</abbr>";
        $sex = sexRendering($sex);
        $sexTitle = sexTitleRendering($sex);
        $sextd = ($sexTitle =="") ? $sex : "<abbr title=\"$sexTitle\">$sex</abbr>";

        $level = levelRendering($level);
        $age = ($age == -1)? "--" : $age;

        $skype_url = ($skype != null && $skype != "--") ? "<a href=\"skype:$skype?chat\"><img alt=\"skype:$skype?chat\" title=\"skype:$skype?chat\" src=\"skype12.png\" /><a>" : "";
        $icq_url =  ($icq != null && $icq != "--") ? "<a href=\"icq:$icq\"><img src=\"icq.png\" alt=\"icq:$icq\" title=\"icq:$icq\" /><a>" : "";
        $result .= "<tr><td><kbd>$nick</kbd></td><td><kbd>$age</kbd></td><td><kbd>$sextd</kbd></td><td><kbd>$goaltd</kbd></td><td><img id=\"flag\" alt=\"$location\" title=\"$location\" src=\"http://www.geonames.org/flags/x/".strtolower($location).".gif\" /></td><td><kbd>$level</kbd></td><td>$skype_url  $icq_url</td><td class=\"last-time-info-updated\"><kbd>$visitedtime</kbd></td></tr>";
    }
    return $result;
}
function selectInfo($language,$ip) {
    global $db_table, $conn;
    $result = "<table class=\"learners table table-condensed table-hover\"><thead><tr>
          <th>Nickname</th>
          <th>Age</th>
          <th>Sex</th>
          <th>Goal</th>
          <th>Location</th>
          <th>Level</th>
          <th>Skype/ICQ</th>
          <th class=\"last-time-info-updated\">Time</th>          
          </tr></thead><tbody>";
          
//     $stmt = mysqli_prepare($conn,"select nick,skype,icq,age,sex,goal,location,language,level,visitedtime from $db_table where language = ? and ip = ?");
//     mysqli_stmt_bind_param($stmt, "ss", $language, $ip);
//     mysqli_stmt_execute($stmt);
//     
//     mysqli_stmt_store_result($stmt);
//     $rows = mysqli_stmt_num_rows($stmt);
//     $result .= tableContent($stmt);

//     mysqli_stmt_free_result($stmt);
//     mysqli_stmt_close($stmt);

    $stmt = mysqli_prepare($conn,"select nick,skype,icq,age,sex,goal,location,language,level,visitedtime from $db_table where language = ? order by visitedtime desc");
    mysqli_stmt_bind_param($stmt, "s", $language);
    mysqli_stmt_execute($stmt);
    
    mysqli_stmt_store_result($stmt);
    $rows = mysqli_stmt_num_rows($stmt);

    $result .= tableContent($stmt);
    $result .="</tbody></table>";

    mysqli_stmt_free_result($stmt);
    mysqli_stmt_close($stmt);

    if ($rows > 0) {
        echo $result;
    }
    else {
        include 'getquote.php';
    }
}
/// executive part begins
// checking ip
$ip = $_SERVER["REMOTE_ADDR"];
if (!filter_var($ip, FILTER_VALIDATE_IP)){
    echo "Error in HTTP_HEADER. REMOTE_ADDR has been detected incorrectly.";
    die ("Error in HTTP_HEADER");
}
// checking all neccessary post variables
if (isset($_POST["sex"]) && 
        isset($_POST["age"]) && 
        isset($_POST["goal"]) && 
        isset($_POST["location"]) &&
        isset($_POST["language"]) &&
        isset($_POST["level"])
    ) {
    connect();
    $age = check($_POST["age"],-1,2);
    $sex = check($_POST["sex"],-1);
    $goal = check($_POST["goal"],-1);
    $location = check($_POST["location"],"--",2);
    $language = check($_POST["language"],"--",80);
    $level = check($_POST["level"],-1);

    $nick = check($_POST["nick"],"--",25);
    $skype = check($_POST["skype"],"--",50);
    $icq = check($_POST["icq"],"--",50);
    
    mysqli_query($conn, "SET AUTOCOMMIT=0");
    mysqli_query($conn, "START TRANSACTION");
    if ($nick !="--" &&
        ($skype != "--" || $icq != "--") &&
//      $level != "--" &&
        $location != "--" //&& 	
//      $goal != "--" &&
//      $sex != "--" &&
//      $age != "--")
        ) {
//      echo "$nick : $skype";
        // update ip if it has been changed from previous visit on the page
        // commented because of the cost of the operation
        /*
        $stmt = mysqli_prepare($conn,"update $db_table set ip = ? where nick = ? and skype = ? and icq = ? and age = ? and sex = ? and goal = ? and location = ? and language = ? and level = ?");
        mysqli_stmt_bind_param($stmt, "ssssiiissi", $ip, $nick, $skype, $icq, $age, $sex, $goal, $location, $language, $level);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        */
        
        // check if user is already registered
        $stmt = mysqli_prepare($conn,"select 1 from $db_table where ip = ?");
        mysqli_stmt_bind_param($stmt, "s" ,$ip);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $rows = mysqli_stmt_num_rows($stmt);
        mysqli_stmt_free_result($stmt);
        mysqli_stmt_close($stmt);
        
        if ($rows == 0) {
            $stmt = mysqli_prepare($conn,"insert into $db_table (nick,skype,icq,age,sex,goal,location,language,level,visitedtime,ip) values(?, ?, ?, ?, ?, ?, ?, ?, ?,now(), ?)");
            mysqli_stmt_bind_param($stmt, "sssiiissis" , $nick, $skype, $icq, $age, $sex, $goal, $location, $language, $level, $ip);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        else {
            $stmt = mysqli_prepare($conn,"update $db_table set nick=?, skype=?, icq=?, age=?, sex=?, goal=?, location=?, language=?, level=?, visitedtime=now() where ip = ?");
            mysqli_stmt_bind_param($stmt, "sssiiissis" , $nick, $skype, $icq, $age, $sex, $goal, $location, $language, $level, $ip);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }
    else {
        $stmt = mysqli_prepare($conn,"delete from $db_table where ip=?");
        mysqli_stmt_bind_param($stmt, "s" ,$ip);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    $sql= "delete from $db_table where DATE_ADD(visitedtime, INTERVAL 1 DAY) < now()";
    $q = mysqli_query($conn, $sql) or sql_die();
  
    mysqli_query($conn, "COMMIT");
    selectInfo($language,$ip);
    mysqli_close($conn);
}
?>