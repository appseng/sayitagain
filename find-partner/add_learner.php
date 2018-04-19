<?php
include 'dbinfo.php';

mb_internal_encoding("UTF-8");

function check($field, $def, $len = 1) {
    global $conn;

    $f = trim($field);
    $f = (isset($f) && $f != "") ? $f : $def;

    if ($f != $def) {        
        $f = stripslashes($f);
        $f = mysqli_real_escape_string($conn, $f);
        $f = htmlentities($f);

        if (is_string($f) && mb_strlen($f) > $len) {
            $f = mb_substr($f, 0, $len);
        }
    }  
    return $f;
}

function sql_die() {
    global $conn;
    mysqli_query($conn, "ROLLBACK");
    die(mysqli_error($conn));
}

function selectInfo($language) {
    global $db_table, $conn;

    $stmt = mysqli_prepare($conn,"select nick, skype, icq, age, gender, goal, location, language, level, visitedtime from $db_table where language = ? order by visitedtime desc");
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
            'location' => strtoupper($location),
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
if (isset($_POST["gender"],
    $_POST["age"],
    $_POST["goal"],
    $_POST["location"],
    $_POST["language"],
    $_POST["level"])) {
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
        $location != "--"	
        ) {
        // check if user is already registered
        $stmt = mysqli_prepare($conn,"select 1 from $db_table where ip = ?");
        mysqli_stmt_bind_param($stmt, "s", $ip);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);
        $rows = mysqli_stmt_num_rows($stmt);
        mysqli_stmt_free_result($stmt);
        mysqli_stmt_close($stmt);
        
        if ($rows == 0) {
            $stmt = mysqli_prepare($conn,"insert into $db_table (nick, skype, icq, age, gender, goal, location, language, level, visitedtime, ip) values(?, ?, ?, ?, ?, ?, ?, ?, ?, now(), ?)");
            mysqli_stmt_bind_param($stmt, "sssiiissis", $nick, $skype, $icq, $age, $gender, $goal, $location, $language, $level, $ip);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        else {
            $stmt = mysqli_prepare($conn,"update $db_table set nick=?, skype=?, icq=?, age=?, gender=?, goal=?, location=?, language=?, level=?, visitedtime=now() where ip = ?");
            mysqli_stmt_bind_param($stmt, "sssiiissis", $nick, $skype, $icq, $age, $gender, $goal, $location, $language, $level, $ip);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }
    else {
        $stmt = mysqli_prepare($conn,"delete from $db_table where ip=?");
        mysqli_stmt_bind_param($stmt, "s", $ip);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    $sql= "delete from $db_table where DATE_ADD(visitedtime, INTERVAL 1 DAY) < now()";
    $q = mysqli_query($conn, $sql) or sql_die();
  
    mysqli_query($conn, "COMMIT");
    selectInfo($language);
    mysqli_close($conn);
}