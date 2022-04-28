<?php require_once("assets/init.inc.php");

//--------------------------------- TRAITEMENTS PHP ---------------------------------// 

//--- AFFICHAGE DES CATEGORIES ---// 
$theme_des_articles = executeRequete("SELECT nom_theme FROM theme");
$id_theme = executeRequete("SELECT id_theme FROM theme");
$articles = executeRequete("SELECT * from article");


$contenu .= '<section class="tiles2">';
while($theme = $theme_des_articles->fetch_assoc()) {
    $id_th = $id_theme->fetch_assoc();
            $contenu .= '<article class="style1"><span class="image"><img src="images/pic02.jpg" alt="" /></span>';
            $contenu .= '<a href="fiche_theme.php?id_theme=' .$id_th['id_theme'].'">'; 
            $contenu .= "<h1>".$theme['nom_theme']."</h1>";
            $contenu .= "</a>";
            $contenu .= "</article>";

}
$contenu .= "</section>";

//--------------------------------- AFFICHAGE HTML ---------------------------------// 
require_once("assets/haut.inc.php");

echo'<div id="main">
<article id="boutique" class="panel">

'.$contenu.'

</article>
</div>';

require_once("assets/bas.inc.php"); 
?>