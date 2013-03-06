<!DOCTYPE html>
<html lang="en">
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>ICFS AGM 2013</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">
        <link rel="icon" href="../favicon.ico">

        <link rel="stylesheet" href="bs/css/bootstrap.min.css">
        <link rel="stylesheet" href="bs/css/bootstrap-responsive.min.css">
        <link rel="stylesheet" href="agm.css">
    </head>
    <body>

        <?php
            require 'core.php';

            if($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                $result = check($_POST['user'], $_POST['pass']);
            }
        ?>

        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12 pagination-centered logo-top"><img src="../images/logo.png" style alt="Imperial College Finance Society"></div>
            </div>

            <div class="row-fluid">
                <div class="span12 pagination-centered title-top"><h1>Welcome to the ICFS 2013 AGM</h1></div>
            </div>


            <div class="row-fluid">
                <div class="span12 pagination-centered title-top" style="margin-left:7px"><h3>Please sign in to register your attendance, and to receive your electronic ballot paper.</h3></div>
            </div>

<?php
        if(isset($result))
        {

          if($result[0])
          {
            ?>
            <div class="row-fluid span12 pagination-centered">
                <h4><img src="../images/tick.png" style="vertical-align:top;"> <?php echo $result[1]; ?></h4>
            </div> 
          <?php
          }
          else
          {
          ?>
            <div class="row-fluid span12 pagination-centered">
                <h4><img src="../images/error.png" style="vertical-align:top;"> <?php echo $result[1]; ?></h4>
            </div>
    <?php
          }
        }
        ?>

            <div class="row-fluid hidden-desktop">
                <div class="span12 offset2 form-top">
                        <form class="form-horizontal" method="POST" action="">
                          <div class="control-group">
                            <label class="control-label" for="user">College Username</label>
                            <div class="controls">
                              <input type="text" id="user" name="user" placeholder="Username">
                            </div>
                          </div>
                          <div class="control-group">
                            <label class="control-label" for="pass">Password</label>
                            <div class="controls">
                              <input type="password" id="pass" name="pass" placeholder="Password">
                            </div>
                          </div>
                          <div class="control-group">
                            <div class="controls">
                              <button type="submit" class="btn">Sign in</button>
                            </div>
                          </div>
                        </form>
                    </div>
                </div>
                <div class="row-fluid visible-desktop">
                    <div class="span12 offset4 form-top">
                            <form class="form-horizontal" method="POST" action="">
                              <div class="control-group">
                                <label class="control-label" for="user">College Username</label>
                                <div class="controls">
                                  <input type="text" id="user" name="user" placeholder="Username">
                                </div>
                              </div>
                              <div class="control-group">
                                <label class="control-label" for="pass">Password</label>
                                <div class="controls">
                                  <input type="password" id="pass" name="pass" placeholder="Password">
                                </div>
                              </div>
                              <div class="control-group">
                                <div class="controls">
                                  <button type="submit" class="btn">Sign in</button>
                                </div>
                              </div>
                            </form>
                    </div>
                </div>

            </div>
        </div>
    </body>
</html>