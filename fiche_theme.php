<?php require_once("assets/init.inc.php"); 

//----------traitement php---------------------------//


//requete pour selectionner le produit à partir de leur id
if(isset($_GET['id_theme']))   { 
    $articles= executeRequete("SELECT  *  FROM  article  WHERE  theme  =  $_GET[id_theme]");
    // ici  WHERE  categorie  =  $_GET[id_cat] est ajouter pout faire le lien entre la valeur de l'int categorie de produit vers l'id_cat de la table cat
}


//requete article
$theme_des_articles = executeRequete("SELECT nom_theme FROM theme");
$id_theme = executeRequete("SELECT id_theme FROM theme");

//nav
$contenu .= '<h3 id="tth">Thèmes</h3>';
$contenu .= '<div class="subnav">';

while($theme = $theme_des_articles->fetch_assoc()) {
    $id_th = $id_theme->fetch_assoc();
            $contenu .= '<ul>';
            $contenu.= "<li>";
            $contenu .= '<a href="fiche_theme.php?id_theme=' .$id_th['id_theme'].'">'; 
            $contenu .= "<span>".$theme['nom_theme']."</span></li>";
            $contenu .= '</a>';
            $contenu .= '</ul>';          
}
$contenu .= '</div>';

//affichage de la varibale article contenant le resultat de la requete
$contenu .= '<section id="taf">';
while($art = $articles->fetch_assoc()) {
        $id_th = $id_theme->fetch_assoc();
        $theme=$theme_des_articles->fetch_assoc();
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

'.$contenu.'


</div>';
require_once("assets/bas.inc.php");?>