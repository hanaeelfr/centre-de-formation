<?php
// start the session and include your database connection file
session_start();
include "includes/config.php";

// get the user ID from the session
$user_id = $_SESSION['id_aprenant'];
// get the updated profile information from the form
$firstname = $_POST['firstname'];
$lastname = $_POST['lastname'];
$email = $_POST['email'];

// validate the input
if (empty($firstname)||empty($lastname)||empty($email)) {
    // if any of the fields are empty, redirect back to the profile page with an error message
    $_SESSION['error'] = 'All fields are required.';
    header('Location: formation.php');
    exit();
} else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // if the email is not valid, redirect back to the profile page with an error message
    $_SESSION['error'] = 'Invalid email address.';
    header('Location: ../formation.php?id=');
    exit();
}

// update the user's profile information in the database
$stmt = $conn->prepare("UPDATE aprenant SET nom = :nom, prenom = :prenom, email = :email WHERE id_aprenant = :id_aprenant");
$stmt->bindParam(':nom', $firstname);
$stmt->bindParam(':prenom', $lastname);
$stmt->bindParam(':email', $email);
$stmt->bindParam(':id_aprenant', $user_id);
$stmt->execute();

// update the session variables with the new profile information
$_SESSION['nom'] = $firstname;
$_SESSION['prenom'] = $lastname;
$_SESSION['email'] = $email;

// redirect back to the profile page with a success message
$_SESSION['success'] = 'Profile updated successfully.';
header('Location: ../formation.php?id=');
exit();
?>
