<?php
include "includes/config.php";
session_start();



if(!empty($_SESSION["id_aprenant"])){
    $id = $_SESSION["id_aprenant"];
    $stmt = $conn->prepare("SELECT * FROM aprenant WHERE id_aprenant = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $row = $stmt->fetch();
}

    $id_apprenant = $_SESSION['id_aprenant'];
    
    $id_session = $_GET['id_sesion'];

    $checkres = $conn->prepare("SELECT * FROM session WHERE id_session = :id_session");
$checkres->bindParam(':id_session', $id_session);
$checkres->execute();






// Test de chauvechement
$chauvechement = $conn->prepare("SELECT COUNT(*) FROM aprenant_session A INNER JOIN session S ON S.id_session = A.id_session  WHERE id_aprenant = ? AND 
    (
        (S.date_début > (SELECT date_début FROM session S WHERE id_session = ?) AND S.date_début < (SELECT date_fin FROM session S WHERE id_session = ?))
        OR (S.date_fin > (SELECT date_début FROM session S WHERE id_session = ?) AND S.date_fin < (SELECT date_fin FROM session S WHERE id_session = ?))
        OR (S.date_début < (SELECT date_début FROM session S WHERE id_session = ?) AND S.date_fin > (SELECT date_fin FROM session S WHERE id_session = ?))
    )");
$chauvechement->bindParam(1, $id_apprenant);
$chauvechement->bindParam(2, $id_session);
$chauvechement->bindParam(3, $id_session);
$chauvechement->bindParam(4, $id_session);
$chauvechement->bindParam(5, $id_session);
$chauvechement->bindParam(6, $id_session);
$chauvechement->bindParam(7, $id_session);
$chauvechement->execute();
$chauvechements = $chauvechement->fetchColumn();

// Test du nombre d'inscrits
$number_session = $conn->prepare("SELECT COUNT(*) FROM aprenant_session A INNER JOIN session S ON S.id_session = A.id_session  WHERE A.id_aprenant = ? AND YEAR(S.date_début) = YEAR(NOW())");
$number_session->bindParam(1, $id_apprenant);
$number_session->execute();
$count_session = $number_session->fetchColumn();

// Test des places maximales
$nombre_inscrit = $conn->prepare("SELECT COUNT(*) FROM aprenant_session A INNER JOIN session S ON S.id_session = A.id_session  WHERE S.id_session = ?");
$nombre_inscrit->bindParam(1, $id_session);
$nombre_inscrit->execute();
$nmbi = $nombre_inscrit->fetchColumn();

$nombre_place_maximal = $conn->prepare("SELECT place_max FROM session S WHERE S.id_session = ?");
$nombre_place_maximal->bindParam(1, $id_session);
$nombre_place_maximal->execute();
$nmpl = $nombre_place_maximal->fetchColumn();

// test de date
$date_debut = $conn->prepare("SELECT date_début FROM session S WHERE S.id_session = ?");
$date_debut->bindParam(1, $id_session);
$date_debut->execute();
$date = $date_debut->fetchColumn();

if ($nmbi < $nmpl && $count_session < 2 && $chauvechements == 0) {
    $sql = "INSERT INTO aprenant_session (id_aprenant, id_session) VALUES (?, ?)";
    $insert = $conn->prepare($sql);
    $insert->bindParam(1, $id_apprenant);
    $insert->bindParam(2, $id_session);
    $insert->execute();

    if ($insert) {
        header("Location: profile.php");
        exit();
    } else {
        echo "Erreur lors de l'insertion";
    }
}elseif($nmbi == $nmpl ){
   $update_session = "UPDATE `session` SET `etat`='inscription achevée' WHERE id_session = '$id_session'";
   $conn->exec($update_session);
}elseif($nmbi > 3 && $date == NOW()){
    $update_session = "UPDATE `session` SET `etat`='en cours' WHERE id_session = '$id_session'";
   $conn->exec($update_session);
}elseif($count_session == 2){
    echo'
        <h2> vous avez dèja 2 session</h2>
    ';
}elseif($chauvechements > 0){
    echo'
        <h2> vous avez dèja une session qui se chevauche avec une autre session </h2>
    ';
}




?>