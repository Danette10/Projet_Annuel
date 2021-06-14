<!DOCTYPE html>
<html lang="fr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>DNA</title>
    <?php include('bootstrap.php'); ?>
    <style>
      .navbar{
        background-color: #032B52;
      }
      .link{
        color: white;
      }
      .link:hover, .btn:hover{
        color: black !important;
      }
      .button:hover{
        background-color: white;
      }
      .obligatory{
        color: red;
      }
      #result_zone{
        color:white;
      }
      #result_zone a{
        white-space: nowrap;
      }
      #result_zone text{
        white-space: nowrap;
      }
    </style>
  </head>
  <body>
      <nav class="navbar navbar-dark fixed-top navbar-expand-lg">
        <div class="container-fluid">
          <a href="https://dna-esgi.fr/index.php"><img src="https://dna-esgi.fr/images/LogoProjet.svg" class="logo float-left m-2 h-75 me-4" width="95" alt="Logo"></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <div>
                <div class="btn-group" role="group">
                  <a href="https://dna-esgi.fr/main_pages/VideosGames.php" class="link text-decoration-none button btn btn-lg border-light">Video Games</a>
                  <a href="https://dna-esgi.fr/main_pages/Forums.php" class="link text-decoration-none button btn btn-lg border-light">Forums</a>
                  <a href="https://dna-esgi.fr/main_pages/News.php" class="link text-decoration-none button btn btn-lg border-light">News</a>
                  <a href="https://dna-esgi.fr/main_pages/Store.php" class="link text-decoration-none button btn btn-lg border-light">Store</a>
                  <a href="https://dna-esgi.fr/profile/profile.php" class="link text-decoration-none button btn btn-lg border-light disabled">My Profile</a>
                </div>
                  <!-- Button trigger modal -->
                  <div class="btn-group" role="group">
                    <a class="button btn btn-lg popup border-light text-light" data-bs-toggle="modal" data-bs-target="#login">Login</a>
                    <a href="https://dna-esgi.fr/main_pages/Registration.php" class="link text-decoration-none button btn btn-lg popup border-light">Registration</a>
                  </div>

            </ul>
            <form class="d-flex">
              <div class="input-group">
                <input class="form-control" type="search" id="searchDNA" placeholder="Search" aria-label="Search">
                <button class="button btn btn-light" type="submit"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/4c/Search_Noun_project_15028.svg/785px-Search_Noun_project_15028.svg.png" width='24' height='24' alt="search_logo"></button>
              </div>
              <div id="result_zone">
              </div>
            </form>
          </div>
        </div>
      </nav>
      <!-- Login -->
      <div class="modal fade" id="login" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Login</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <form action="https://dna-esgi.fr/includes/verif_login.php" method="post" class="needs-validation">
                <div class="form-group">
                  <p class="ms-3" style="color: red;">Fields with "*" are mandatory!</p>
                  <label class="obligatory">*</label> <label>Username :</label>
                  <input type="text" id="id_account" name="id_account" class="form-control" placeholder="Type your username" required><br>

                  <label class="obligatory">*</label> <label>Password :</label>
                  <input type="password" id="password" name="password" class="form-control" placeholder="Type your password" required><br>
                  <input type="submit" name="formlogin" id="formlogin" class="btn btn-success" value="Submit">
                  <label for="checkbox" class="ms-2">
                    <input type="checkbox" id="checkbox">
                    Show password
                  </label>

                </div>
                <div>

                  <p>You don't have an account ? <a href="https://dna-esgi.fr/main_pages/Registration.php">Signup</a></p>
                  <p>You forgot your password ? <a href="https://dna-esgi.fr/profile/password_recovery.php">Send an email</a></p>
                </div>
              </form>

            </div>


          </div>
        </div>
      </div>
      <!-- End Login -->
      <div>

      </div>
      <br><br><br><br>
      <script src="js/validation_form.js" charset="utf-8"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  		<script type="text/javascript">
  		    $(document).ready(function() {
  		        var checkbox = $("#checkbox");
  		        var password = $("#password");
  		        checkbox.click(function() {
  		            if(checkbox.prop("checked")) {
  		                password.attr("type", "text");
  		            } else {
  		                password.attr("type", "password");
  		            }
  		        });
  		    });

          // Search
          $(document).ready(function(){
            $('#searchDNA').keyup(function(){
              $('#result_zone').html('');
              var research=$(this).val();
              if(research!=""){
                $.ajax({
                  type:'GET',
                  url:'includes/research.php',
                  data:'search='+research,
                  success: function(data){
                    console.log(data);
                    if(data !=""){
                      if(document.getElementById('result_zone')!=null){
                        const result_line=document.createElement('div');
                        result_line.innerHTML=data;
                        document.getElementById('result_zone').appendChild(result_line);
                      }
                    }
                    else{
                      document.getElementById('result_zone').innerHTML+="<tr>No result</tr>";
                    }
                  }
                })
              }
            });
          });
  		</script>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
  </body>
</html>
