
<?php
include "includes/config.php";
session_start();

if(isset($_SESSION['email'])){
    $firstname= $_SESSION['nom'];
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
       <a class="navbar-brand" href="formation.php">
    <img src="image/centre.png" alt="logo"  width="20%"></a>


        <div class="d-flex me-5">

                <div class="me-2">
                    <select class="form-select" name="session">
                        <option value="excel">Choisir une session</option>
                        <option value="excel">Formation excel</option>
                        <option value="français">Langue française</option>
                        <option value="Gestion de projet">Gestion de projet</option>
                        <option value="communcation">Communication</option>
                        <option value="Ressources">Ressources humaines</option>
                    </select>
                </div>
                
                <button class="btn btn-outline-dark me-2" type="submit">Rechercher</button>
        
                <?php 
              
                if (isset($firstname)){
                    echo"
                    <form class='d-flex' role='search' action='profile.php' method='POST'>

                    <button class='btn btn-outline-dark me-2' type='submit'>profile</button>
                    </form>

                    
    
                    ";
                  } else{
                      echo "
                      <form class='d-flex' role='search' action='inscrire.php' method='POST'>
    
                      <button class='btn btn-outline-dark me-2' type='submit'>s'inscrire</button>
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
                  </form>                  
                  ";
                 
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

   

    <div class='cardes'>
<?php 
                   
                    $id = $_GET['id'];
                    $detail = $conn->query("SELECT * FROM formation F INNER JOIN session S ON S.id_formation = F.id_formation WHERE S.id_formation = '$id'
                    ");
                    $detail = $detail->fetchAll();
                    if(!isset($_SESSION['email'])) {
                    foreach($detail as $ligne){
                        $id_session = $ligne['id_session'];
                        
                        echo "
                        
                        <form action='connexion.php' method='get'>
    
                        <div class='card border-primary mt-4 mb-4' style='max-width: 30rem;'>
                            <div class='p-5'>
                            <h4 class='card-title text-primary'>".$ligne["sujet"]."</h4>
                            <p class='card-text text-secondary'>".$ligne["description"]."</p>
                            <p class='card-text'>Date début: ".$ligne["date_début"]." </p>
                            <p class='card-text'>Date fin: ".$ligne["date_fin"]."</p>
                            <p class='card-text'>état: ".$ligne["etat"]."</p>
                            
                            <input type='hidden' name='id_sesion' value='".$ligne["id_session"]."'>
                            <input class='btn btn-primary' type='submit' id='id_session' name='id_session' value='rejoindre'>
                            
                            
                          
                            </div>     
                                
                            </div>
                            </form>
                    
                            ";
              }
            }else{
                foreach($detail as $ligne){
                    $id_session = $ligne['id_session'];
                    $etat = $ligne["etat"];
                    if($etat == "en cours d'inscription" ){
                    echo "
                    
                    <form action='session.php' method='get'>

                    <div class='card border-primary mt-4 mb-4' style='max-width: 30rem;'>
                        <div class='p-5'>
                        <h4 class='card-title text-primary'>".$ligne["sujet"]."</h4>
                        <p class='card-text text-secondary'>".$ligne["description"]."</p>
                        <p class='card-text'>Date début: ".$ligne["date_début"]." </p>
                        <p class='card-text'>Date fin: ".$ligne["date_fin"]."</p>
                        <p class='card-text'>état: ".$ligne["etat"]."</p>
                        
                        <input type='hidden' name='id_sesion' value='".$ligne["id_session"]."'>
                        <input class='btn btn-primary' type='submit' id='id_session' name='id_session' value='rejoindre'>
                        
                        
                      
                        </div>     
                            
                        </div>
                        </form>
                
                        ";
                    }else{
                        echo "
                    
                    <form action='session.php' method='get'>

                    <div class='card border-primary mt-4 mb-4' style='max-width: 30rem;'>
                        <div class='p-5'>
                        <h4 class='card-title text-primary'>".$ligne["sujet"]."</h4>
                        <p class='card-text text-secondary'>".$ligne["description"]."</p>
                        <p class='card-text'>Date début: ".$ligne["date_début"]." </p>
                        <p class='card-text'>Date fin: ".$ligne["date_fin"]."</p>
                        <h3 class='card-text'>état: ".$ligne["etat"]."</h3>
                        
                     
                        
                        
                      
                        </div>     
                            
                        </div>
                        </form>
                
                        ";
                    }
            }
        }
          ?>

      

</div>





 <!-- Bootstrap core JS-->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>



<footer class="text-center p-2 text-primary bg-secondary-subtle">
<div class="container text-center">
    <p> © 2023 HN FR</p>
    </div>
    </body>
</html>
