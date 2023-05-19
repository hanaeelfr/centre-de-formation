<?php 
include "includes/config.php";
session_start();



if(isset($_SESSION['nom'])){
$user_id = $_SESSION['id_aprenant'];
$firstname = $_SESSION['nom'];
$lastname = $_SESSION['prenom'];
$email =  $_SESSION['email'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="formation.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.4/flowbite.min.css" rel="stylesheet" />

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <title>profile</title>
</head>
<body>

<nav class="navbar navbar-light bg-light">
        <a class="navbar-brand" href="formation.php">
    <img src="image/centre.png" alt="logo"  width="20%"></a>
<div class='d-flex'>
              <?php 
              if (isset($firstname)){
                echo'
                <button class="d-flex btn btn-outline-dark me-2" data-bs-toggle="modal" data-bs-target="#exampleModal" type="submit">modifier mon profile</button>

                ';
              } else{
                  echo "
                  
                  <form class='d-flex' role='search' action='deconnecter.php' method='POST'>

                  <button class='btn btn-outline-dark me-2' type='submit'>deconnecter</button>
                  </form>
                  ";
                
              }
              ?>
            
             <?php
                if (isset($firstname)) {
                  echo '     
                  

                  <a id="deconnecter" href="sessio.php"><button class="btn btn-outline-dark" type="submit" name="deconnecter">déconnecter</a>
                  ';
                }else {
                  echo "
                  
                  <form action='connexion.php'>
                  <button class='btn btn-outline-dark' type='submit'>se connecter</button>
                  </form>";
                }
             ?>
            
                        
        </div>
        <style>
          #deconnecter{
            color: black;
            text-decoration: none;
          }
          #deconnecter:hover{
            color: white;
          }
        </style>
    
    </nav>






    <!-- pop profil -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Profil</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      
            <div class="modal-body">
    <form action="includes/update_profile.php" method="POST">
        <div class="mb-3">
            <label for="firstname" class="form-label">First Name:</label>
            <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $firstname; ?>">
        </div>
        <div class="mb-3">
            <label for="lastname" class="form-label">Last Name:</label>
            <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $lastname; ?>">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>">
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">enregistrer</button>
        </div>
    </form>

  
    </div>
  </div>

  </div>
  </div>



  <h3 class='text-center'>Mes formations</h3>
  <style>
    h3{
        color: #5271FF;
    }
  </style>
        <?php
                  
                    $session = $conn->query("SELECT * FROM formation F INNER JOIN session S on F.id_formation = S.id_formation INNER JOIN aprenant_session ASS ON S.id_session = ASS.id_session WHERE ASS.id_aprenant = '$user_id';
                    ");
                    $sessions = $session->fetchAll();
                    foreach($sessions as $ligne){
                       
                        $id = $ligne['id_formation'];
                              echo '<div class="card mb-3" style="max-width: 650px;">
                              <div class="row g-0">
                                        <div class="col-md-4">
                                                  <a><img src="image/'.$ligne['image'].'" class="img-fluid rounded-start" alt="..."></a>
                                        </div>
                                        <div class="col-md-8">
                                                  <div class="card-body">
                                                            <h5 class="card-title">'.$ligne['sujet'].'</h5>
                                                            <p class="card-text">'.$ligne['description'].'</p>
                                                            <p class="card-text"><small class="text-body-secondary">masse horaire : '.$ligne['masse_horaire'].'h</small></p>
                                                  </div>
                                                  
                                        </div>
                              </div>
                    </div>';
                    }



                  
                  
        ?>

        <form action='validation.php'>
            <div class="d-grid gap-2 col-4 mx-auto">
                <button class="btn btn-outline-dark" type="submit">mon historique</button>
            </div>
                  
        </form>




  

<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>



<footer class="text-center p-2 text-primary bg-secondary-subtle">
<div class="container text-center">
    <p> © 2023 HN FR</p>

    <i class="fa-brands fa-facebook" style="color: #045df6;"></i>
    </div>
            
</footer>
</body>
</html>
