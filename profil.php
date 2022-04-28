<?php require_once("assets/init.inc.php");
//---------------------------------  TRAITEMENTS  PHP  ---------------------------------//
if(isset($_GET['action']) && $_GET['action'] == "deconnexion")
{
session_destroy();
header("Location:connexion.php");
}
if(!internauteEstConnecte()&& internauteEstConnecteEtEstAdmin())  header("location:connexion.php");
//  debug($_SESSION);
$contenu.= '<div class="form">';
$contenu.= '<h2>Bonjour  <strong>'. $_SESSION['membres']['pseudo']  . '</strong></h2><br>';
$contenu.= '<center><p> Bienvenue dans votre espace admin. <br> Pour accèder à la gestion veuillez cliquer sur le bouton gestion de votre navigation. </p></center>';
$contenu.= '<p> Voulez-vous vous déconnecter ? </p>';
$contenu.= '<a id="disco" href="?action=deconnexion"> <span>oui</span></a>';

$contenu.= '';
$contenu.= '</div>';
//---------------------------------  AFFICHAGE  HTML  ---------------------------------//
?>
<?php require_once("assets/haut.inc.php");?>

<div id="main">
<article id="profil" class="panel">

<?php echo $contenu;?>

</article>
</div>

<?php require_once("assets/bas.inc.php");?>