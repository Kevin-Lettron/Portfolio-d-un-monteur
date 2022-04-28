<?php require_once("assets/init.inc.php");
//----------------- TRAITEMENT PHP -----------------//
if(!internauteEstConnecte()&& internauteEstConnecteEtEstAdmin()) 
{
header("location:profil.php");
}
if($_POST)
{
    $resultat = executeRequete("SELECT * FROM membres WHERE pseudo='$_POST[pseudo]'");
    if($resultat->num_rows != 0)
    {
        $membres = $resultat->fetch_assoc();
        if($membres['mdp'] == $_POST['mdp'])
        {
            foreach($membres as $indice => $element)
            {
             if($indice != 'mdp')   
            {
                $_SESSION['membres'][$indice] = $element;
            }
        }
        header("location:profil.php");
    }
    else
        {
          $contenu .= '<center><div class="erreur">Erreur de MDP</div></center>';
        }
    }
    else 
    {
      $contenu .= '<center><div class="erreur">Erreur de pseudo</div></center>';
    }
}

//------------------------ AFFICHAGE HTML ------------------------//
?>

<?php require_once("assets/haut.inc.php"); ?>
<?php echo $contenu; ?>

<form method="post" action="" class="form">

<label for="pseudo">Pseudo</label><br>
<input type="text" id="pseudo" name="pseudo"><br> <br>

<label for="mdp">Mot de passe</label><br>
<input type="text" id="mdp" name="mdp"><br><br>

<input type="submit" value="Se connecter">

</form>

<?php require_once("assets/bas.inc.php"); ?>