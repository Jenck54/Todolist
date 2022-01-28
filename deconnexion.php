<?php 
    //On commence a utiliser les sessions
    session_start();
    //On supprime la session de l'utilisateur connecté
    session_destroy();
    //On redirige l'utilisateur vers la page d'accueil (index.php)
    header('location: index.php');
?>