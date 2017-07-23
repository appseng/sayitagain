<?php
include 'dbinfo.php';

mb_internal_encoding("UTF-8");
function check($field, $def,$len=1) {
    global $conn;
    $f = trim($field);
    $f = (isset($f) && $f !="")? $f : $def;
    if ($f != $def) {        
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

function sql_die() {
    mysqli_query($conn, "ROLLBACK");
    die(mysql_error());
}

function selectInfo($language,$ip) {
    global $db_table, $conn;

    $stmt = mysqli_prepare($conn,"select nick,skype,icq,age,gender,goal,location,language,level,visitedtime from $db_table where language = ? order by visitedtime desc");
    mysqli_stmt_bind_param($stmt, "s", $language);
    mysqli_stmt_execute($stmt);
    
    mysqli_stmt_store_result($stmt);
    $rows = mysqli_stmt_num_rows($stmt);

    mysqli_stmt_bind_result($stmt, $nick, $skype, $icq, $age, $gender, $goal, $location, $language, $level, $visitedtime);
    $arResult = [
        "type" => "table",
        "data" => []
    ];
    while (mysqli_stmt_fetch($stmt)) {
        $lineResult = [
            'nick' => $nick,
            'skype' => $skype,
            'icq' => $icq,
            'age' => $age,
            'gender' => $gender,
            'goal' => $goal,
            'location' => strtolower($location),
            'language' => $language,
            'level' => $level,
            'visitedtime' => $visitedtime
        ];
        array_push($arResult["data"], $lineResult);
    }
    
    $result = json_encode($arResult);

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
if (isset($_POST["gender"]) && 
        isset($_POST["age"]) && 
        isset($_POST["goal"]) && 
        isset($_POST["location"]) &&
        isset($_POST["language"]) &&
        isset($_POST["level"])
    ) {
    connect(); // function from dbinfo.php to connect to mysql
    $age = check($_POST["age"],-1,2);
    $gender = check($_POST["gender"],-1);
    $goal = check($_POST["goal"],-1);
    $location = check($_POST["location"],"--",2);
    $language = check($_POST["language"],"--",80);
    $level = check($_POST["level"],-1);

    $nick = check($_POST["nick"],"--",20);
    $skype = check($_POST["skype"],"--",50);
    $icq = check($_POST["icq"],"--",50);
    
    mysqli_query($conn, "SET AUTOCOMMIT=0");
    mysqli_query($conn, "START TRANSACTION");
    if ($nick !="--" &&
        ($skype != "--" || $icq != "--") &&
//      $level != "--" &&
        $location != "--" //&& 	
//      $goal != "--" &&
//      $gender != "--" &&
//      $age != "--")
        ) {
//      echo "$nick : $skype";
        // update ip if it has been changed from previous visit on the page
        // commented because of the cost of the operation
        /*
        $stmt = mysqli_prepare($conn,"update $db_table set ip = ? where nick = ? and skype = ? and icq = ? and age = ? and gender = ? and goal = ? and location = ? and language = ? and level = ?");
        mysqli_stmt_bind_param($stmt, "ssssiiissi", $ip, $nick, $skype, $icq, $age, $gender, $goal, $location, $language, $level);
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
            $stmt = mysqli_prepare($conn,"insert into $db_table (nick,skype,icq,age,gender,goal,location,language,level,visitedtime,ip) values(?, ?, ?, ?, ?, ?, ?, ?, ?,now(), ?)");
            mysqli_stmt_bind_param($stmt, "sssiiissis" , $nick, $skype, $icq, $age, $gender, $goal, $location, $language, $level, $ip);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        else {
            $stmt = mysqli_prepare($conn,"update $db_table set nick=?, skype=?, icq=?, age=?, gender=?, goal=?, location=?, language=?, level=?, visitedtime=now() where ip = ?");
            mysqli_stmt_bind_param($stmt, "sssiiissis" , $nick, $skype, $icq, $age, $gender, $goal, $location, $language, $level, $ip);
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