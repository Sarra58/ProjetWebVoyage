<?php
include(__DIR__ . '/../../controller/TransportOfferController.php');

$error = "";
$successMessage = "";
$transportController = new TransportController();
$transportActuel = null;

// ✅ Toujours récupérer l’ID depuis GET ou POST
$id = $_GET['id_de_transport'] ?? $_POST['id_de_transport'] ?? null;

// ✅ Si on a un ID, on charge l'objet
if ($id) {
    $transportActuel = $transportController->getTransportById($id);

    // Ne montrer cette erreur que si on n'est PAS en POST (éviter double erreur)
    if (!$transportActuel && $_SERVER["REQUEST_METHOD"] !== "POST") {
        $error = "❌ Transport introuvable avec l'ID $id";
    }
} else {
    $error = "❌ Aucun ID de transport spécifié.";
}

// ✅ Si on soumet le formulaire (POST), on traite la mise à jour
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if (
        isset($_POST["nom_bapteme"], $_POST["nbre_de_place"], $_POST["couleur"], $_POST["marque"], $_POST["kilometrage"]) &&
        !empty($id) && !empty($_POST["nom_bapteme"]) && !empty($_POST["nbre_de_place"])
    ) {
        $transport = new Transport(
            $id,
            $_POST['nom_bapteme'],
            $_POST['nbre_de_place'],
            $_POST['couleur'],
            $_POST['marque'],
            $_POST['kilometrage']
        );

        $result = $transportController->updateTransport($transport);

        if ($result) {
            $successMessage = "✅ Le transport a été mis à jour avec succès !";

            // Recharge après update
            $transportActuel = $transportController->getTransportById($id);
        } else {
            $error = "⚠️ Aucune modification n'a été effectuée. Vérifiez les champs ou l'ID.";
        }
    } else {
        $error = "❌ Champs requis manquants.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Transport</title>
    <style>
        body {
            background: linear-gradient(45deg, violet, black);
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            animation: backgroundAnimation 10s ease-in-out infinite;
        }

        @keyframes backgroundAnimation {
            0% { background: linear-gradient(45deg, violet, black); }
            50% { background: linear-gradient(45deg, black, violet); }
            100% { background: linear-gradient(45deg, violet, black); }
        }

        form {
            background-color: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            width: 400px;
            box-shadow: 0 0 10px #0003;
        }

        input, select, button {
            width: 100%;
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

        button {
            background: linear-gradient(45deg, black, violet);
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        h2 { text-align: center; color: white; }
        .message { text-align: center; font-weight: bold; margin-top: 10px; }
        .success { color: green; }
        .error { color: red; }
    </style>
</head>
<body>

<form method="POST" action="">
    <h2>Modifier Transport</h2>

    <!-- Messages -->
    <?php if (!empty($successMessage)) echo "<div class='message success'>$successMessage</div>"; ?>
    <?php if (!empty($error)) echo "<div class='message error'>$error</div>"; ?>

    <!-- ID caché -->
    <form method="POST" action="?id_de_transport=<?= htmlspecialchars($id) ?>">
    <input type="hidden" name="id_de_transport" value="<?= htmlspecialchars($id) ?>">

    <?php if ($transportActuel): ?>
        <label for="nom_bapteme">Nom Baptême:</label>
        <select name="nom_bapteme" required>
            <?php
            $baptemes = ["Baptême1", "Baptême2", "Baptême3", "Baptême4"];
            foreach ($baptemes as $b) {
                $selected = ($transportActuel->getNomBapteme() === $b) ? 'selected' : '';
                echo "<option value='$b' $selected>$b</option>";
            }
            ?>
        </select>

        <label for="nbre_de_place">Nombre de places:</label>
        <input type="number" name="nbre_de_place" required value="<?= $transportActuel->getNbreDePlace() ?>">

        <label for="couleur">Couleur:</label>
        <input type="text" name="couleur" value="<?= $transportActuel->getCouleur() ?>">

        <label for="marque">Marque:</label>
        <select name="marque" required>
            <?php
            $marques = ["Marque1", "Marque2", "Marque3", "Marque4"];
            foreach ($marques as $m) {
                $selected = ($transportActuel->getMarque() === $m) ? 'selected' : '';
                echo "<option value='$m' $selected>$m</option>";
            }
            ?>
        </select>

        <label for="kilometrage">Kilométrage:</label>
        <select name="kilometrage" required>
            <?php
            $kms = [10000, 20000, 30000, 40000];
            foreach ($kms as $km) {
                $selected = ($transportActuel->getKilometrage() == $km) ? 'selected' : '';
                echo "<option value='$km' $selected>" . number_format($km, 0, ',', ' ') . " km</option>";
            }
            ?>
        </select>

        <button type="submit">Mettre à jour</button>
    <?php else: ?>
        <p class="error">Impossible d'afficher le formulaire. Aucun transport valide n’a été chargé.</p>
    <?php endif; ?>
</form>

</body>
</html>
