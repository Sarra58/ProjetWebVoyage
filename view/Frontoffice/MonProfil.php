<?php
session_start();
require_once '../../Controller/userController.php'; // Assure-toi du chemin
require_once '../../Model/user.php'; // Pour utiliser la classe User

if (!isset($_SESSION['nom'])) {
    header("Location: Seconnecter.php");
    exit();
}

$userController = new UserController();
$email = "";

if (isset($_GET['email'])) {
    $email = $_GET['email'];
}

$user = $userController->getUserByEmail($email);

// ----- AJOUT : Modification dans la même page -----
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $emailPost = $_POST['email'];
	$role = $_POST['role'];
	$tel = $_POST['tel'];
    $oldEmail = $_POST['oldemail'];

    $erreurs = [];

    // Vérification email
    if (!filter_var($emailPost, FILTER_VALIDATE_EMAIL)) {
        $erreurs[] = "L'e-mail n'est pas valide.";
    }

    // Vérification téléphone (8 chiffres)
    if (!preg_match('/^[0-9]{8}$/', $tel)) {
        $erreurs[] = "Le numéro de téléphone doit contenir exactement 8 chiffres.";
    }

    if (!empty($erreurs)) {
		$user = $userController->getUserByEmail($oldEmail);
		$email = $user['email'];
    } else {
        $updatedUser1 = new User(
            0,
            $nom,
            $prenom,
            $emailPost,
            $role,
            "", 
            $tel
        );

        // Mise à jour dans la base de données
        $userController->updateUser1($updatedUser1, $oldEmail);

        // Message de confirmation
       

        // Recharger les infos mises à jour
        $user = $userController->getUserByEmail($updatedUser1->getEmail());
        $email = $user['email'];
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
<title>MonProfil</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Projet Travelix">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="styles/contact_styles.css">
<link rel="stylesheet" type="text/css" href="styles/contact_responsive.css">
</head>

<body>

<div class="super_container">

	<!-- Header -->

	<header class="header">

		<!-- Top Bar -->

		<div class="top_bar">
			<div class="container">
				<div class="row">
					<div class="col d-flex flex-row">
						<div class="phone">94497431</div>
						<div class="social">
							<ul class="social_list">
								<li class="social_list_item"><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
								<li class="social_list_item"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
								<li class="social_list_item"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
								<li class="social_list_item"><a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>
								<li class="social_list_item"><a href="#"><i class="fa fa-behance" aria-hidden="true"></i></a></li>
								<li class="social_list_item"><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
							</ul>
						</div>
						<div class="user_box ml-auto">
						<div class="user_box_login user_box_link"><a href="déconnexion.php">🔒 Déconnexion</a></div>
						</div>

					</div>
				</div>
			</div>
		</div>

		<!-- Main Navigation -->

		<nav class="main_nav">
			<div class="container">
				<div class="row">
					<div class="col main_nav_col d-flex flex-row align-items-center justify-content-start">
						<div class="logo_container">
							<div class="logo"><a href="#"><img src="images/logotripster.png" alt="Logo Tripster" height="200px" width="200px"></a></div>
						</div>
						<div class="main_nav_container ml-auto">
							<ul class="main_nav_list">
								<li class="main_nav_item"><a href="<?php echo 'index4.php?email=' . $email; ?>">accueil</a></li>
								<li class="main_nav_item"><a href="<?php echo 'about.php.php?email=' . $email; ?>">à propos</a></li>
								<li class="main_nav_item"><a href="<?php echo 'offers.php?email=' . $email; ?>">offres</a></li>
								<li class="main_nav_item"><a href="<?php echo 'blog.php?email=' . $email; ?>">actualités</a></li>
								<li class="main_nav_item"><a href="">MonProfil</a></li>
							</ul>
						</div>
						<div class="content_search ml-lg-0 ml-auto">
							<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
							width="17px" height="17px" viewBox="0 0 512 512" enable-background="new 0 0 512 512" xml:space="preserve">
								<g>
									<g>
										<g>
											<path class="mag_glass" fill="#FFFFFF" d="M78.438,216.78c0,57.906,22.55,112.343,63.493,153.287c40.945,40.944,95.383,63.494,153.287,63.494
											s112.344-22.55,153.287-63.494C489.451,329.123,512,274.686,512,216.78c0-57.904-22.549-112.342-63.494-153.286
											C407.563,22.549,353.124,0,295.219,0c-57.904,0-112.342,22.549-153.287,63.494C100.988,104.438,78.439,158.876,78.438,216.78z
											M119.804,216.78c0-96.725,78.69-175.416,175.415-175.416s175.418,78.691,175.418,175.416
											c0,96.725-78.691,175.416-175.416,175.416C198.495,392.195,119.804,313.505,119.804,216.78z"/>
										</g>
									</g>
									<g>
										<g>
											<path class="mag_glass" fill="#FFFFFF" d="M6.057,505.942c4.038,4.039,9.332,6.058,14.625,6.058s10.587-2.019,14.625-6.058L171.268,369.98
											c8.076-8.076,8.076-21.172,0-29.248c-8.076-8.078-21.172-8.078-29.249,0L6.057,476.693
											C-2.019,484.77-2.019,497.865,6.057,505.942z"/>
										</g>
									</g>
								</g>
							</svg>
						</div>

						<form id="search_form" class="search_form bez_1">
							<input type="search" class="search_content_input bez_1">
						</form>

						<div class="hamburger">
							<i class="fa fa-bars trans_200"></i>
						</div>
					</div>
				</div>
			</div>
		</nav>

	</header>

	<div class="menu trans_500">
		<div class="menu_content d-flex flex-column align-items-center justify-content-center text-center">
			<div class="menu_close_container"><div class="menu_close"></div></div>
			<div class="logo"><a href="#"><img src="images/logotripster.png" alt="Logo Tripster" height="125px" width="125px"></a></div>
			<ul>
				<li class="menu_item"><a href="index.html">accueil</a></li>
				<li class="menu_item"><a href="about.html">à propos</a></li>
				<li class="menu_item"><a href="offers.html">offres</a></li>
				<li class="menu_item"><a href="blog.html">actualités</a></li>
				<li class="menu_item"><a href="#">MonProfil</a></li>
			</ul>
		</div>
	</div>

	<!-- Home -->

	<div class="home">
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/contact_background.jpg"></div>
		<div class="home_content">
			<div class="home_title">MonProfil</div>
		</div>
	</div>

	<!-- Contact -->
	
	<div class="contact_form_section">
		<div class="container">
			<div class="row">
				<div class="col">
	
					<!-- Contact Form -->
					<div class="contact_form_container" style="padding-top: 30px;">
						
						<!-- Titre Mon profil -->
						<div class="contact_title text-center" style="margin-bottom: 30px;">
							<h2 style="font-size: 32px; font-weight: bold; color: white;">Mon profil</h2>
						</div>
						<form action="MonProfil.php" method="post">
							<input type="hidden" value="<?php echo $email; ?>" name="oldemail" id="oldemail">
							<input type="text" id="nom" class="contact_form_name input_field" value="<?php echo $user['nom']; ?>" required="required" data-error="Le nom est requis." name="nom">
							<input type="text" id="prenom" class="contact_form_name input_field" value="<?php echo $user['prenom']; ?>" required="required" data-error="Le prénom est requis." name="prenom">
							<input type="text" id="email" class="contact_form_email input_field" value="<?php echo $user['email']; ?>" required="required" data-error="L'e-mail est requis." name="email">
<input type="text" id="role" class="contact_form_subject input_field" value="<?php echo $user['role']; ?>" readonly name="role">
							<input type="text" id="tel" class="contact_form_subject input_field" value="<?php echo $user['Tel']; ?>" required="required" data-error="Le tel est requis." name="tel">
							<div class="form_buttons" style="display: flex; justify-content: center; gap: 20px; margin-top: 20px;margin-bottom: 70px;">
								<button type="submit" class="form_submit_button button trans_200" onclick="modifierCompte()">Modifier ton compte</button></div>
							
						</form>
					
						<?php if (!empty($erreurs)) {
       					 foreach ($erreurs as $erreur) {
							echo "<div class=\"text-center\" style=\"margin-top: 0px;margin-bottom: 0px;\"><p style='color:red;'>❌ $erreur</p></div>";
        				}}
					?>	
					</div>
					
				</div>
			</div>
		</div>
	</div>
	
	<!-- About -->
	<div class="about">
		<div class="container">
			<div class="row">
				<div class="col-lg-5">

					<!-- About - Image -->

					<div class="about_image">
						<img src="images/man.png" alt="Illustration homme avec globe">
					</div>

				</div>

				<div class="col-lg-4">

					<!-- About - Content -->

					<div class="about_content">
						<div class="logo_container about_logo">
							<div class="logo"><a href="#"><img src="images/logotripster.png" alt="Logo Tripster" height="125px" width="125px"></a></div>
						</div>
						<p class="about_text">Tripster est votre partenaire de confiance pour des voyages inoubliables. Notre équipe passionnée s'engage à créer des expériences uniques, alliant confort, authenticité et découverte. Nous sélectionnons avec soin nos destinations et partenaires pour vous offrir le meilleur du voyage.</p>
						<ul class="about_social_list">
							<li class="about_social_item"><a href="#"><i class="fa fa-pinterest"></i></a></li>
							<li class="about_social_item"><a href="#"><i class="fa fa-facebook-f"></i></a></li>
							<li class="about_social_item"><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li class="about_social_item"><a href="#"><i class="fa fa-dribbble"></i></a></li>
							<li class="about_social_item"><a href="#"><i class="fa fa-behance"></i></a></li>
						</ul>
					</div>

				</div>

				<div class="col-lg-3">

					<!-- About Info -->

					<div class="about_info">
						<ul class="contact_info_list">
							<li class="contact_info_item d-flex flex-row">
								<div><div class="contact_info_icon"><img src="images/placeholder.svg" alt="Icône localisation"></div></div>
								<div class="contact_info_text">4127 Raoul Wallenber 45b-c Gibraltar</div>
							</li>
							<li class="contact_info_item d-flex flex-row">
								<div><div class="contact_info_icon"><img src="images/phone-call.svg" alt="Icône téléphone"></div></div>
								<div class="contact_info_text">2556-808-8613</div>
							</li>
							<li class="contact_info_item d-flex flex-row">
								<div><div class="contact_info_icon"><img src="images/message.svg" alt="Icône message"></div></div>
								<div class="contact_info_text"><a href="mailto:contactme@gmail.com?Subject=Bonjour" target="_top">contactme@gmail.com</a></div>
							</li>
							<li class="contact_info_item d-flex flex-row">
								<div><div class="contact_info_icon"><img src="images/planet-earth.svg" alt="Icône site web"></div></div>
								<div class="contact_info_text"><a href="https://colorlib.com">www.colorlib.com</a></div>
							</li>
						</ul>
					</div>

				</div>

			</div>
		</div>
	</div>



	<!-- Footer -->

	<footer class="footer">
		<div class="container">
			<div class="row">

				<!-- Footer Column -->
				<div class="col-lg-3 footer_column">
					<div class="footer_col">
						<div class="footer_content footer_about">
							<div class="logo_container footer_logo">

								<div class="logo"><a href="#"><img src="images/logotripster.png" alt="Logo Tripster" height="125px" width="125px"></a></div>
							</div>
							<p class="footer_about_text">Tripster est votre partenaire de confiance pour des voyages inoubliables. Notre équipe passionnée s'engage à créer des expériences uniques, alliant confort, authenticité et découverte. Nous sélectionnons avec soin nos destinations et partenaires pour vous offrir le meilleur du voyage.</p>
							<ul class="footer_social_list">
								<li class="footer_social_item"><a href="#"><i class="fa fa-pinterest"></i></a></li>
								<li class="footer_social_item"><a href="#"><i class="fa fa-facebook-f"></i></a></li>
								<li class="footer_social_item"><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li class="footer_social_item"><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li class="footer_social_item"><a href="#"><i class="fa fa-behance"></i></a></li>
							</ul>
						</div>
					</div>
				</div>

				<!-- Footer Column -->
				<div class="col-lg-3 footer_column">
					<div class="footer_col">
						<div class="footer_title">articles de blog</div>
						<div class="footer_content footer_blog">

							<!-- Footer blog item -->
							<div class="footer_blog_item clearfix">
								<div class="footer_blog_image"><img src="images/footer_blog_1.jpg" alt="Image blog 1"></div>
								<div class="footer_blog_content">
									<div class="footer_blog_title"><a href="blog.html">Voyagez avec nous cette année</a></div>
									<div class="footer_blog_date">29 Nov, 2017</div>
								</div>
							</div>

							<!-- Footer blog item -->
							<div class="footer_blog_item clearfix">
								<div class="footer_blog_image"><img src="images/footer_blog_2.jpg" alt="Image blog 2"></div>
								<div class="footer_blog_content">
									<div class="footer_blog_title"><a href="blog.html">Nouvelles destinations pour vous</a></div>
									<div class="footer_blog_date">29 Nov, 2017</div>
								</div>
							</div>

							<!-- Footer blog item -->
							<div class="footer_blog_item clearfix">
								<div class="footer_blog_image"><img src="images/footer_blog_3.jpg" alt="Image blog 3"></div>
								<div class="footer_blog_content">
									<div class="footer_blog_title"><a href="blog.html">Voyagez avec nous cette année</a></div>
									<div class="footer_blog_date">29 Nov, 2017</div>
								</div>
							</div>

						</div>
					</div>
				</div>

				<!-- Footer Column -->
				<div class="col-lg-3 footer_column">
					<div class="footer_col">
						<div class="footer_title">mots-clés</div>
						<div class="footer_content footer_tags">
							<ul class="tags_list clearfix">
                                <li class="tag_item"><a href="#">design</a></li>
                                <li class="tag_item"><a href="#">mode</a></li>
                                <li class="tag_item"><a href="#">musique</a></li>
                                <li class="tag_item"><a href="#">vidéo</a></li>
                                <li class="tag_item"><a href="#">fête</a></li>
                                <li class="tag_item"><a href="#">photographie</a></li>
                                <li class="tag_item"><a href="#">aventure</a></li>
                                <li class="tag_item"><a href="#">voyage</a></li>
							</ul>
						</div>
					</div>
				</div>

				<!-- Footer Column -->
				<div class="col-lg-3 footer_column">
					<div class="footer_col">
						<div class="footer_title">coordonnées</div>
						<div class="footer_content footer_contact">
							<ul class="contact_info_list">
								<li class="contact_info_item d-flex flex-row">
									<div><div class="contact_info_icon"><img src="images/placeholder.svg" alt="Icône localisation"></div></div>
									<div class="contact_info_text">4127 Raoul Wallenber 45b-c Gibraltar</div>
								</li>
								<li class="contact_info_item d-flex flex-row">
									<div><div class="contact_info_icon"><img src="images/phone-call.svg" alt="Icône téléphone"></div></div>
									<div class="contact_info_text">2556-808-8613</div>
								</li>
								<li class="contact_info_item d-flex flex-row">
									<div><div class="contact_info_icon"><img src="images/message.svg" alt="Icône message"></div></div>
									<div class="contact_info_text"><a href="mailto:contactme@gmail.com?Subject=Bonjour" target="_top">contactme@gmail.com</a></div>
								</li>
								<li class="contact_info_item d-flex flex-row">
									<div><div class="contact_info_icon"><img src="images/planet-earth.svg" alt="Icône site web"></div></div>
									<div class="contact_info_text"><a href="https://colorlib.com">www.colorlib.com</a></div>
								</li>
							</ul>
						</div>
					</div>
				</div>

			</div>
		</div>
	</footer>

	<!-- Copyright -->

	<div class="copyright">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 order-lg-1 order-2  ">
					<div class="copyright_content d-flex flex-row align-items-center">
						<div><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright ©<script>document.write(new Date().getFullYear());</script> Tous droits réservés | Ce modèle est réalisé avec <i class="fa fa-heart-o" aria-hidden="true"></i> par <a href="https://colorlib.com" target="_blank">Colorlib</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></div>
					</div>
				</div>
				<div class="col-lg-9 order-lg-2 order-1">
					<div class="footer_nav_container d-flex flex-row align-items-center justify-content-lg-end">
						<div class="footer_nav">
							<ul class="footer_nav_list">
								<li class="footer_nav_item"><a href="index.html">accueil</a></li>
								<li class="footer_nav_item"><a href="about.html">à propos</a></li>
								<li class="footer_nav_item"><a href="offers.html">offres</a></li>
								<li class="footer_nav_item"><a href="blog.html">actualités</a></li>
								<li class="footer_nav_item"><a href="#">contact</a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

<script src="js/jquery-3.2.1.min.js"></script>
<script src="styles/bootstrap4/popper.js"></script>
<script src="styles/bootstrap4/bootstrap.min.js"></script>
<script src="plugins/parallax-js-master/parallax.min.js"></script>



</body>

</html>