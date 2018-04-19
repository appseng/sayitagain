<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <link rel="stylesheet" type="text/css" href="css/main.css"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    
    <title>SIA: Intro</title>    
    <meta name="keywords" content="free english spanish mandarin cheneese french italian german russian real conversation find partner learn spoken english speak speaking write writing skill enjoy language exchange partner grammar school slang exercises lessons on skype via icq vocabulary expansion dialogs study pronunciation spoken native speakers every taste different preparation exam ket pet fce cae cfe toefl IELTS BEC TOEIC EFL ESL">
    <meta name="description" content=" Free practice, enjoyable conversations, speaking, writing in a lot of languages (English, Spanish, Mandarin, Russian, German, French, Italian etc.) online via Skype or/and ICQ. Start improving your speaking, writing, listening, reading skills as soon as you start to talk.">
  </head>
  <body>
    <!--facebook SDK-->
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.3";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
      
    <?php
        $file = __FILE__;
        include_once 'inc/menu.php';
    ?>

    <div class="container-fluid">
      <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
          <div class="text-center description">
          <p>Free language practice, enjoyable conversations, speaking, writing in a lot of languages (<b>English, Spanish, Mandarin, Russian, German, French, Italian etc.</b>) online via Skype or/and ICQ.</p>
          <p>Start improving your speaking, writing, listening, reading skills as soon as you start to talk.</p>
          <p>Find people who want to practise a language.</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="text-center">
          <a href="<?=$buzz_dir?>" class="btn btn-success">
            <span class="glyphicon glyphicon-search"></span> Start searching
          </a>
        </div>
      </div>
      <br />
      <br />
      <br />
      <div class="row">
        <div class="text-center">
          <div class="fb-like" data-href="https://www.facebook.com/sayitagainpw" data-layout="box_count" data-action="like" data-show-faces="true" data-share="true"></div>
        </div>
      </div>
    </div>
    <br />
  </body>
</html>
