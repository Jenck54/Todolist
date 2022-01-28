<?php
$connexion = new PDO(
    "mysql:dbname=todolist;host=localhost;charset=UTF8",
    "root",
    ""
);
$requete = $connexion->prepare(
    'DELETE FROM tache WHERE id = ?'
);
$requete->execute([
    $_GET['id']
]);

//Redirection vers la page des tâches
header('Location: liste.php');
?>