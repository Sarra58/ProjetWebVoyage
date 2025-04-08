<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_database";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if ID is provided for editing
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Fetch the record to edit
        $sql = "SELECT * FROM Reclamation WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $reclamation = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$reclamation) {
            echo "Record not found.";
            exit();
        }

        // Handle the form submission to update the record
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sujet = $_POST['sujet'];
            $description = $_POST['description'];
            $statut = $_POST['statut'];
            $date_fermeture = $_POST['date_fermeture'];
            
            // Prepare the SQL query to update the record
            $sql = "UPDATE Reclamation SET sujet = :sujet, description = :description, statut = :statut, date_fermeture = :date_fermeture WHERE id = :id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':sujet', $sujet, PDO::PARAM_STR);
            $stmt->bindParam(':description', $description, PDO::PARAM_STR);
            $stmt->bindParam(':statut', $statut, PDO::PARAM_STR);
            $stmt->bindParam(':date_fermeture', $date_fermeture, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            
            // Redirect to the list page after the update
            header("Location: http://localhost/projetWebMinyar/View/back-office/purple-free/src/pages/ui-features/affichage.php");
            exit();
        }
    } else {
        echo "ID not specified for editing.";
        exit();
    }

    $conn = null;
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Réclamation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2>Editer la réclamation</h2>

        <form method="POST">
            <div class="mb-3">
                <label for="sujet" class="form-label">Sujet</label>
                <input type="text" class="form-control" id="sujet" name="sujet" value="<?= htmlspecialchars($reclamation['sujet']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required><?= htmlspecialchars($reclamation['description']) ?></textarea>
            </div>
            <div class="mb-3">
                <label for="statut" class="form-label">Statut</label>
                <select class="form-control" id="statut" name="statut" required>
                    <option value="ouvert" <?= $reclamation['statut'] == 'ouvert' ? 'selected' : '' ?>>Ouvert</option>
                    <option value="en cours" <?= $reclamation['statut'] == 'en cours' ? 'selected' : '' ?>>En cours</option>
                    <option value="fermer" <?= $reclamation['statut'] == 'fermer' ? 'selected' : '' ?>>Fermer</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="date_creation" class="form-label">Date de création</label>
                <input type="text" class="form-control" id="date_creation" name="date_creation" value="<?= htmlspecialchars($reclamation['date_creation']) ?>" disabled>
            </div>
            <div class="mb-3">
                <label for="date_fermeture" class="form-label">Date de fermeture</label>
                <input type="datetime-local" class="form-control" id="date_fermeture" name="date_fermeture" value="<?= htmlspecialchars($reclamation['date_fermeture']) ?>">
            </div>
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
