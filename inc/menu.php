<?php
    define('BUZZ_FILE', 'find-partner/');
    $is_buzz_file = $file == BUZZ_FILE;
    $is_privacy_file = $file == 'privacy-policy.php';
    $is_chat_file = $file == 'online-chat/';
    $is_buzz_file = $is_buzz_file || $is_privacy_file;

    $brand = ($is_buzz_file || $is_chat_file) ? '../.' : '.';
    $file_dir = ($is_buzz_file || $is_chat_file) ? '../' : '';
    $buzz_dir = $is_privacy_file ? '.' : BUZZ_FILE;
    $buzz_dir = $is_chat_file ? '../' . BUZZ_FILE : $buzz_dir;
?>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header brand-name">
            <a class="navbar-brand" href="<?=$brand?>"><strong>S</strong>ay <strong>I</strong>t <strong>A</strong>gain</a>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="<?=$file_dir?>useful-quotes-for-language-learners.php">Quotes</a></li>
                <li><a href="<?=$file_dir?>how-to-gain-fluency-in-language.php">Tips</a></li>
                <li role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                        English <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?=$file_dir?>sites-to-improve-listening-skills.php">English resources</a></li>
                        <li><a href="<?=$file_dir?>popular-slang-of-1950s-symphony-in-slang.php">Symphony in Slang</a></li>
                    </ul>
                </li>
                <li><a href="<?=$file_dir?>online-chat/.">Chat</a></li>
            </ul>
            <?php
                if (!$is_buzz_file || $is_privacy_file) :
            ?>
                <div class="navbar-text navbar-right start-button">
                    <a href="<?=$buzz_dir?>" class="btn btn-success"><span class="glyphicon glyphicon-search"></span></a>
                </div>
            <?php
                endif;
            ?>
        </div>
    </div>
</nav>