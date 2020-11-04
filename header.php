<?php
$path = preg_replace('/wp-content(?!.*wp-content).*/','',__DIR__);
include($path.'wp-load.php');

if(get_current_user_id() !== 0 && !isset($_SESSION['userConnected'])){
	$_SESSION['userConnected'] = get_current_user_id();
}

if(!isset($_SESSION['needLog'])){
	$_SESSION['needLog'] = true;
}
if(!isset($_SESSION['needAdmin'])){
	$_SESSION['needAdmin'] = false;
}
if(!checkAuthorized($_SESSION['needAdmin'], $_SESSION['needLog'])){
	unset($_SESSION['needAdmin']);
	unset($_SESSION['needLog']);
    wp_redirect( home_url() );  exit;
}

?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo('charset'); ?>">
		<meta test="<?php echo $needAdmin; ?>">
		<title><?php wp_title(''); ?><?php if(wp_title('', false)) { echo ' :'; } ?> <?php bloginfo('name'); ?></title>

		<link href="//www.google-analytics.com" rel="dns-prefetch">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/portail.min.css">
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/img/logo/LogoCyberDéfense.png" alt="logo portail SODA cyber Défense">

		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="<?php bloginfo('description'); ?>">

		<?php wp_head(); ?>
		<script>
        // conditionizr.com
        // configure environment tests
        conditionizr.config({
            assets: '<?php echo get_template_directory_uri(); ?>',
            tests: {}
        });
		</script>
		<!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script> -->
		<!-- <script src="https://unpkg.com/isotope-layout@3/dist/isotope.pkgd.js"></script> -->
	</head>
	<body>


		 <nav class="above">
			<div class="logo">
				<a href="<?php echo home_url(); ?>">
					<img src="<?php echo get_template_directory_uri(); ?>/img/logo/LogoCyberDéfense.png" alt="logo portail SODA cyber Défense">
				</a>
			</div>
			<div class="search">
				<i class="arrow fas fa-arrow-right"></i>
				<div class="icons">
					 <div class="searchContainer">
						<i class="fas fa-search"></i>
						<input class="searchBar"></input>
					</div> 
					 <i class="far fa-bell">
						<div class="notif">
							<div class="notifs"></div>
						</div>
						<span class="nbr_notifs"></span>
					</i>
				</div>
				<div class="profile_pic">
					<div class="circle">
						<div class="dropMenuProfile">
							<a href="<?php echo home_url()."/profil" ?>">Votre profil</a>
							<a href="<?php echo get_template_directory_uri(); ?>/app/deconnect.php">Déconnexion</a>
						</div>
						<?php if(get_user_meta(get_current_user_id() , 'avatar', true)){?>
							<img src="<?php echo get_template_directory_uri()."/img/avatar/".get_user_meta(get_current_user_id() , 'avatar', true) ?>" alt="votre photo de profil">
						<?php } else{ ?>
							<img src="<?php echo get_template_directory_uri(); ?>/img/avatar/default.jpg" alt="logo portail SODA cyber Défense">
						<?php } ?>
					</div>
				</div>
				<div class="settings"></div>
			</div>
		</nav>
		<nav class="side">
			<div id="link" class="home">
				<a id="a" href="<?php echo home_url()."/accueil" ?>"><i class="fas fa-home"></i><p id="p">Accueil</p></a>
			</div>
			<?php if( current_user_can('editor') || current_user_can('administrator') ) {  ?>
				<div id="link" class="bgQuiz">
					<a id="a" href="<?php echo home_url()."/bagelquiz" ?>"><img src="<?php echo get_template_directory_uri(); ?>/img/logo/bagelquizzlogo.png" class="bagelQuizImg"></img><p id="p">Bagel Quiz</p></a>
					<i class="drop fas fa-caret-right" data-id="bgQuiz"></i>
					<ul class=" menuDown dropMenu" id="bgQuiz">
						<li>
							<a href="<?php echo home_url()."/inscription-tournoi"?>">S'inscrire à un tournoi</a>
						</li>	
						<li>
							<a href="<?php echo home_url()."/creationbagelquiz"?>">Création Bagel Quiz</a>
						</li>
						<li>
							<a href="<?php echo home_url()."/creation-de-tournoi"?>">Création de tournoi</a>
						</li>
						<li>
							<a href="<?php echo home_url()."/liste-des-bagel-quiz"?>">Liste des bagel quiz</a>
						</li>
						<li>
							<a href="<?php echo home_url()."/liste-des-tournois"?>">Liste des tournois</a>
						</li>
						<li>
							<a href="<?php echo home_url()."/classement des bagel quiz"?>">Classements</a>
						</li>
					</ul>
			<?php } else { ?>
				<div id="link" class="bgQuiz left">
					<a id="a" href="<?php echo home_url()."/articles" ?>"><i class="far fa-newspaper"></i><p id="p">Articles</p></a>
					<i class="drop fas fa-caret-right" data-id="bgQuiz"></i>
					<ul class=" menuDown dropMenu" id="bgQuiz">
						<li>
							<a href="<?php echo home_url()."/inscription-tournoi"?>">S'inscrire à un tournoi</a>
						</li>	
					</ul>
			<?php } ?>
				</div>
			<?php if( current_user_can('editor') || current_user_can('administrator') ) {  ?>
				<div id="link" class="articles">
					<a id="a" href="<?php echo home_url()."/articles" ?>"><i class="far fa-newspaper"></i><p id="p">Articles</p></a>
					<i class="drop fas fa-caret-right" data-id="articles"></i>
					<ul class=" menuDown dropMenu" id="articles">
						<li>
							<a target="_blank" href="<?php echo home_url()."/ajouter-un-nouvel-article"?>">Ajoutez un article</a>
						</li>
						<li>
							<a target="_blank" href="<?php echo home_url()."/liste-articles"?>">Liste des articles</a>
						</li> 
					</ul>
				<?php } else { ?>
					<div id="link" class="articles left">
						<a id="a" href="<?php echo home_url()."/articles" ?>"><i class="far fa-newspaper"></i><p id="p">Articles</p></a>
				<?php } ?>
			</div>
			<?php if( current_user_can('editor') || current_user_can('administrator') ) {  ?>
				<div id="link" class="modules">
					<a id="a" href="<?php echo home_url()."/menu-module" ?>"><i class="fas fa-graduation-cap"></i><p id="p">Modules</p></a>
					<i class="drop fas fa-caret-right" data-id="modules"></i>
					<ul class=" menuDown dropMenu" id="modules">
						<li>
							<a href="<?php echo home_url()."/creationmoduleetape1"?>">Créez votre module</a>
						</li>
						<li>
							<a href="<?php echo home_url()."/liste-modules"?>">Liste des modules</a>
						</li>
					</ul>
			<?php } else { ?>
				<div id="link" class="modules left">
					<a id="a" href="<?php echo home_url()."/menu-module" ?>"><i class="fas fa-graduation-cap"></i><p id="p">Modules</p></a>
			<?php }?>
			</div>
			<div id="link"  class="tools">
				<a id="a" href="<?php echo home_url()."/generateur-de-mots-de-passe"?>"><i class="fas fa-tools"></i><p id="p">Outils</p></a>
				<i class="drop fas fa-caret-right" data-id="tools"></i>
				<ul class=" menuDown dropMenu" id="tools">
						<li>
							<a href="<?php echo home_url()."/generateur-de-mots-de-passe"?>">Générateur de mot de passe solide</a>
						</li>
					</ul>
			</div>
			<?php if( current_user_can('editor') || current_user_can('administrator') ) {  ?>
				<div id="link"  class="quiz">
					<a id="a" href="<?php echo home_url()."/menu-quiz" ?>"><i class="fas fa-question-circle"></i><p id="p">Quiz</p></a>
					<i class="drop fas fa-caret-right" data-id="quizs"></i>
						<ul class=" menuDown dropMenu" id="quizs">
							<li>
								<a href="<?php echo home_url()."/creationquizetape1"?>">Créez votre quiz</a>
							</li>
							<li>
								<a href="<?php echo home_url()."/liste-quizs"?>">Liste des quiz</a>
							</li>
						</ul>
				<?php }  else {?>
					<div id="link"  class="quiz left">
						<a id="a" href="<?php echo home_url()."/menu-quiz" ?>"><i class="fas fa-question-circle"></i><p id="p">Quiz</p></a>
				<?php } ?>
			</div>
			<?php if( current_user_can('editor') || current_user_can('administrator') ) {  
			//Récupération du nombre d'utilisateurs en attente
				global $wpdb;

				$users = $wpdb->get_var("SELECT count(wp_users.ID) AS ID FROM wp_users LEFT JOIN wp_usermeta ON wp_usermeta.user_id = wp_users.ID WHERE wp_usermeta.meta_key = 'status' AND wp_usermeta.meta_value =  0");
						
			?>
				<div id="link" class="campaigns">
					<a id="a" href="<?php echo home_url()."/nouvelle-campagne" ?>"><i class="fas fa-shield-alt"></i><p id="p">Campagnes</p></a>
					<i class="drop fas fa-caret-right" data-id="campaigns"></i>
					<ul class=" menuDown dropMenu" id="campaigns">
						<li>
							<a href="<?php echo home_url()."/stats-campagnes" ?>">Stats des campagnes</a>
						</li>
					</ul>
				</div>
				<div id="link" class="admin">
					<a id="a" href="<?php echo home_url()."/wp-admin" ?>" target="_blank"><i class="fab fa-wordpress <?php echo $users != 0 ? "notifUser" : ""; ?>"></i><p id="p">Administration</p></a>
					<i class="drop fas fa-caret-right" data-id="admin"></i>
					<ul class=" menuDown dropMenu" id="admin">
						<li>
							<a href="<?php echo home_url()."/activation-utilisateurs" ?>" class="<?php echo $users != 0 ? "notifUser" : ""; ?>">Nouveaux Utilisateurs</a>
						</li>
						<li>
							<a href="<?php echo home_url()."/classements" ?>">Classement</a>
						</li>
						<li>
							<a href="<?php echo home_url()."/statistiques" ?>">Statistiques</a>
						</li>
						<li>
							<a href="<?php echo home_url()."/ajouter-tag" ?>">Gestion des tags</a>
						</li>
						<li>
							<a href="<?php echo home_url()."/wp-admin" ?>" target="_blank">Admin</a>
						</li>
					</ul>
				</div>
			<?php } ?> 
			 <!-- <i class="fas fa-question"></i>  -->
		 </nav>  

		 <div class="loader">
			<div class="bubble">
				<p>Soda<span>CyberDéfense</span></p>
        <div class="wave1"></div>
        <div class="wave2"></div>
      </div>
		</div> 
		<section class="content big">
