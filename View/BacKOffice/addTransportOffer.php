<?php
ob_start(); // ⚠️ Démarre la mise en tampon de sortie pour éviter les erreurs de header

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include(__DIR__ . '/../../controller/TransportOfferController.php');

$error = "";
$success = "";
$transport = null;
$transportController = new TransportController();

if (
    isset($_POST['nom_bapteme'], $_POST['nbre_de_place'], $_POST['couleur'], $_POST['marque'], $_POST['kilometrage']) &&
    !empty($_POST['nom_bapteme']) && !empty($_POST['nbre_de_place']) && !empty($_POST['couleur']) &&
    !empty($_POST['marque']) && !empty($_POST['kilometrage'])
) {
    // Créer l'objet Transport et l'ajouter à la base de données
    $transport = new Transport(
        null,
        $_POST['nom_bapteme'],
        $_POST['nbre_de_place'],
        $_POST['couleur'],
        $_POST['marque'],
        $_POST['kilometrage']
    );

    // Appel à la méthode d'ajout
    $result = $transportController->addTransport($transport);
    session_start();

if ($result && is_numeric($result)) {
    $_SESSION['transport_id'] = $result; // Tu auras besoin de l'ID pour lier le monument
    $_SESSION['transport_data'] = [
        'nom_bapteme' => $_POST['nom_bapteme'],
        'nbre_de_place' => $_POST['nbre_de_place'],
        'couleur' => $_POST['couleur'],
        'marque' => $_POST['marque'],
        'kilometrage' => $_POST['kilometrage']
    ];

   
}
}
?>

<?php if (!empty($result) && is_numeric($result)): ?>
    <style>
        .car-animation {
            position: relative;
            width: 100%;
            height: 100px;
            overflow: visible;
            margin-top: 20px;
        }

        .car {
            position: absolute;
            left: -200px;
            animation: drive 20s ease-in-out forwards;
            display: flex;
            align-items: center;
            font-weight: bold;
            font-size: 18px;
            color:rgb(248, 245, 249);
            background: linear-gradient(to right, rgb(98, 9, 165), black);

            border: 2px solid purple;
            padding: 10px 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 255, 0, 0.2);
        }

        @keyframes drive {
            from { left: -200px; }
            to { left: 100%; }
        }

        .car-icon {
            font-size: 24px;
            margin-right: 10px;
        }
    </style>

<div class="car-animation" style="margin-top: 50px;">
    <div class="car">
        <div class="car-icon">🚗💨</div>
        Transport ajouté avec succès ! ID = <?= htmlspecialchars($result) ?>
    </div>
</div>

<?php elseif (!empty($error)): ?>
    <div style="
        background-color: #ffe6e6;
        border: 2px solid #dc3545;
        color: #721c24;
        font-weight: bold;
        padding: 15px;
        margin-top: 20px;
        border-radius: 5px;
    ">
        <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ajouter Transport</title>

    <!-- Required meta tags -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
<link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" type="text/css" href="styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="styles/responsive.css">
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        body {
            background: linear-gradient(45deg, violet, black); /* Gradient violet et noir */
            font-family: 'Roboto', sans-serif; /* Police Roboto */
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            overflow: hidden;
            animation: backgroundAnimation 12s ease-in-out infinite; /* Animation pour fond dynamique */
            overflow-y: auto; 
        }

        @keyframes backgroundAnimation {
            0% {
                background: linear-gradient(45deg, violet, black);
            }
            50% {
                background: linear-gradient(45deg, black, violet);
            }
            100% {
                background: linear-gradient(45deg, violet, black);
            }
        }

        h1 {
            font-family: 'Lobster', cursive; /* Application de la police Lobster pour le titre */
            font-size: 40px;
            font-weight: bold;
            color: white;
            margin-bottom: 30px;
            text-align: center;
            opacity: 0;
            transition: opacity 1s ease-in-out;
            animation: fadeIn 2s ease-in-out forwards;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        form {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
            width: 400px;
            opacity: 0;
            transition: opacity 1s ease-in-out;
            animation: formFadeIn 2s ease-in-out forwards;
        }

        @keyframes formFadeIn {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        label {
            font-size: 16px;
            font-weight: 700;
            color: violet;
            text-align: left;
            display: block;
            margin-bottom: 8px;
            font-family: 'Roboto', sans-serif;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 8px;
            border: 2px solid #ccc;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        input:focus,
        select:focus {
            outline: none;
            border-color: violet;
            box-shadow: 0 0 10px rgba(138, 43, 226, 0.7); /* Focus glow */
        }

        button {
            background: linear-gradient(45deg, black, violet);
            color: white;
            border: none;
            padding: 15px;
            border-radius: 25px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-weight: bold;
        }
        

        button:hover {
            background: linear-gradient(45deg, violet, black);
            transform: scale(1.05);
        }

        button:active {
            transform: scale(0.98);
        }

        .tagline {
            font-size: 18px;
            font-style: italic;
            color: white;
            text-align: center;
            margin-bottom: 20px;
            animation: taglineAnimation 4s ease-in-out infinite;
        }

        @keyframes taglineAnimation {
            0% {
                transform: translateX(-20px);
                opacity: 0;
            }
            50% {
                opacity: 1;
                transform: translateX(10px);
            }
            100% {
                transform: translateX(-20px);
                opacity: 0;
            }
        }

        /* Style pour l'upload de photo de voiture */
        .upload-container {
            margin-bottom: 20px;
            text-align: center;
        }

        .upload-container input[type="file"] {
            padding: 10px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 8px;
            cursor: pointer;
        }

        .upload-container input[type="file"]:hover {
            background-color: #e0e0e0;
        }

        .car-image-preview {
            margin-top: 10px;
            width: 100%;
            max-width: 300px;
            height: auto;
            border-radius: 8px;
            border: 2px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        /* Images de voitures animées */
        .car-left,
        .car-right {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            width: 200px;
            transition: all 1s ease-in-out;
        }

        .car-left {
            left: -250px;
            animation: moveCarLeft 6s ease-in-out infinite;
        }

        .car-right {
            right: -250px;
            animation: moveCarRight 6s ease-in-out infinite;
        }

        @keyframes moveCarLeft {
            0% {
                left: -250px;
            }
            50% {
                left: 50px;
            }
            100% {
                left: -250px;
            }
        }

        @keyframes moveCarRight {
            0% {
                right: -250px;
            }
            50% {
                right: 320px;
            }
            100% {
                right: -250px;
            }
        }

    </style>
    <style>
        .top_bar {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            background-color: #350a4e;
            z-index: 10;
        }
    </style>
</head>

<body>
    
<div class="car-left">
        <img src="Asset 2.png" alt="Car Left">
    </div>

    <div class="car-right">
        <img src="1.png" alt="Car Right">
    </div>
    <div class="top_bar">
			<div class="container">
				<div class="row">
					<div class="col d-flex flex-row">
						<div class="phone">+45 345 3324 56789</div>
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
							<div class="user_box_login user_box_link"><a href="#">connexion</a></div>
							<div class="user_box_register user_box_link"><a href="#">s'inscrire</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
    <!-- Motivational Title -->
    <h1 id="motivationalTitle" style="margin-top: 50px;">
  Chaque destination mérite un moyen de transport à la hauteur de ses rêves!
</h1>

    <!-- Form -->
    <?php
echo '<form method="POST" action="">';

echo '<label for="nom_bapteme" style="font-family: \'Georgia\', serif; font-size: 18px; color: purple;">Nom du baptême:</label>';
echo '<select id="nom_bapteme" name="nom_bapteme" required>';
$nom_baptemes = [
    "Le Grand Voyageur",
    "Taureau d’Asphalte",
    "Vent Nomade",
    "Voyage Indigo",
    "Orion Prestige",
    "Monte-Carlo",
    "Galaxie Privée"
];
foreach ($nom_baptemes as $nom) {
    echo "<option value=\"$nom\">$nom</option>";
}
echo '</select><br>';

echo '<label for="nbre_de_place" style="font-family: \'Georgia\', serif; font-size: 18px; color: purple;">Nombre de places:</label>';
echo '<input type="number" id="nbre_de_place" name="nbre_de_place" min="4" max="8" required style="width: 60px;"><br>';



echo '<label for="couleur" style="font-family: \'Georgia\', serif; font-size: 18px; color: purple;">Couleur:</label>';
echo '<select id="couleur" name="couleur" required>';

$couleurs = ["noir", "rouge", "bleu", "blanche", "gris"];
foreach ($couleurs as $couleur) {
    echo "<option value=\"$couleur\">$couleur</option>";
}

echo '</select><br>';


echo '<label for="marque" style="font-family: \'Georgia\', serif; font-size: 18px; color: purple;">Marque:</label>';
echo '<select id="marque" name="marque" required>';
$marques = [
    "Toyota", "Peugeot", "Renault", "Kia", "Hyundai",
    "Volkswagen", "Mercedes-Benz", "Audi"
];
foreach ($marques as $marque) {
    echo "<option value=\"$marque\">$marque</option>";
}
echo '</select><br>';

echo '<label for="kilometrage" style="font-family: \'Georgia\', serif; font-size: 18px; color: purple;">Kilométrage:</label>';
echo '<select id="kilometrage" name="kilometrage" required>';
$kilometrages = ["80000", "100000", "150000", "200000", "250000", "300000"];
foreach ($kilometrages as $km) {
    echo "<option value=\"$km\">$km</option>";
}
echo '</select><br>';

echo '
  <!-- Bouton Ajouter un Transport -->
  <div style="text-align: left;">
    <button type="submit" style="font-family: Georgia, serif; font-size: 16px; padding: 8px 16px;">
      Ajouter un Transport
    </button>
  </div>

  <!-- Bouton Choisir un Monument aligné à droite -->
  <div style="text-align: right; margin-top: 10px;">
    <a href="addmonumentoffer.php" style="text-decoration: none;">
      <button type="button" style="font-family: Georgia, serif; font-size: 16px; padding: 8px 16px;">
        Choisir un Monument
      </button>
    </a>
  </div>';






echo '</form>';

?>
 <?php
    if (!empty($success)) {
        echo "<div style='color: green; font-weight: bold; margin-top: 20px;'>$success</div>";
    }
    if (!empty($error)) {
        echo "<div style='color: red; font-weight: bold; margin-top: 20px;'>$error</div>";
    }
    ?>

    <!-- JavaScript for Dynamic Effect -->
    <script>
        window.onload = function () {
            // Display the title and form with a fade-in effect
            document.getElementById("motivationalTitle").style.opacity = 1;
            document.querySelector("form").style.opacity = 1;
        }
    </script>
</body>

</html>
