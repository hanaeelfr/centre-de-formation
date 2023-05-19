
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
    <title>validation</title>
</head>
<body>

<nav class="navbar navbar-light bg-light">
       <a class="navbar-brand" href="formation.php">
    <img src="image/centre.png" alt="logo"  width="20%"></a>
<div class='d-flex'>
              <?php 
              if (isset($firstname)){
                echo"
                <form class='d-flex' role='search' action='profile.php' method='POST'>

                <button class='btn btn-outline-dark me-2' type='submit'>profile</button>
                </form>
                ";
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

    <h3 class="text-center">les formation que j'ai validé</h3>
    <style>
    h3{
        color: #5271FF;
    }
  </style>
  <?php
  
 

  $validation = $conn->query("SELECT * FROM formation F INNER JOIN session S on F.id_formation = S.id_formation INNER JOIN aprenant_session ASS ON S.id_session = ASS.id_session WHERE ASS.id_aprenant = '$user_id' AND ASS.resultat = 'valider';");
  $valider = $validation->fetchAll();
  $sesion_validés_count = COUNT($valider);
                    if( $sesion_validés_count == 0){
                        echo "<p class='text-center'>vous n'avez pas encore terminé votre formation</p>";
                    }else{
        foreach($valider as $ligne){
                       
            $id = $ligne['id_formation'];
            echo '
          <div class="card mb-3" style="max-width: 650px;">
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
                  }

?>

<h3 class="text-center">les formation que je n'ai pas validé</h3>

<?php
  
 

  $non_validation = $conn->query("SELECT * FROM formation F INNER JOIN session S on F.id_formation = S.id_formation INNER JOIN aprenant_session ASS ON S.id_session = ASS.id_session WHERE ASS.id_aprenant = '$user_id' AND ASS.resultat = 'non_valider';");
  $n_valider = $non_validation->fetchAll();
  $sesion_count = COUNT($n_valider);
                    if( $sesion_count == 0){
                        echo "<p class='text-center'>vous n'avez pas encore terminé votre formation</p>";
                    }else{
        foreach($n_valider as $ligne){
                       
            $id = $ligne['id_formation'];
            echo '
          <div class="card mb-3" style="max-width: 650px;">
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
                  }

?>
    
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
