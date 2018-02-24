<?php
    $is_buzz_file = $file == 'buzz/';
    $is_privacy_file = $file == 'privacy.php';
    $is_buzz_file = $is_buzz_file || $is_privacy_file;

    $brand = $is_buzz_file ? '../.' : '.';
    $file_dir = $is_buzz_file ? '../' : '';
    $buzz_dir = $is_privacy_file ? '.' : 'buzz/';
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
                <li><a href="<?=$file_dir?>quotes.php">Quotes</a></li>
                <li><a href="<?=$file_dir?>tips.php">Tips</a></li>
                <li role="presentation" class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                        English <span class="caret"></span>
                    </a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?=$file_dir?>sites.php">English resources</a></li>
                        <li><a href="<?=$file_dir?>symphony.php">Symphony in Slang</a></li>
                    </ul>
                </li>
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