<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/headjs/1.0.3/head.load.min.js"></script>

    <script>
      head.load([
        'https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js',
        'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css',
        'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js',
        '../css/main.css',
        '../css/buzz-style.css',
        '../js/buzz-script.js'
      ]);
    </script>
    
    <title>SIA: Language Practice</title>    
    <meta name="keywords" content="free english spanish mandarin cheneese french italian german russian real conversation partner learn spoken english speak speaking write writing skill enjoy language exchange partner grammar school slang exercises lessons on skype via icq vocabulary expansion dialogs study pronunciation spoken native speakers every taste different preparation exam ket pet fce cae cfe toefl IELTS BEC TOEIC EFL ESL">
    <meta name="description" content="Useful web-application to have found a conversation partner for language practice">
  </head>
  <body>
    <?php
      $file = 'buzz/';
      include_once '../inc/menu.php';
    ?>
    <div class="container-fluid">
      <div class="panel panel-success">
        <form class="form-inline" id="input-form">
          <div class="header-info text-center">
            <span class="mark h3">Some info about you</span>
          </div>
          <div class="row">
            <div class="col-xs-10 col-sm-offset-1 col-sm-3 col-xs-offset-1 col-md-2 col-md-offset-1 col-lg-2 col-lg-offset-1">
              <div class="row row-first">
                <div class="col-xs-12">
                  <div class="form-group">
                    <div class="input-group col-sm-12">
                      <input type="text" class="form-control" name="nick" id="nick" placeholder="Nickname" required>
                      <span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row row-middle">
                <div class="col-xs-12">
                  <div class="form-group">
                    <div class="input-group">
                      <input type="text" class="form-control" name="skype" id="skype" placeholder="Skype ID">
                      <span class="input-group-addon info"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row row-middle">
                <div class="col-xs-12">
                  <div class="form-group">
                    <div class="input-group">
                      <input type="text" class="form-control" name="icq" id="icq" placeholder="ICQ number">
                      <span class="input-group-addon info"><span class="glyphicon glyphicon-asterisk"></span></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xs-10 col-xs-offset-1 col-sm-2 col-md-2 col-md-offset-1 col-lg-2 col-lg-offset-1">
              <div class="row row-first">
                <div class="form-group col-xs-12">
                  <div class="input-group col-xs-12">
                    <?php
                      include '../inc/select_age.inc';
                    ?>
                  </div>
                </div>
              </div>
              <div class="row row-middle">
                <div class="form-group col-xs-12">
                  <div class="input-group col-xs-12">
                    <?php
                      include '../inc/select_gender.inc';
                    ?>
                  </div>
                </div>
              </div>
              <div class="row row-middle">
                <div class="form-group col-xs-12">
                  <div class="input-group col-xs-12">
                    <?php
                      include '../inc/select_goal.inc';
                    ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xs-10 col-xs-offset-1 col-sm-3 col-sm-offset-1 col-md-4 col-md-offset-1 col-lg-4 col-lg-offset-1">
              <div class="row row-first">
                <div class="form-group col-xs-12">
                  <div class="input-group col-xs-12">
                    <?php
                      include '../inc/select_country.inc';
                    ?>
                    <span class="input-group-addon danger"><span class="glyphicon glyphicon-remove"></span></span>
                  </div>
                </div>
              </div>
              <div class="row row-middle">
                <div class="form-group col-xs-12">
                  <div class="input-group col-xs-12">
                    <?php
                      include '../inc/select_language.inc';
                    ?>
                  </div>
                </div>
              </div>
              <div class="row row-middle">
                <div class="form-group col-xs-12">
                  <div class="input-group col-xs-12">
                    <?php
                      include '../inc/select_level.inc';
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row text-center row-last">
            <button type="button" class="btn btn-success" id="submit">
            <span class="glyphicon glyphicon-user"></span> Add and/or Refresh</button>
          </div>
        </form>
      </div>  
      <br />
      <br />
      <br />
      <div class="panel-1">
        <div class="row">
          <div id="learners" class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-10 col-md-offset-1 col-lg-10 col-lg-offset-1">
          </div>
        </div>
        <div class="row">
          <div  class="text-center" id="loader">
            <div class="load-wrap">
              <div class="load-4">
                <p>Loading ...</p>
                <div class="ring-1"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <br />
      <br />
      <br />
      <br />
      <div class="center">
        <span>
          <kbd>Copyright © 2015-<?=date('Y')?></kbd> | <code><a href="privacy.php">Privacy policy</a></code> | <abbr title="Say It Again!"><code><a href="/">sayitagain.16mb.com</a></code></abbr> | <code><a href="mailto:sayitagain666@gmail.com">contacts</a></code>
        </span>
      </div>
      <br />
      <!-- Go to www.addthis.com/dashboard to customize your tools -->
      <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5947fc616a5c95ea"></script> 
    </body>
</html>
