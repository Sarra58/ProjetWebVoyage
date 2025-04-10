<?php
// Connexion à la base de données avec PDO
$host = 'localhost';
$dbname = 'my_database';
$username = 'root';
$password = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $reclamation_id = $_POST['reclamation_id'];
    $contenu = $_POST['contenu'];
    $date_creation = $_POST['date_creation'];

    // Requête d'insertion
    $sql = "INSERT INTO reponse (reclamation_id, contenu, date_creation) VALUES (:reclamation_id, :contenu, :date_creation)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':reclamation_id' => $reclamation_id,
        ':contenu' => $contenu,
        ':date_creation' => $date_creation
    ]);

    // Redirection après insertion (optionnelle)
    header("Location: http://localhost/projetWebMinyar/View/back-office/purple-free/src/pages/ui-features/reponse_succees.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Réclamations</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Projet Travelix">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="styles/bootstrap4/bootstrap.min.css">
    <link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="plugins/colorbox/colorbox.css" rel="stylesheet">
    <link rel="stylesheet" href="styles/blog_styles.css">
    <link rel="stylesheet" href="styles/blog_responsive.css">
</head>

<body>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <div class="card shadow">
                <div class="card-header text-white" style="background-color: #382260;">
                    <h4 class="mb-0">Formulaire</h4>
                </div>

                <div class="card-body">
    <form method="post" id="reponseForm">
        <div class="mb-3">
            <label for="reclamation_id" class="form-label">Réclamation ID</label>
            <input type="text" class="form-control" id="reclamation_id" name="reclamation_id" 
                   value="<?= htmlspecialchars($_GET['id']) ?>" readonly>
            <span id="reclamation_id_error" class="text-danger"></span>
        </div>

        <div class="mb-3">
            <label for="contenu" class="form-label">Contenu</label>
            <input type="text" class="form-control" id="contenu" name="contenu">
            <span id="contenu_error" class="text-danger"></span>
        </div>

        <div class="mb-3">
            <label for="date_creation" class="form-label">Date de création</label>
            <input type="date" class="form-control" id="date_creation" name="date_creation" >
            <span id="date_creation_error" class="text-danger"></span>
        </div>

        <div class="text-end">
            <button type="submit" class="btn text-white" style="background-color: #382260;">Envoyer</button>
            <button type="reset" class="btn text-white" style="background-color: #382260;">Annuler</button>
        </div>
    </form>
</div>

<script>
    document.getElementById('reponseForm').addEventListener('submit', function(event) {
        let isValid = true;

        // Clear previous error messages
        document.querySelectorAll('.text-danger').forEach(function(span) {
            span.textContent = '';
        });

        // Validate Contenu
        const contenu = document.getElementById('contenu').value.trim();
        if (!contenu) {
            document.getElementById('contenu_error').textContent = 'Le contenu est requis.';
            isValid = false;
        }

        // Validate Date de création
        const dateCreation = document.getElementById('date_creation').value;
        if (!dateCreation) {
            document.getElementById('date_creation_error').textContent = 'La date de création est requise.';
            isValid = false;
        }

        // Optionally validate Réclamation ID even if it's readonly
        const reclamationId = document.getElementById('reclamation_id').value;
        if (!reclamationId) {
            document.getElementById('reclamation_id_error').textContent = 'ID de réclamation manquant.';
            isValid = false;
        }

        if (!isValid) {
            event.preventDefault();
        }
    });
</script>

            </div>

        </div>
    </div>
</div>
<br><br><br>
</body>
</html>
