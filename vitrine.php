<?php require_once("assets/init.inc.php");

//--------------------------------- TRAITEMENTS PHP ---------------------------------// 

//--- AFFICHAGE DES CATEGORIES ---// 
$theme_des_articles = executeRequete("SELECT nom_theme FROM theme");
$id_theme = executeRequete("SELECT id_theme FROM theme");
$articles = executeRequete("SELECT * from article");


$contenu .= '<h3 id="tth">Thèmes</h3>';
$contenu .= '<div class="subnav">';

while($theme = $theme_des_articles->fetch_assoc()) {
    $id_th = $id_theme->fetch_assoc();
            $contenu .= '<ul>';
            $contenu.= "<li>";
            $contenu .= '<a href="#'.$id_th['id_theme'].'">'; 
            $contenu .= "<span>".$theme['nom_theme']."</span></li>";
            $contenu .= '</a>';
            $contenu .= '</ul>';          
}
$contenu .= '</div>';
$contenu .= '<section id="taf">';
while($art = $articles->fetch_assoc()) {
    //$theme_des_articles = executeRequete("SELECT nom_theme FROM theme");
    //$id_theme = executeRequete("SELECT id_theme FROM theme");
   // $id_th = $id_theme->fetch_assoc();
    //$theme=$theme_des_articles->fetch_assoc();
          //  $contenu .= '<section id="'.$id_th['id_theme'].'">';
           // $contenu .= "<h2>" .$theme['nom_theme']. "</h2>";
            $contenu .= '<article class="art">';
            $contenu .= '<img id ="art_img" src="'.$art['media'].'" height="250px" witdh="250px" />';
            $contenu .= '<div class="texte">';
            $contenu .= "<h2>".$art['titre']."</h2>";
            $contenu .= "<p>".$art['description']."</p>";
            $contenu .= '</div>';
            $contenu .= '</article>';
           // $contenu .= '</section>';
}
$contenu .= '</section>';

//--------------------------------- AFFICHAGE HTML ---------------------------------// 
require_once("assets/haut.inc.php");

echo'
<article id="boutique" class="panel">

'.$contenu.'


</article>
</div>';

require_once("assets/bas.inc.php"); 
?>