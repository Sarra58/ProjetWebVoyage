<?php
require '../../config.php';

$error_message = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $Tel = $_POST['Tel'];
    $role = $_POST['role'];

    // Vérification dans l'ordre logique
    if (empty($nom) || empty($prenom) || empty($email) || empty($password) || empty($Tel) || empty($role)) {
        $error_message = "Tous les champs sont obligatoires.";
    } elseif (strlen($password) < 5) {
        $error_message = "Le mot de passe doit contenir au moins 5 caractères.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Adresse email invalide.";
    } elseif (!preg_match('/^\d{8}$/', $Tel)) {
        $error_message = "Le numéro de téléphone doit contenir exactement 8 chiffres.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $query->prepare("INSERT INTO user (nom, prenom, email, password, Tel, role) VALUES (?, ?, ?, ?, ?, ?)");

        if ($stmt->execute([$nom, $prenom, $email, $hashedPassword, $Tel, $role])) {
            header("Location: index.php?success=1");
            exit();

        } else {
            $error_message = "Erreur lors de l'ajout.";
        }
    }
}
?>


<!-- Partie HTML dans le même thème Purple Admin -->
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Ajouter un utilisateur</title>
  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
  <div class="container-scroller">
    <!-- Ajoute ici le même navbar que ta page principale si tu veux -->
    <div class="container mt-5">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Ajouter un nouvel utilisateur</h4>

          <?php if ($error_message): ?>
            <div class="alert alert-danger"><?= $error_message ?></div>
          <?php elseif ($success_message): ?>
            <div class="alert alert-success"><?= $success_message ?></div>
          <?php endif; ?>

          <form method="POST">
            <div class="form-group">
              <label>Nom</label>
              <input type="text" name="nom" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Prénom</label>
              <input type="text" name="prenom" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Email</label>
              <input type="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Mot de passe</label>
              <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Téléphone</label>
              <input type="text" name="Tel" class="form-control" required>
            </div>
            <div class="form-group">
              <label>Rôle</label>
              <select name="role" class="form-control">
                <option value="user">Utilisateur</option>
                <option value="admin">Administrateur</option>
              </select>
            </div>
            <button type="submit" class="btn btn-success mt-3">Ajouter</button>
            <a href="listeusers.php" class="btn btn-secondary mt-3">Retour</a>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
