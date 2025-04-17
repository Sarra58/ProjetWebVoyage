<?php
session_start();
include(__DIR__ . '/../../controller/monumentoffercontroller.php');

$error = "";
$monument = null;
$monumentController = new MonumentController();

$transport_id = isset($_SESSION['transport_id']) ? $_SESSION['transport_id'] : '';

if (
    isset($_POST['transport_id'], $_POST['nom_monument'], $_POST['date_depart'], $_POST['heure_depart'])
) {
    if (
        !empty($_POST['transport_id']) &&
        !empty($_POST['nom_monument']) &&
        !empty($_POST['date_depart']) &&
        !empty($_POST['heure_depart'])
    ) {
        // Créer l'objet MonumentOffer
        $monument = new MonumentOffer(
            null,
            $_POST['transport_id'],
            $_POST['nom_monument'],
            $_POST['date_depart'],
            $_POST['heure_depart']
        );

        // Ajouter à la base de données
        $result = $monumentController->addMonument($monument);

        if ($result !== false && is_numeric($result)) {
            $_SESSION['monument_data'] = [
                'transport_id' => $_POST['transport_id'],
                'nom_monument' => $_POST['nom_monument'],
                'date_depart' => $_POST['date_depart'],
                'heure_depart' => $_POST['heure_depart']
            ];

            // ✅ Redirection vers la page de résumé
            header("Location: showofferinfo.php");
            exit();
        } else {
            $error = "❌ Une erreur est survenue lors de l'ajout du monument. Veuillez réessayer.";
        }
    } else {
        $error = "⚠️ Tous les champs sont obligatoires. Veuillez les remplir.";
    }
}
?>


<?php if (!empty($_GET['success']) && !empty($_GET['id']) && is_numeric($_GET['id'])): ?>
    <style>
        .monument-animation {
            position: relative;
            width: 100%;
            height: 100px;
            overflow: visible;
            margin-top: 20px;
        }

        .monument {
            position: absolute;
            left: -200px;
            animation: appear 20s ease-in-out forwards;
            display: flex;
            align-items: center;
            font-weight: bold;
            font-size: 18px;
            color: rgb(248, 245, 249);
            background: linear-gradient(to right, rgb(40, 100, 150), black);
            border: 2px solid teal;
            padding: 10px 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 255, 255, 0.3);
        }

        @keyframes appear {
            from { left: -200px; }
            to { left: 100%; }
        }

        .monument-icon {
            font-size: 24px;
            margin-right: 10px;
        }
    </style>

    <div class="monument-animation">
        <div class="monument">
            <div class="monument-icon">🗿✨</div>
            Monument ajouté avec succès ! ID = <?= htmlspecialchars($_GET['id']) ?>
        </div>
    </div>
    <?php elseif (!empty($error)): ?>
    <style>
        .error-message {
            background-color: #ffe6e6;
            border: 2px solid #dc3545;
            color: #721c24;
            font-weight: bold;
            padding: 15px 20px;
            margin-top: 20px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: fadeIn 1s ease-in-out;
            box-shadow: 0 0 10px rgba(220, 53, 69, 0.3);
        }

        .error-icon {
            font-size: 24px;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>

    <div class="error-message">
        <div class="error-icon">❌</div>
        <?= htmlspecialchars($error) ?>
    </div>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ajouter monument</title>

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
                right: 450px;
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
        <img src="3.png" alt="Car Left">
    </div>

    <div class="car-right">
        <img src="6.png" alt="Car Right">
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
    <h1 id="motivationalTitle" style="margin-top: 40px; text-align: center;">
    Les monuments ne sont pas faits que de pierre, mais de mémoire!
</h1>

    <!-- Form -->
    <?php
// Affichage du titre


echo '<form method="POST" action="" style="width: 90%; max-width: 800px; margin: auto; background-color: rgba(249, 249, 249, 0.8); padding: 20px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">';

// ID Transport
echo '<label for="transport_id" style="font-family: Georgia, serif; font-size: 18px; color: purple;">ID Transport :</label>';
echo '<input type="number" id="transport_id" name="transport_id" required style="width: 80px; padding: 5px; margin: 5px 0;"><br>';

// Monuments
echo '<label for="nom_monument" style="font-family: Georgia, serif; font-size: 18px; color: purple; text-align: left; display: block;">Monument :</label>';

// Menu déroulant (combobox)
echo '<select name="nom_monument" id="nom_monument" required style="width: 100%; padding: 10px; font-size: 16px; font-family: Georgia, serif; margin-bottom: 15px;">';

$monuments = [
    "Tour Eiffel",
    "Cathédrale Notre-Dame",
    "Mont Saint-Michel",
    "Château de Versailles",
    "Pont du Gard",
    "Pyramide du Louvre"
];

foreach ($monuments as $monument) {
    echo "<option value=\"$monument\">$monument</option>";
}

echo '</select>';

// Date de départ
echo '<label for="date_depart" style="font-family: Georgia, serif; font-size: 18px; color: purple;">Date de départ :</label>';
echo '<input type="date" id="date_depart" name="date_depart" required style="padding: 5px; margin: 5px 0;"><br>';

// Heure de départ
echo '<label for="heure_depart" style="font-family: Georgia, serif; font-size: 18px; color: purple;">Heure de départ :</label>';
echo '<input type="time" id="heure_depart" name="heure_depart" required style="padding: 5px; margin: 5px 0;"><br>';

// Bouton de soumission
echo '
  <div style="text-align: left; margin-top: 20px;">
    <button type="submit" style="font-family: Georgia, serif; font-size: 16px; padding: 10px 20px; background-color: purple; color: white; border: none; border-radius: 5px; cursor: pointer;">
      Ajouter un Monument au Transport
    </button>
  </div>';

echo '</form>';

// Traitement après soumission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $transport_id = $_POST['transport_id'];
    $date_depart = $_POST['date_depart'];
    $heure_depart = $_POST['heure_depart'];
    
    if (isset($_POST['nom_monument']) && is_array($_POST['nom_monument'])) {
        foreach ($_POST['nom_monument'] as $monument) {
            echo "Ajout prévu pour le monument : <strong>$monument</strong><br>";
        }
    } else {
        echo "Aucun monument sélectionné.";
    }
}
?>
 <?php
    if (!empty($success)) {
        echo "<div style='color: green; font-weight: bold; margin-top: 20px;'>$success</div>";
    }
    if (!empty($error)) {
        echo "<div style='color: red; font-weight: bold; margin-top: 20px;'>$error</div>";
    }
    ?>

