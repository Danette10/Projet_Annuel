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
      .link, .logout, .logout:hover{
        color: white;
      }
      .link:hover, .btn:hover{
        color: black !important;
      }
      .button:hover{
        background-color: white;
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
                  <a href="https://dna-esgi.fr/profile/profile.php" class="link text-decoration-none button btn btn-lg border-light">My Profile</a>
                  <a href="https://dna-esgi.fr/admin_page/pages/users.php" class="link text-decoration-none button btn btn-lg border-light">Users</a>

                </div>
                <div class="btn-group">
                  <a href="https://dna-esgi.fr/main_pages/Logout.php" class="logout text-decoration-none btn btn-danger btn-lg border-light">Logout</a>

                </div>

            </ul>
            <form class="d-flex">
              <div class="input-group">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                <button class="button btn btn-light" type="submit"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/4/4c/Search_Noun_project_15028.svg/785px-Search_Noun_project_15028.svg.png" width='24' height='24' alt="search_logo"></button>
              </div>
            </form>
          </div>
        </div>
      </nav>
      <div>

      </div>
      <br><br><br><br>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
  </body>
</html>
