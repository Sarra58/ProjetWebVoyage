<?php
require_once '../../Controller/userController.php';
require_once '../../Model/user.php';  

$userController = new UserController();

if (isset($_GET['id'])) {
    $user = $userController->getUserById($_GET['id']);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $userController->getUserById($id)['email'];
    $tel = $_POST['tel'];
    $role = $_POST['role'];
    $password = ''; 
    if (!preg_match('/^\d{8}$/', $tel)) {
        echo "<script>alert('Le numéro de téléphone doit contenir exactement 8 chiffres.'); window.history.back();</script>";
        exit();
    }

    $user = new User(
        (int)$id,        
        $nom,           
        $prenom,         
        $email,         
        $password,       // Password (tu peux garder une valeur vide si tu ne veux pas le changer)
        $role,           // Rôle
        (int)$tel        // Téléphone
    );

    // Appeler la fonction du contrôleur pour mettre à jour l'utilisateur
    $userController->updateUser($user, $id);

    // Rediriger vers la page index.php après l'enregistrement
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Modifier Utilisateur</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>
<body>
    <div class="container-scroller">
        <!-- Navbar et autres éléments de la page ici -->

        <!-- Formulaire de modification -->
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Modifier l'utilisateur</h4>
                    <form method="POST" action="modifieruser.php">
                        <input type="hidden" name="id" value="<?= $user['id'] ?>">

                        <div class="form-group">
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="<?= htmlspecialchars($user['nom']) ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="prenom">Prénom</label>
                            <input type="text" class="form-control" id="prenom" name="prenom" value="<?= htmlspecialchars($user['prenom']) ?>" required>
                        </div>

                        <div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" readonly>
</div>

                        <div class="form-group">
                            <label for="tel">Téléphone</label>
                            <input type="tel" class="form-control" id="tel" name="tel" value="<?= htmlspecialchars($user['Tel']) ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="role">Rôle</label>
                            <select class="form-control" id="role" name="role" required>
                                <option value="admin" <?= ($user['role'] == 'admin') ? 'selected' : '' ?>>Admin</option>
                                <option value="user" <?= ($user['role'] == 'user') ? 'selected' : '' ?>>Utilisateur</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-success">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Scripts -->
        <script src="assets/vendors/js/vendor.bundle.base.js"></script>
        <script src="assets/js/off-canvas.js"></script>
        <script src="assets/js/misc.js"></script>
        <script src="assets/js/settings.js"></script>
        <script src="assets/js/todolist.js"></script>
        <script src="assets/js/jquery.cookie.js"></script>
    </div>
</body>
</html>
