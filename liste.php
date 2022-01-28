<?php
include("header.php");

if (!isset($_SESSION['pseudo'])) {
    header('Location: index.php');
}

$connexion = new PDO(
    "mysql:dbname=todolist;host=localhost;charset=UTF8",
    "root",
    ""
);
$requete = $connexion->prepare(
    'SELECT * 
            FROM tache'
);
$requete->execute();

$listetaches = $requete->fetchAll();
?>

<a href="ajouter-tache.php" class="btn btn-success m-3">Ajouter une tache</a>

<div class="row">
    <?php
    foreach ($listetaches as $tache) {
    ?>
        <div class="col-3">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">
                    <a href="supprimer-tache.php?id=<?= $tache["id"] ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                    <a href="editer-tache.php?id=<?= $tache["id"] ?>" class="btn btn-info">
                        <i class="fas fa-edit"></i>
                    </a>
                </div>
                <div class="card-body">
                    <h4 class="card-title"><?= $tache["titre"] ?></h4>
                    <p class="card-text"><?= $tache["contenu"] ?></p>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>
<?php
include("footer.php");
?>