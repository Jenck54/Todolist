<?php
include('header.php');

$connexion = new PDO(
    "mysql:dbname=todolist;host=localhost;charset=UTF8",
    "root",
    ""
);
$requete = $connexion->prepare(
    'SELECT * FROM tache WHERE id = ?'
);
$requete->execute([
    $_GET['id']
]);

$tache = $requete->fetch();
?>

<form method="POST">
    <div class="form-group">
        <label class="col-form-label mt-4" for="titre">Titre</label>
        <input type="text" class="form-control" id="titre" name="titre" value="<?= $tache['titre'] ?>">
    </div>
    <div class="form-group">
        <label for="contenu" class="form-label mt-4">Contenu</label>
        <textarea class="form-control" id="contenu" rows="3" name="contenu"><?= $tache['contenu'] ?></textarea>
    </div>
    <input type="submit" class="btn btn-success mt-3" value="Enregistrer" name="valider">
</form>

<?php
include('footer.php');
?>