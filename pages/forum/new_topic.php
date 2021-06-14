<?php session_start(); ?>
<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>DNA: New Topic</title>
    <?php include('../../includes/bootstrap.php'); ?>
  </head>
  <?php
    if (isset($_SESSION['id_account'])) {
      include('../../profile/includes/header_members.php');
      setcookie('id_account', $_POST['id_account'], time() + 3600);
    }else{
      include('../../includes/header.php');
    }
   ?>
  <body>
    <form class="forum new_topic" action="verif_new_topic.php" method="post">

      <div class="col-5 mx-auto">
        <table class="forum new_topic">
          <tr class="header">
            <th class="main">New Topic</th>
            <th></th>
          </tr>
          <tr>
            <td>Subject</td>
            <td><input class="form-control" type="text" name="topic_subject" size="70" maxlength="70"></td>
          </tr>
          <p></p>
          <tr>
            <td>Categories</td>
            <td>
              <p></p>
              <select class="form-select" name="categories">
                <option>Platform</option>
                <option>Action</option>
                <option>FPS</option>
                <option>RPG</option>
                <option>Adventure</option>
                <option>Survival Horror</option>
                <option>Rogue-like</option>
                <option>Puzzle</option>
                <option>Simulation</option>
                <option>Strategy</option>
                <option>Race</option>
                <option>Management</option>
                <option>Labyrinth</option>
              </select>
            </td>
          </tr>
          <tr>
            <td>Message</td>
            <td><p></p><textarea class="form-control" name="topic_container"></textarea></td>
          </tr>
          <tr>
            <td>Notify me of answers</td>
            <td><input type="checkbox" name="topic_mail"></td>
          </tr>
          <tr>
            <td colspan="2"><input class="btn btn-success" type="submit" name="topic_submit"> </td>
          </tr>
        </table>
      </div>

    </form>

  </body>
</html>
<?php
  if (!isset($_SESSION['id_account']) && isset($_POST['topic_submit'])) {
    echo "
    <div class='alert alert-danger' role='alert'>
      You must be logged in to write a topic !
    </div>
    ";
  }
 ?>
