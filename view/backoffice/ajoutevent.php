<?php
require_once '../../Model/Event.php'; 
require_once '../../config.php';
require_once '../../controller/eventc.php'; 

if (
    isset($_POST["titre"], $_POST["description"], $_POST["date_debut"], $_POST["date_fin"], $_POST["lieu"], $_FILES["photo"])
) {
    if (
        !empty($_POST["titre"]) &&
        !empty($_POST["description"]) &&
        !empty($_POST["date_debut"]) &&
        !empty($_POST["date_fin"]) &&
        !empty($_POST["lieu"]) &&
        !empty($_FILES["photo"]["name"])
    ) {
        $photoName = basename($_FILES["photo"]["name"]);
        $targetDir = "uploads/";
        $targetFile = $targetDir . $photoName;

        // Crée le dossier si pas encore existant
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        if (move_uploaded_file($_FILES["photo"]["tmp_name"], $targetFile)) {

            $Event = new Event(
                null,
                $_POST["titre"],
                $_POST["description"],
                $_POST["date_debut"],
                $_POST["date_fin"],
                $_POST["lieu"],
                $targetFile // On stocke le chemin de la photo, pas le contenu
            );

            $eventc = new eventc();
            $titre = $_POST["titre"];

            if ($eventc->chercher_titre($titre) === NULL) {
                $eventc->addEvent($Event);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajout Réussi</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            background-color: #f4f4f4;
        }

        .welcome-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .welcome-text {
            font-size: 5em;
            animation: fadeInOut 3s forwards;
            color: #007bff;
        }

        @keyframes fadeInOut {
            0% { opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { opacity: 0; }
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <p class="welcome-text">Ajout avec succès</p>
    </div>
    <script>
        setTimeout(function() {
            window.location.href = "event.php";
        }, 1000);
    </script>
</body>
</html>
<?php
            } else {
                echo '<script>alert("❌ Le titre existe déjà."); window.location.href = "ajoutevent.html";</script>';
            }
        } else {
            echo '<script>alert("❌ Erreur lors du téléchargement de l\'image."); window.location.href = "ajoutevent.html";</script>';
        }
    } else {
        echo '<script>alert("❌ Tous les champs sont obligatoires."); window.location.href = "ajoutevent.html";</script>';
    }
} else {
    echo '<script>alert("❌ Formulaire invalide."); window.location.href = "ajoutevent.html";</script>';
}
?>
