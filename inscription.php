<?php
include("header.php");

$erreurconfirmer_mot_de_passe = false;
$erreurmot_de_passe_trop_court = false;

//Si l'utilisateur a validé le formulaire
if (isset($_POST['valider'])) {

    // Si le mot de passe fait moins de 5 caractères
    if (strlen($_POST["mot_de_passe"]) < 5) {
        $erreurmot_de_passe_trop_court = true;

        // Sinon si les mots de passe sont identiques
    } else if ($_POST["mot_de_passe"] == $_POST["confirmer_mot_de_passe"]) {


        $connexion = new PDO(
            "mysql:dbname=todolist;host=localhost;charset=UTF8",
            "root",
            ""
        );
        $requete = $connexion->prepare(
            'INSERT INTO utilisateur (id, pseudo, mot_de_passe)
                VALUES (NULL, ?, ?)'

        );
        $requete->execute([
            $_POST['pseudo'],
            password_hash($_POST['mot_de_passe'], PASSWORD_BCRYPT)
        ]);

        //Redirection vers la page d'accueil
        header('Location: index.php');
    } else {
        $erreurconfirmer_mot_de_passe = true;
    }
}
?>
<form method="post">
    <div class="container">
        <div class="form-group">
            <label class="col-form-label mt-4" for="inputDefault">Pseudo</label>
            <input type="text" value="<?php if (isset($_POST["pseudo"])) echo $_POST["pseudo"] ?>" name="pseudo" class="form-control" placeholder="Ex : Jenck" id="pseudo">
        </div>
        <div class="form-group <?php if ($erreurmot_de_passe_trop_court) echo "has-danger" ?>">
            <label for="Mot De Passe" class="form-label mt-4">Mot De Passe</label>
            <input type="password" name="mot_de_passe" class="form-control <?php if ($erreurmot_de_passe_trop_court) echo "is-invalid" ?>" id="mot_de_passe">
            <?php
            if ($erreurmot_de_passe_trop_court) {
            ?>
                <div class="invalid-feedback">Le mot de passe est trop court (5 caractères minimum)</div>
            <?php
            }
            ?>
        </div>
        <div class="form-group <?php if ($erreurconfirmer_mot_de_passe) echo "has-danger" ?>">
            <label for="confirmer_mot_de_passe" class="form-label mt-4">Confirmer le Mot De Passe</label>
            <input type="password" name="confirmer_mot_de_passe" class="form-control <?php if ($erreurconfirmer_mot_de_passe) echo "is-invalid" ?>" id="confirmer_mot_de_passe">
            <?php
            if ($erreurconfirmer_mot_de_passe) {
            ?>
                <div class="invalid-feedback">Les mots de passe ne correspondent pas</div>
            <?php
            }
            ?>
        </div>

        <!-- <div class="form-group has-danger"> 
            <label class="form-label mt-4" for="inputInvalid">Invalid input</label>
            <input type="text" value="wrong value" class="form-control is-invalid" id="inputInvalid">
            <div class="invalid-feedback">Sorry, that username's taken. Try another?</div>
        </div>-->
        <input class="btn btn-success mt-3" type="submit" value="S'inscrire" name="valider">
    </div>
</form>
<?php
include("footer.php");
?>