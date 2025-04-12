<?php
include(__DIR__ . '/../../controller/TransportOfferController.php');

$error = "";
$transport = null;
$transportController = new TransportController();

if (isset($_POST['nom_bapteme'], $_POST['nbre_de_place'], $_POST['couleur'], $_POST['marque'], $_POST['kilometrage'])) {
    if (!empty($_POST['nom_bapteme']) && !empty($_POST['nbre_de_place']) && !empty($_POST['couleur']) && !empty($_POST['marque']) && !empty($_POST['kilometrage'])) {
        // Créer l'objet Transport et l'ajouter à la base de données
        $transport = new Transport(
            null, // ou l'id si nécessaire
            $_POST['nom_bapteme'],
            $_POST['nbre_de_place'],
            $_POST['couleur'],
            $_POST['marque'],
            $_POST['kilometrage']
        );

        // Appel à la méthode d'ajout
        $result = $transportController->addTransport($transport);

        if ($result === "Transport ajouté avec succès!") {
            // Redirection après l'ajout avec succès
            header("Location: TransportOfferList.php?success=true");
            exit();
        } else {
            // Afficher une erreur si l'ajout échoue
            $error = "Erreur : l'ajout a échoué. Veuillez réessayer.";
        }
    } else {
        $error = "Toutes les informations sont nécessaires.";
    }
}
?>
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
                right: 320px;
            }
            100% {
                right: -250px;
            }
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

    <!-- Motivational Title -->
    <h1 id="motivationalTitle">Chaque destination mérite un moyen de transport à la hauteur de ses rêves!</h1>

    <!-- Form -->
    <form method="POST" action="">
        <label for="nom_bapteme">Nom du baptême:</label>
        <select id="nom_bapteme" name="nom_bapteme" required>
            <option value="Baptême1">Le Grand Voyageur</option>
            <option value="Baptême2">Taureau d’Asphalte</option>
            <option value="Baptême3">Vent Nomade</option>
            <option value="Baptême4">Route d’Or</option>
            <option value="Baptême4">Voyage Indigo</option>
            <option value="Baptême4">Orion Prestige</option>
            <option value="Baptême4">Monte-Carlo</option>
            <option value="Baptême4">Galaxie Privée</option>
        </select><br>

        <label for="nbre_de_place">Nombre de places:</label>
        <input type="number" id="nbre_de_place" name="nbre_de_place" required><br>

        <label for="couleur">Couleur:</label>
        <input type="text" id="couleur" name="couleur"><br>

        <label for="marque">Marque:</label>
        <select id="marque" name="marque" required>
            <option value="Marque1">Toyota</option>
            <option value="Marque2">Peugeot</option>
            <option value="Marque3">Renault</option>
            <option value="Marque4">Kia</option>
            <option value="Marque4">Hyundai</option>
            <option value="Marque4">Volkswagen</option>
            <option value="Marque4">Mercedes-Benz</option>
            <option value="Marque4">Audi</option>
        </select><br>

        <label for="kilometrage">Kilométrage:</label>
        <select id="kilometrage" name="kilometrage" required>
            <option value="10000">80,000 km</option>
            <option value="20000">100,000 km</option>
            <option value="30000">150,000 km</option>
            <option value="40000">200,000 km</option>
            <option value="40000">250,000 km</option>
            <option value="40000">300,000 km</option>
        </select><br>

        <button type="submit">ajouter un Transport</button>
    </form>

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
