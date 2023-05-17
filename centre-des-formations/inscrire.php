<?php

if (isset($_POST['submit'])) {
    $Nom= $_POST['nom'];
    $Prenom = $_POST['prenom'];
    $Email = $_POST['email'];
    $password = $_POST['password'];
    
    $hashed_password = md5($password);
    // validate form data
    if (empty($Nom) ||  empty($Prenom) ||  empty($Email) ||  empty($password)) {
        echo "Please fill in all fields)";
    } elseif (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        echo "Please enter a valid email address.";
    } else {
        // connect to the database
        $host = 'localhost';
        $dbname = 'centre_formation';
        $username = 'root';
        $password = '';
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

        // insert data into database
        $sql = "INSERT INTO `aprenant`(`nom`, `prenom`, `email`, `password`)  VALUES (:nom, :prenom, :email, :password)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nom', $Nom);
        $stmt->bindParam(':prenom', $Prenom);
        $stmt->bindParam(':email', $Email);
        $stmt->bindParam(':password', $hashed_password);
        if ($stmt->execute()) {
            header("location:connexion.php");
        } else {
            echo "Error: " . $stmt->errorInfo()[2];
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="formation.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>inscription</title>
</head>
<body>
  
<section class="vh-100" style="background-color: #ffff;">
<div class="container py-5 h-100">
  <div class="d-flex card-body p-4 p-md-5">
    <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1 ">
        <h3 class="text-center h1 fw-bold p-5 text-primary-emphasis">Créer votre compte</h3>
            <form action="" method="post">
            <div class="d-flex flex-row align-items-center mb-4 p-2">
                <div class="form-outline flex-fill mb-0 ">
                <label class="form-label text-secondary" for="form3Example1c">Votre nom <span class="text-danger">*</span></label>
                    <input type="text" name="nom" id="form3Example1c" class="form-control" />
                </div>
            </div>

            <div class="d-flex flex-row align-items-center mb-4 p-2">
                <div class="form-outline flex-fill mb-0">
                <label class="form-label text-secondary" for="form3Example3c">Votre prénom <span class="text-danger">*</span></label>
                    <input type="text" name="prenom" id="form3Example3c" class="form-control" />
                </div>
            </div>

            <div class="d-flex flex-row align-items-center mb-4 p-2">
                <div class="form-outline flex-fill mb-0">
                <label class="form-label text-secondary" for="form3Example3c">Votre email <span class="text-danger">*</span></label>
                    <input type="email" name="email" id="form3Example3c" class="form-control" />
                </div>
            </div>

            <div class="d-flex flex-row align-items-center mb-4 p-2">
                <div class="form-outline flex-fill mb-0">
                <label class="form-label text-secondary" for="password">Mot de passe <span class="text-danger">*</span> </label>
                    <input type="password" name="password" onkeyup="passwordValid()" id="password" class="form-control" />
                </div>
            </div>

            <div class="d-flex flex-row align-items-center mb-4 p-2">
                
                <div class="form-outline flex-fill mb-0">
                <label class="form-label" for="form3Example4cd">confirmer le mot de passe <span class="text-danger">*</span></label>
                    <input type="password" id="conMTP" name='confirmer' class="form-control" />
                </div>
            </div>

           
                
            <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4 p-2">
              <input type="submit"  class="btn btn-outline-primary my-sm-0 mb-3 ms-5" name="submit" value="S'inscrire">
            </div>
                
            </form>
            
    </div>
    <img src="image/technologi.png" alt="">
  </div>
</div>
</section>
<script>
 function passwordValid(){
    let mtp = document.getElementById("password").value;
    let regEx = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/;

    if(regEx.test(mtp)){
        document.getElementById("password").style.border='5px solid green';
    }
    else{
        document.getElementById("password").style.border='5px solid red';
    }
    document.getElementById("conMTP").onkeyup=function(){
        let confMTP = document.getElementById("conMTP").value;
        if(confMTP==mtp){
            document.getElementById("conMTP").style.border='5px solid green';
        }
        else{
            document.getElementById("conMTP").style.border='5px solid red';
        }

    }
 }
</script>


</body>
</html>