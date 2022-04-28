<?php require_once("../assets/init.inc.php");
//--------------------------------- TRAITEMENTS PHP ---------------------------------//
//--- VERIFICATION ADMIN ---//
if (!internauteEstConnecteEtEstAdmin()) {
    header("location:../connexion.php");
    exit();
}
//--- SUPPRESSION article ---//
if (isset($_GET['action']) && $_GET['action'] == "suppression") {
    $contenu .= $_GET['id_article'];
    $resultat = executeRequete("SELECT * FROM article WHERE id_article=$_GET[id_article]");
    $article_a_supprimer = $resultat->fetch_assoc();
    $chemin_media_a_supprimer = $_SERVER['DOCUMENT_ROOT'] . $article_a_supprimer['media'];
    if (!empty($article_a_supprimer['media']) && file_exists($chemin_media_a_supprimer)) unlink($chemin_media_a_supprimer);
    executeRequete("DELETE FROM article WHERE id_article=$_GET[id_article]");
    $contenu .= '<div class="validation">Suppression de l\' article : ' . $_GET['id_article'] . '</div>';
    $_GET['action'] = 'affichage';
}
//--- ENREGISTREMENT article ---//
if (!empty($_POST)) {
    debug($_POST);
    $media_bdd = "";
    if (isset($_GET['action']) &&  $_GET['action'] == 'modification') {
        $media_bdd = $_POST['media_actuelle'];
    }
    if (isset($_GET['action']) && ($_GET['action'] == 'ajout' || $_GET['action'] == 'modification')) {
        if (!empty($_FILES['media']['name'])) {
            debug($_FILES);
            $nom_media = '_' . $_FILES['media']['name'];
            $media_bdd = RACINE_SITE . "images/$nom_media";
            $media_dossier = $_SERVER['DOCUMENT_ROOT'] . RACINE_SITE . "/images/$nom_media";
            copy($_FILES['media']['tmp_name'], $media_dossier);
        }
        foreach ($_POST as $indice => $valeur) {
            $_POST[$indice] = htmlEntities(addSlashes($valeur));
        }
        executeRequete("REPLACE INTO article (theme, titre, description, media) values ('$_POST[theme]', '$_POST[titre]', '$_POST[description]', '$media_bdd')");
        $contenu .= '<div class="validation">L\' article a été ajouté</div>';
        $_GET['action'] = 'affichage';
    }
}

//enregistrement cat
if (!empty($_POST)) {
    if (isset($_GET['action']) && $_GET['action'] == 'ajout_theme') {
        foreach ($_POST as $indice => $valeur) {
            $_POST[$indice] = htmlEntities(addSlashes($valeur));
        }
        executeRequete("INSERT INTO theme (nom_theme) values ('$_POST[nom_theme]')");
        $contenu .= '<div class="validation">Le theme a été ajouté</div>';
    }
}

//---LIENS articleS ---//
$contenu .= '<nav id="nav2"><ul> <li><a  href="?action=affichage">Affichage  des  articles</a></li> <li><a  href="?action=ajout">Ajout  d\'un  article</a><hr> </li><li><a  href="?action=ajout_theme">Ajout  d\'un theme</a><hr> </li></ul></nav>';

//--- AFFICHAGE articleS ---//
if (isset($_GET['action']) && $_GET['action'] == "affichage") {
    $resultat = executeRequete("SELECT * FROM article");

    $contenu .= '<div id="main"> <article id="gestion_boutique" class="show"> <h2> Affichage des articles </h2>';
    $contenu .= '<div class="aff"> Nombre de article(s) dans la vitrine : ' . $resultat->num_rows;
    $contenu .= '<table border="2"><tr>';

    while ($colonne = $resultat->fetch_field()) {
        $contenu .= '<th>' . $colonne->name . '</th>';
    }
    $contenu .= '<th>Modification</th>';
    $contenu .= '<th>Supression</th>';
    $contenu .= '</tr>';

    while ($ligne = $resultat->fetch_assoc()) {
        $contenu .= '<tr>';
        foreach ($ligne as $indice => $information) {
            if ($indice == "media") {
                $contenu .= '<td><img src=' . $information . ' width="70" height="70"></td>';
            } else {
                $contenu .= '<td>' . $information . '</td>';
            }
        }
        $contenu .= '<td><a href="?action=modification&id_article=' . $ligne['id_article'] . '"><img src="../images/edit_button.png" width="70" height="70"></a></td>';
        $contenu .= '<td><a href="?action=suppression&id_article=' . $ligne['id_article'] . '" OnClick="return(confirm(\'En êtes vous certain ?\'));"><img src="../images/supp.png" width="70" height="70"></a></td>';
        $contenu .= '</tr>';
    }
    $contenu .= '</table></div></article></div>';
}


//--------------------------------- AFFICHAGE HTML ---------------------------------//


require_once("../assets/haut.inc.php");
echo $contenu;
if (isset($_GET['action']) && ($_GET['action'] == 'ajout' || $_GET['action'] == 'modification')) {
    if (isset($_GET['id_article'])) {
        $resultat = executeRequete("SELECT * FROM article WHERE id_article=$_GET[id_article]");
        $article_actuel = $resultat->fetch_assoc();
    }
    echo '

<article id="gestion_boutique" class="form">
<h1> Formulaire articles </h1>
<form method="post" enctype="multipart/form-data" action="">
    <input type="hidden" id="id_article" name="id_article" value="';
    if (isset($article_actuel['id_article'])) echo $article_actuel['id_article'];
    echo '">    

    <label for="theme">theme</label><br>
    <select name="theme">
    <option value="1"';
    if (isset($article_actuel) && $article_actuel['theme'] == '1') echo ' selected ';
    echo '>nature</option>
    <option value="2"';
    if (isset($article_actuel) && $article_actuel['theme'] == '2') echo ' selected ';
    echo '>sf</option>
    <option value="3"';
    if (isset($article_actuel) && $article_actuel['theme'] == '3') echo ' selected ';
    echo '>marvel</option>
    <option value="4"';
    if (isset($article_actuel) && $article_actuel['theme'] == '4') echo ' selected ';
    echo '>autre</option>
    </select><br><br>';
    
    echo '<label for="titre">titre</label><br>
    <input type="text" id="titre" name="titre" placeholder="le titre du article" value="';
    if (isset($article_actuel['titre'])) echo $article_actuel['titre'];
    echo '"> <br><br>
    
    <label for="description">description</label><br>
    <textarea name="description" id="description" placeholder="la description du article">';
    if (isset($article_actuel['description'])) echo $article_actuel['description'];
    echo '</textarea><br><br>
   

  <label for="media">media</label><br>
    <input type="file" id="media" name="media"><br><br>';
    if (isset($article_actuel)) {
        echo '<i>Vous pouvez uplaoder un nouveau media si vous souhaitez le changer</i><br>';
        echo '<img src="' . $article_actuel['media'] . '" ="90" height="90"><br>';
        echo '<input type="hidden" name="media_actuelle" value="' . $article_actuel['media'] . '"><br>';
    }
    echo '<br><br>
    <input type="submit" value="';
    echo ucfirst($_GET['action']) . ' du article">
</form>
</article>
</div>';
}

//ajout categorie
if (isset($_GET['action']) && ($_GET['action'] == 'ajout_theme')) {
    if (isset($_GET['id_cat'])) {
        $result = executeRequete("SELECT * FROM theme WHERE id_theme=$_GET[id_theme]");
        $cat_actuel = $resultat->fetch_assoc();
    }
    echo '
<div id="main">
<article id="gestion_boutique" class="form">

<h1> Formulaire categories </h1>
<form method="post" enctype="multipart/form-data" action="">

<input type="hidden" id="id_theme" name="id_theme" value="';
    if (isset($cat_actuel['id_theme'])) echo $cat_actuel['id_theme'];
    echo '">

<label for="nom_cat">Theme</label><br>
<input type="text" id="nom_theme" name="nom_theme" placeholder="nom du theme" value="';
    if (isset($cat_actuel['nom_theme'])) echo $cat_actuel['nom_theme'];
    echo '" ><br><br>

<input type="submit" value="';
    echo ucfirst($_GET['action']) . '">

</form>
</article>
</div>';
}
?>
<?php require_once("../assets/bas.inc.php"); ?>