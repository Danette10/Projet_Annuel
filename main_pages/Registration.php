<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>DNA: Registration</title>
    <?php include('../includes/bootstrap.php'); ?>
    <style media="screen">
      .obligatory{
        color: red;
      }
    </style>
  </head>
  <body>
    <?php include('../includes/header.php'); ?>

    <form action="../includes/verif_registration.php" class="row g-3 needs-validation" method="post" enctype="multipart/form-data" novalidate>

      <div class="col-sm-4 mx-auto pt-5">
          <p style="color: red;">Fields with "*" are mandatory!</p>
          <label class="obligatory">*</label> <label>Username :</label>
          <input type="text" name="id_account" id="id_account" class="form-control" placeholder="Type your username" required><br>

          <label class="obligatory">*</label> <label>Email :</label>
          <input type="email" name="email" id="email" class="form-control" placeholder="Type your email" required><br>

          <label class="obligatory">*</label> <label>Type your password :</label>
          <input type="password" name="password_register" id="password_register" class="form-control" placeholder="Type your password" required>
          <label for="checkbox">
            <input type="checkbox" id="checkbox_register">
            Show password
          </label>
          <p><br></p>

          <label class="obligatory">*</label> <label>Retype your password :</label>
          <input type="password" name="cpassword_register" id="cpassword_register" class="form-control" placeholder="Retype your password" required>
          <input type="checkbox" id="checkbox_conf_register">
          Show password
        </label>
        <p><br></p>

          <label class="obligatory">*</label> <label>Your date of birth :</label>
          <input type="date" name="bday" id="bday" class="form-control" placeholder="Type your date of birth" required><br>

          <label class="obligatory">*</label> <label>Your phone number :</label>
          <input type="tel" name="phone" id="phone" class="form-control" placeholder="Type your phone number" required><br>

          <label>Choose your pictures (png, jpeg, gif) :</label>
          <input type="file" class="form-control" name="image" id="image" accept="image/jpeg,image/png,image/gif"><br>

          <!-- Captcha -->

          <label class="obligatory">*</label> <label>Enter what you see on the screen (only numbers):</label>
          <img src="../includes/captcha.php">
          <input class="form-control" type="number" name="captcha" placeholder="Enter what you see on the screen" required><br>


          <input type="submit" name="formsend" id="formsend" class="btn btn-success" value="Submit">
        </div>
        <!-- End Captcha -->

      </div>
    </form>
    <script src="includes/js/validation_form.js" charset="utf-8"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<script type="text/javascript">
		    $(document).ready(function() {
		        var checkbox = $("#checkbox_register");
		        var password = $("#password_register");
            var checkbox_conf = $("#checkbox_conf_register");
            var password_conf = $("#cpassword_register");
		        checkbox.click(function() {
		            if(checkbox.prop("checked")) {
		                password.attr("type", "text");
		            } else {
		                password.attr("type", "password");
		            }
		        });
            checkbox_conf.click(function() {
		            if(checkbox_conf.prop("checked")) {
		                password_conf.attr("type", "text");
		            } else {
		                password_conf.attr("type", "password");
		            }
		        });
		    });
		</script>
  </body>
</html>
