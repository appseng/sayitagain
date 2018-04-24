<?php
if (file_exists('../dbinfo/dbinfo.php')) {
    include '../dbinfo/dbinfo.php';
}
else {
    include 'dbinfo.php';
}

mb_internal_encoding("UTF-8");

function connect() {
    global $db_server, $db_user, $db_password, $db_name, $conn;

    $conn = new mysqli($db_server, $db_user, $db_password, $db_name);
    // Check connection
    if (mysqli_connect_errno()) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}

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

    // get a list of learners
    $stmt = mysqli_prepare($conn,"select nick, skype, icq, age, gender, goal, location, language, level, visitedtime from $db_table where language = ? order by visitedtime desc");
    mysqli_stmt_bind_param($stmt, "s", $language);
    mysqli_stmt_execute($stmt);
    
    mysqli_stmt_store_result($stmt);
    $rows = mysqli_stmt_num_rows($stmt);

    mysqli_stmt_bind_result($stmt, $nick, $skype, $icq, $age, $gender, $goal, $location, $language, $level, $visitedtime);
    
    // prepare data for transering to a web-page
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

    // echo result data
    if ($rows > 0) {
        echo $result;
    }
    else {
        include 'getquote.php';
    }
}
/// the executive part begins
// checking ip
$ip = $_SERVER["REMOTE_ADDR"];
if (!filter_var($ip, FILTER_VALIDATE_IP)){
    echo "Error in HTTP_HEADER. REMOTE_ADDR has been detected incorrectly.";
    die ("Error in HTTP_HEADER");
}

// checking all neccessary POST-variables
if (isset($_POST["gender"],
    $_POST["age"],
    $_POST["goal"],
    $_POST["location"],
    $_POST["language"],
    $_POST["level"])) {
    connect(); // function to connect to mysql

    // checking input data from a AJAX-request
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
        
        if ($rows == 0) { // add a learner in the list
            $stmt = mysqli_prepare($conn,"insert into $db_table (nick, skype, icq, age, gender, goal, location, language, level, visitedtime, ip) values(?, ?, ?, ?, ?, ?, ?, ?, ?, now(), ?)");
            mysqli_stmt_bind_param($stmt, "sssiiissis", $nick, $skype, $icq, $age, $gender, $goal, $location, $language, $level, $ip);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
        else { // update info of the learner
            $stmt = mysqli_prepare($conn,"update $db_table set nick=?, skype=?, icq=?, age=?, gender=?, goal=?, location=?, language=?, level=?, visitedtime=now() where ip = ?");
            mysqli_stmt_bind_param($stmt, "sssiiissis", $nick, $skype, $icq, $age, $gender, $goal, $location, $language, $level, $ip);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
        }
    }
    else { // delete learner from the list
        $stmt = mysqli_prepare($conn,"delete from $db_table where ip=?");
        mysqli_stmt_bind_param($stmt, "s", $ip);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }

    // delete out-of-date learner (who hasn't been on the site more a day)
    $sql= "delete from $db_table where DATE_ADD(visitedtime, INTERVAL 1 DAY) < now()";
    $q = mysqli_query($conn, $sql) or sql_die();
  
    mysqli_query($conn, "COMMIT");
    selectInfo($language); // output learners' data
    mysqli_close($conn);
}
