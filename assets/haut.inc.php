<!DOCTYPE HTML>
<html>
	<head>
		<title>PBereby</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
        <link rel="stylesheet" href="<?php echo RACINE_SITE; ?>assets/css/main2.css" />
		<noscript><link rel="stylesheet" href="assets/css/noscript.css" /></noscript>
	</head>
	<body>
		<!-- Wrapper -->
        <div id="wrapper">

<!-- Header -->
    <header id="header">
        <div class="inner">

            <!-- Logo -->
                <a href="index.html" class="logo">
                    <span class="symbol"><img src="<?php echo RACINE_SITE; ?>images/canard.svg" alt="" /></span><span class="title">Paul Bereby</span><br>
                    <span>Un monteur qui démonte !</span>
                </a>

            <!-- Nav -->
                <nav>
                    <ul>
                        <li><a href="#menu">Menu</a></li>
                    </ul>
                </nav>

        </div>
    </header>

    				<!-- Menu -->
		<nav id="menu">
			<h2>Menu</h2>
			<?php if(internauteEstConnecteEtEstAdmin()){
				echo'<ul>';
				echo'<li><a href="' . RACINE_SITE .'index.php"<span> Accueil</span></a></li>';
				echo'<li><a href="'.RACINE_SITE.'vitrine2.php"><span> Vitrine</span></a></li>';
				echo'<li><a href="'.RACINE_SITE.'profil.php"><span> Deconexion</span></a></li>';
				echo'<li><a href="'.RACINE_SITE.'mention.php"><span> Mentions</span></a></li>';
				echo'<li><a  href="'. RACINE_SITE .'admin/gestion_vitrine.php"><span> Gestion</span></a></li>';
				echo'</ul>';
			}else {
				echo'<ul>';
					echo'<li><a href="' . RACINE_SITE .'index.php" class="icon solid fa-home"><span> Accueil</span></a></li>';
                    echo'<li><a href="'.RACINE_SITE.'vitrine2.php" class="icon solid fa-beer"><span> Vitrine</span></a></li>';
                    echo'<li><a href="'.RACINE_SITE.'contact.php" class="icon solid fa-male"><span> contact</span></a></li>';
					echo'<li><a href="'.RACINE_SITE.'connexion.php" class="icon solid fa-female"><span> Connexion</span></a></li>';
					echo'<li><a href="'.RACINE_SITE.'mention.php" class="icon solid fa-user"><span> Mentions</span></a></li>';
				echo'</ul>';
			} 
			?>   
		</nav>
        <div id="main">
