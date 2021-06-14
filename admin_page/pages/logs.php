<?php
session_start();
include('../../includes/db.php');
 ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>DNA: Logs</title>
    <?php include('../../includes/bootstrap.php'); ?>
    <style media="screen">
      .validate{
      width: 50%;
      align-self: center;
      }
    </style>
  </head>
  <body>
    <?php include('../includes/header.php'); ?><br>
    <div class="row">
      <div class="col-sm-6">
        <div class="card ms-5" style="width: 30rem;">
          <img src="https://fr.seaicons.com/wp-content/uploads/2015/11/check-1-icon.png" class="validate card-img-top" alt="...">
      <div class="card-body">
        <h5 class="card-title text-center"><strong><em>Last Connection</em></strong></h5>
    </div>
        <?php
          $log_verif=fopen('../log_success.txt','r');
          $result='debut';


          $cursor = -1;

          fseek($log_verif, $cursor, SEEK_END);
          $char = fgetc($log_verif);


          for ($i=0; $i < 5; $i++) {
            $line = '';
            while ($char === "\n" || $char === "\r") {
                fseek($log_verif, $cursor--, SEEK_END);
                $char = fgetc($log_verif);
            }

          while ($char !== false && $char !== "\n" && $char !== "\r") {
              $line = $char . $line;
              fseek($log_verif, $cursor--, SEEK_END);
              $char = fgetc($log_verif);
          }
           echo '<br><p class="card-text ms-2">'.$line.'</p>';
        }

          fclose($log_verif);



        ?>
      </div>
      <br>
      </div>
      <div class="col-sm-6">
        <div class="card ms-5" style="width: 30rem;">
          <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/3f/No-red.svg/1200px-No-red.svg.png" class="validate card-img-top" alt="...">
          <div class="card-body">
            <h5 class="card-title text-center"><strong><em>Last Logout</em></strong></h5>
          </div>
          <?php
            $logout=fopen('../log_logout.txt','r');
            $result='debut';


            $cursor = -1;

            fseek($logout, $cursor, SEEK_END);
            $char = fgetc($logout);


            for ($i=0; $i < 5; $i++) {
              $line = '';
              while ($char === "\n" || $char === "\r") {
                  fseek($logout, $cursor--, SEEK_END);
                  $char = fgetc($logout);
              }

            while ($char !== false && $char !== "\n" && $char !== "\r") {
                $line = $char . $line;
                fseek($logout, $cursor--, SEEK_END);
                $char = fgetc($logout);
            }
             echo '<br><p class="card-text ms-2">'.$line.'</p>';
          }

            fclose($logout);
          ?>
        </div>
      </div>

    </div>

  </body>
</html>
