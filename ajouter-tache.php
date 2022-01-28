<?php
include('header.php');

if (isset($_POST['valider'])) {
    $connexion = new PDO(
        "mysql:dbname=todolist;host=localhost;charset=UTF8",
        "root",
        ""
    );
    $requete = $connexion->prepare(
        'INSERT INTO tache (id, titre, contenu)
                VALUES (NULL, ?, ?)'

    );
    $requete->execute([
        $_POST['titre'],
        $_POST['contenu']
    ]);

    //Redirection vers la page des tâches
    header('Location: liste.php');
}
?>

<form method="POST">
    <div class="form-group">
        <label class="col-form-label mt-4" for="titre">Titre</label>
        <input type="text" class="form-control" id="titre" name="titre">
    </div>
    <div class="form-group">
        <label for="contenu" class="form-label mt-4">Contenu</label>
        <textarea class="form-control" id="contenu" rows="3" name="contenu"></textarea>
    </div>
    <input type="submit" class="btn btn-success mt-3" value="Ajouter la tâche" name="valider">
</form>

<?php
include('footer.php');
?>