<?php
$msg="";
include "includes/config.php";

session_start();
   
        if(isset($_POST['submit'])) {
            $email = $_POST["email"];

            $password = md5($_POST["password"]);
            echo $password;
            // $aprenantid = $_SESSION["id_aprenant"];
            $connexion = $conn->prepare("SELECT * FROM `aprenant` WHERE `email` = :email and `password`= :password");
            $connexion->bindParam(':email', $email);
            $connexion->bindParam(':password', $password);
        
            $connexion->execute();
            $result = $connexion->fetch(PDO::FETCH_ASSOC);
        
        if ($result) { 
        
                $_SESSION['id_aprenant'] = $result['id_aprenant'];
                $_SESSION['nom'] = $result['nom'];
                $_SESSION['prenom'] = $result['prenom'];
                $_SESSION['email'] = $result['email'];
            }
          
        $id_aprenant =$_SESSION['id_aprenant'];
            if ($connexion->execute()) {
				$result = $connexion->fetch(PDO::FETCH_ASSOC);
				if ($result) {
					// utilisateur connecté avec succès
					// rediriger vers la page d'accueil
    				header("Location: formation.php");
    				exit();
				} else {
					// nom d'utilisateur ou mot de passe incorrect
					$error = "Nom d'utilisateur ou mot de passe incorrect";
				}
			} else {
				// erreur de connexion à la base de données
				$error = "Erreur de connexion à la base de données";
			}
        }
        
        
        
        
        
       

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="agence.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <title>connexion</title>
</head>
<body>

    <div class="container py-5 h-100">
        <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5 px-md-2 color :#004AAD;">Connectez-vous </h3>
            <form class="px-md-2" action="" method="POST">

                <div class="form-outline mb-4">
                <label class="form-label" for="form3Example1q">Email <span class="text-danger">*</span></label>
                    <input type="email" name="email" id="form3Example1q" class="form-control" />
                </div>

                <div class="form-outline mb-4">
                <label class="form-label" for="form3Example1q">Mot de passe <span class="text-danger">*</span></label>
                    <input type="password" name="password" id="form3Example1q" class="form-control" />
                </div>
        
                <p style="color:red;margin-left:4%;"><?php echo $msg;?></p>
    
                <!-- Ajouter un champ caché pour stocker l'ID du client -->
                    <input type="hidden" name="clientID" value="<?php echo isset($clientID) ? $clientID : ''; ?>">
                    <div class="form-group">
    			<?php if (isset($error)) { ?>
        		<div class="alert alert-danger" role="alert">
            		<?php echo $error; ?>
        		</div>
    				<?php } ?>
                    <input type="submit"  class="btn btn-outline-primary my-sm-0 mb-3 ms-5 btn-lg mb-1" name="submit" value="connexion">
	            </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>