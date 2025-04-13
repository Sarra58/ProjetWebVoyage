<?php
session_start();
require '../../config.php'; // Connexion DB
require_once '../../Model/user.php';
require_once '../../Controller/UserController.php'; // Assure-toi du chemin

$error_message = "";
$success_message = "";

$controller = new UserController();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = trim($_POST['password']);

    // Vérifie le login via UserController
    $loginResult = $controller->checkUserLogin($email, $password);

    if ($loginResult === "Login successful!") {
        // Si login ok, on récupère l'utilisateur pour stocker les infos dans la session
        $user = $controller->getUserByEmail($email);

        if ($user) {
            $_SESSION['nom'] = $user['nom'];
            $_SESSION['role'] = $user['role'];

            // Redirection selon le rôle
            if ($user['role'] === 'admin') {
                header("Location: ../backofficee/index2.html");
                exit();
            } else {
              header("Location: index4.php?email=" . $email);
                exit();
            }
        } else {
            $error_message = "Impossible de récupérer les données de l'utilisateur.";
        }
    } else {
        $error_message = $loginResult; // Affiche le message d'erreur retourné par le contrôleur
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion Tripster</title>
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
      width: 350px;
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
      color: #666;
    }

    .title p {
      margin: 5px 0 0;
      color: #777;
      font-size: 14px;
    }

    input[type="text"], input[type="password"], input[type="email"], select {
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

    .options {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 15px;
      font-size: 14px;
    }

    .options a {
      color: #b084ff;
      text-decoration: none;
    }

    .social-btn {
      background: #3b5998;
      color: white;
      padding: 12px;
      margin-top: 20px;
      border: none;
      border-radius: 10px;
      font-weight: bold;
      width: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .social-btn i {
      margin-right: 8px;
    }

    .signup {
      text-align: center;
      margin-top: 20px;
      font-size: 14px;
    }

    .signup a {
      color: #b084ff;
      text-decoration: none;
    }

    .message {
      text-align: center;
      margin-top: 15px;
      font-size: 14px;
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
      <h2>Bonjour ! Commençons</h2>
      <p>Connectez-vous pour continuer</p>
    </div>

    <form action="Seconnecter.php" method="POST">
      <input type="email" name="email" placeholder="email" required>
      <input type="password" name="password" placeholder="password" required>

      <button type="submit" class="btn">Se connecter</button>

      <div class="options">
        <label><input type="checkbox" name="remember"> Rester connecté</label>
        <a href="#">Mot de passe oublié</a>
      </div>

      <button type="button" class="social-btn">
        <i class="fab fa-facebook-f"></i> Se connecter avec Facebook
      </button>

      <div class="signup">
        Tu n'as pas un compte ? <a href="#">Créer</a>
      </div>

      <?php if (!empty($error_message)): ?>
        <div class="message error"><?php echo $error_message; ?></div>
      <?php endif; ?>

      <?php if (!empty($success_message)): ?>
        <div class="message success"><?php echo $success_message; ?></div>
      <?php endif; ?>
    </form>
  </div>

  <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html>
