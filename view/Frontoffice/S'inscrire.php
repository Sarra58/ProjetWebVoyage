<?php
session_start();
require '../../config.php'; // Assurez-vous que le chemin est correct

$error_message = "";
$success_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $Tel = $_POST['Tel'];
    $role = 'user';

    $action = $_POST['action'];

    if ($action === 'register') {
      if (!preg_match('/^\d{8}$/', $Tel)) {
        $error_message = "Le numéro de téléphone doit contenir exactement 8 chiffres.";
    } elseif (strpos($email, '@') === false) {
        $error_message = "L'adresse email doit contenir le caractère '@'.";
    } elseif (strlen($password) < 5) {
        $error_message = "Le mot de passe doit contenir au moins 5 caractères.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO user (nom, prenom, email, password, Tel,role) 
                VALUES (:nom, :prenom, :email, :password, :Tel,:role)";
        $stmt = $query->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword); // Utiliser le mot de passe haché
        $stmt->bindParam(':Tel', $Tel);
        $stmt->bindParam(':role', $role); // Liaison du rôle

        if ($stmt->execute()) {
            $success_message = "Utilisateur enregistré avec succès.";
            header("Location: Seconnecter.php");
            exit();
        } else {
            $error_message = "Erreur lors de l'enregistrement de l'utilisateur.";
        }
    }
  }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Inscription Tripster</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', sans-serif;
      background: #000;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .container {
      background: linear-gradient(180deg, #1f1f1f, #111);
      padding: 40px;
      border-radius: 20px;
      width: 400px;
      color: #ccc;
      box-shadow: 0 0 20px rgba(0,0,0,0.5);
    }

    .logo {
      display: flex;
      justify-content: center;
      margin-bottom: 20px;
    }

    .logo img {
      width: 120px;
    }

    .title {
      text-align: center;
      margin-bottom: 30px;
    }

    .title h2 {
      margin: 0;
      color: #ccc;
    }

    .title p {
      margin: 5px 0 0;
      color: #777;
      font-size: 14px;
    }

    label {
      display: block;
      margin-top: 10px;
      color: #ccc;
      font-size: 14px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border-radius: 8px;
      border: 1px solid #888;
      background: transparent;
      color: #fff;
    }

    .btn {
      width: 100%;
      padding: 12px;
      margin-top: 15px;
      border: none;
      border-radius: 10px;
      font-weight: bold;
      background: linear-gradient(to right, #a135f3, #ff8c00);
      color: white;
      cursor: pointer;
      transition: 0.3s ease;
    }

    .btn:hover {
      opacity: 0.9;
    }

    .message {
      text-align: center;
      font-size: 14px;
      margin-top: 15px;
    }

    .message.error {
      color: #ff4d4d;
    }

    .message.success {
      color: #4dff88;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="logo">
<img src="images/logotripster.png" alt="Logo Tripster">
    </div>

    <div class="title">
      <h2>Inscris-toi</h2>
      <p>Rejoins l’aventure Tripster</p>
    </div>

    <form action="S'inscrire.php" method="POST">
    <input type="text" name="nom" placeholder="Nom" required value="<?php echo isset($_POST['nom']) ? htmlspecialchars($_POST['nom']) : ''; ?>">
    <input type="text" name="prenom" placeholder="Prénom" required value="<?php echo isset($_POST['prenom']) ? htmlspecialchars($_POST['prenom']) : ''; ?>">
    <input type="text" name="email" placeholder="Email" required value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
    <input type="password" name="password" placeholder="Mot de passe" required>

      <label for="Tel">Numéro de téléphone :</label>
      <input type="text" id="Tel" name="Tel" placeholder="Ex: 94497431" value="<?php echo isset($_POST['Tel']) ? htmlspecialchars($_POST['Tel']) : ''; ?>">

      <!-- Ajouter un champ caché pour l'action -->
      <input type="hidden" name="action" value="register">

      <button type="submit" class="btn">S'inscrire</button>

      <?php if (!empty($error_message)): ?>
        <div class="message error"><?php echo $error_message; ?></div>
      <?php endif; ?>

      <?php if (!empty($success_message)): ?>
        <div class="message success"><?php echo $success_message; ?></div>
      <?php endif; ?>
    </form>
  </div>

</body>
</html>
