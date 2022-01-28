<?php

include("header.php");

$erreurLogin = false;
//Si l'utilisateur a validé le formulaire
if (isset($_POST["valider"])) {

    $connexion = new PDO(
        "mysql:dbname=todolist;host=localhost;charset=UTF8",
        "root",
        ""
    );
    $requete = $connexion->prepare(
        'SELECT * 
            FROM `utilisateur` 
            WHERE pseudo= ? 
            /*AND mot_de_passe= ?*/
        '
    );
    $requete->execute([
        $_POST['pseudo']/*,
            $_POST['mot_de_passe']*/
    ]);
    $utilisateur = $requete->fetch();

    //si l'utilisateur existe
    if ($utilisateur) {
        $motDePasseSaisi = $_POST['mot_de_passe'];
        $motDePasseCrypte = $utilisateur['mot_de_passe'];
        $motDePasseCompatible = password_verify($motDePasseSaisi, $motDePasseCrypte);
        if ($motDePasseCompatible) {
            $_SESSION['pseudo'] = $_POST['pseudo'];
            header('Location: liste.php');
        } else {
            $erreurLogin = true;
        }
    } else {
        $erreurLogin = true;
    }
}
?>
<div class="container">

    <?php
    if ($erreurLogin) {
    ?>

        <div class="alert alert-dismissible alert-warning">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <h4 class="alert-heading">Mauvais Login / Mot De Passe</h4>
            <p class="mb-0">Ce compte n'existe pas, vous pouvez demander a renouveler votre mot de passe</p>
        </div>
    <?php
    }
    ?>
    <form method="post">
        <div class="form-group">
            <label class="col-form-label mt-4" for="inputDefault">Pseudo</label>
            <input type="text" value="<?php if (isset($_POST["pseudo"])) echo $_POST["pseudo"] ?>" name="pseudo" class="form-control" placeholder="Ex : Jenck" id="pseudo">
        </div>
        <div class="form-group">
            <label for="Mot De Passe" class="form-label mt-4">Mot De Passe</label>
            <input type="password" name="mot_de_passe" class="form-control" id="mot_de_passe">
        </div>
        <input class="btn btn-success mt-3" type="submit" value="Se connecter" name="valider">
    </form>
    <a href="inscription.php" class="btn btn-primary mt-3">Inscription</a>
</div>

<?php
include("footer.php");
?>