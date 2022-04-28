</div>
<div id="footer">
<?php if(internauteEstConnecteEtEstAdmin()){
				echo'<a href="' . RACINE_SITE .'index.php"><span> Accueil</span></a>';
				echo'<a href="'.RACINE_SITE.'vitrine2.php"><span> Boutique</span></a>';
				echo'<a href="'.RACINE_SITE.'profil.php"><span> Profil</span></a>';
				echo'<a href="'.RACINE_SITE.'mention.php"><span> Mentions</span></a>';
				echo'<a  href="'. RACINE_SITE .'admin/gestion_vitrine.php" ><span> Gestion</span></a>';
			}else {
				echo'';
					echo'<a href="' . RACINE_SITE .'index.php"><span> Accueil</span></a>';
                    echo'<a href="'.RACINE_SITE.'vitrine2.php"><span> Boutique</span></a>';
                    echo'<a href="'.RACINE_SITE.'contact.php"><span> Contact</span></a>';
					echo'<a href="'.RACINE_SITE.'connexion.php"><span> Connexion</span></a>';
					echo'<a href="'.RACINE_SITE.'mention.php"><span> Mentions</span></a>';
			} 
			?>   

    <article id="Copyright" class="panel">
        <ul class="copyright">
            <li><a href="">&copy; Paul Bereby</a> </li>
            <li><?php echo date("Y"); ?> <a href="#Copyright" class="icon solid fa-copyright" target="_blank"><span> Copyright</span></a></li>
        </ul>
    </article>
</div>
<script src="<?php echo RACINE_SITE; ?>assets/js/jquery.min.js"></script>
<script src="<?php echo RACINE_SITE; ?>assets/js/main.js"></script>

</body>
</html>