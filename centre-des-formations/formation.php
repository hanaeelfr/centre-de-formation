<?php

include "includes/config.php";
session_start();

   
        

       if(isset($_SESSION['nom'])){
        
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
    <title>page d'accuiel</title>
</head>
<body>
    <nav class="navbar navbar-light bg-light">
        <img src="image/centre.png" alt="logo"  width="8%">


        <div class="d-flex me-5">
    <form class='d-flex' action="" method="post" role="search">
                <div class="me-2">
                    <select class="form-select" name="categorie">
                        <option value="">Choisir une session</option>
                        <option value="Informatique">Informatique</option>
                        <option value="Langues">Langues</option>
                        <option value="Gestion de projet">Gestion de projet</option>
                        <option value="Communcation">Communication</option>
                        <option value="Ressources humaines">Ressources humaines</option>
                    </select>
                </div>
                <button class="btn btn-outline-dark me-2" name="recherche" type="submit">Rechercher</button>
    </form>
    <?php
  
    
    ?>
              <?php 
              if (!isset($firstname)){
                echo"
                <form class='d-flex' role='search' action='inscrire.php' method='POST'>

                <button class='btn btn-outline-dark me-2' type='submit'>s'inscrire</button>
                </form>

                ";
              } else{
                  echo "
                  
                  <form class='d-flex' role='search' action='profile.php' method='POST'>

                  <button class='btn btn-outline-dark me-2' type='submit'>profile</button>
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

      <!-- Header-->
  <div class="image-container">
      <div class="image">
        <div class="text">
            <h1>Les formations professionnelles</h1>
            <p>Notre centre de formation offre des programmes de formation professionnelle
                de haute qualité pour les étudiants souhaitant acquérir les compétences
                et les connaissances nécessaires pour réussir dans leur carrière.
                Chez HN FR, notre objectif est de fournir une formation de qualité supérieure pour aider les étudiants à réussir dans leur carrière.</p>          </div>
        </div>
      </div>
          
        
  </div>
      

    <div class='cardes'>
      
    <?php
if(isset($_POST['recherche'])){
  $categorie = $_POST['categorie'];
  $sth = $conn->prepare("SELECT * FROM `formation`");
  if(!empty($categorie)){

    $sth = $conn->query("SELECT * FROM formation WHERE catégorie = '$categorie'");
  }
  $sth->execute();
        $response = $sth->fetchAll();
  foreach($response as $ligne){
    $id = $ligne["id_formation"];
    // echo $apprenantId;
    echo "
    
    <div class='max-w-sm bg-white cards border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 ms-4'>
    <a href='detail.php?id=".$id."'>
            <img class='rounded-t-lg' src=image/".$ligne["image"]." alt='' width= 100%/>
        </a>
        <div class='p-5'>
                <h5 class='mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-primary'>".$ligne["sujet"]."</h5>
            <p class='mb-3 font-normal text-gray-700 dark:text-gray-400 '>Catégorie : ".$ligne["catégorie"]."</p>
            <p class='mb-3 font-normal text-gray-700 dark:text-gray-400'> Description :".$ligne["description"]."</p>
            <p class='mb-3 font-normal text-gray-700 dark:text-gray-400'>Masse horaire : ".$ligne["masse_horaire"]."h</p>
            
      
            <form action='detail.php' method='get'>
                    <input type='hidden' name='id'  value=".$ligne["id_formation"].">
                    </form>
          
        </div>
        </div>

        ";

  }
  
}else{
$sth = $conn->prepare("SELECT * FROM `formation`");
        $sth->execute();
        $response = $sth->fetchAll();
  foreach($response as $ligne){
    $id = $ligne["id_formation"];
    // echo $apprenantId;
    echo "
    
    <div class='max-w-sm bg-white cards border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 ms-4'>
    <a href='detail.php?id=".$id."'>
            <img class='rounded-t-lg' src=image/".$ligne["image"]." alt='' width= 100%/>
        </a>
        <div class='p-5'>
                <h5 class='mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white text-primary'>".$ligne["sujet"]."</h5>
            <p class='mb-3 font-normal text-gray-700 dark:text-gray-400 '>Catégorie : ".$ligne["catégorie"]."</p>
            <p class='mb-3 font-normal text-gray-700 dark:text-gray-400'> Description :".$ligne["description"]."</p>
            <p class='mb-3 font-normal text-gray-700 dark:text-gray-400'>Masse horaire : ".$ligne["masse_horaire"]."h</p>
            
      
            <form action='detail.php' method='get'>
                    <input type='hidden' name='id'  value=".$ligne["id_formation"].">
                    </form>
          
        </div>
        </div>

        ";


        

  
  }
}

    ?>
    </div>




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