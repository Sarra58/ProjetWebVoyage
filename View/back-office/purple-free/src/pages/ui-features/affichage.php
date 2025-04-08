<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_database";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Fetch complaints data
    $sql = "SELECT * FROM Reclamation";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $reclamations = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $conn = null;
} catch(PDOException $e) {
    error_log("Database error: " . $e->getMessage());
    $reclamations = [];
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TunisianTreasures - Liste Des Réclamations</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
        .header {
            color: #2c3e50;
            margin-bottom: 20px;
        }
        .table-container {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 20px;
        }
        .table th {
            background-color: #2c3e50;
            color: white;
        }
        .action-btns .btn {
            margin-right: 5px;
            font-size: 0.8rem;
            padding: 3px 8px;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            color: #6c757d;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>
    <div class="container mt-4">
        <h2 class="header">Liste Des Réclamations</h2>
        
        <div class="table-container">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Utilisateur ID</th>
                        <th>Sujet</th>
                        <th>Description</th>
                        <th>Statut</th>
                        <th>Date de création</th>
                        <th>Date de fermeture</th>
                        <th>Operation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($reclamations)): ?>
                        <?php foreach ($reclamations as $reclamation): ?>
                            <tr>
                                <td><?= htmlspecialchars($reclamation['id']) ?></td>
                                <td><?= htmlspecialchars($reclamation['utilisateur_id']) ?></td>
                                <td><?= htmlspecialchars($reclamation['sujet']) ?></td>
                                <td><?= htmlspecialchars($reclamation['description']) ?></td>
                                <td><?= htmlspecialchars($reclamation['statut']) ?></td>
                                <td><?= htmlspecialchars($reclamation['date_creation']) ?></td>
                                <td><?= htmlspecialchars($reclamation['date_fermeture']) ?></td>
                                <td class="action-btns">
                                    <!-- Delete button now linked to delete.php with the corresponding ID -->
                                    <a href="supprimer.php?id=<?= $reclamation['id'] ?>" class="btn btn-danger btn-sm">Supprimer</a>
                                    <a href="modifier.php?id=<?= $reclamation['id'] ?>" class="btn btn-warning btn-sm">Modifier</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Aucune réclamation trouvée</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <div class="footer">
            Conception et Réalisation par GHANNEM Minyar
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
