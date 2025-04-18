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
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <title>Modifier Transport</title>
    <style>
      body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background: linear-gradient(135deg,rgb(3, 3, 3),rgb(10, 10, 10)); /* Dégradé dynamique */
}

/* Conteneur du formulaire */
.form-container {
    width: 100%;
    max-width: 600px;
    padding: 30px;
    background-color: #fff;
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
    border-radius: 15px;
    text-align: center;
    transform: scale(0.98);
    transition: transform 0.3s ease-in-out;
}

/* Effet au survol du formulaire */
.form-container:hover {
    transform: scale(1);
}

/* Titre du formulaire */
h1 {
    font-family: 'Georgia', serif;
    color: #6a1b9a; /* Violet */
    margin-bottom: 30px;
    font-size: 2.5rem;
    text-transform: uppercase;
    letter-spacing: 2px;
    animation: fadeIn 1s ease-out;
}

/* Animations */
@keyframes fadeIn {
    0% {
        opacity: 0;
        transform: translateY(-30px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Style des labels */
label {
    font-size: 18px;
    color: #6a1b9a;
    margin-bottom: 12px;
    display: block;
    font-weight: bold;
    letter-spacing: 1px;
}

/* Style des champs de saisie et des sélections */
select, input[type="number"], button {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 16px;
    background-color: #f5f5f5;
    box-sizing: border-box;
    transition: all 0.3s ease-in-out;
}

/* Effet de focus sur les champs de saisie */
select:focus, input[type="number"]:focus {
    border-color: #6a1b9a; /* Violet */
    background-color: #fff;
    box-shadow: 0 0 10px rgba(106, 27, 154, 0.5); /* Ombre violette */
    outline: none;
}

/* Style des boutons */
button {
    background-color: #6a1b9a; /* Violet */
    color: #fff;
    border: none;
    cursor: pointer;
    font-size: 18px;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: background-color 0.3s ease, transform 0.2s ease;
    font-weight: bold;
}

/* Effet au survol des boutons */
button:hover {
    background-color: #4a148c; /* Violet plus foncé */
    transform: translateY(-3px); /* Légère élévation */
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
}

/* Style des messages */
.message {
    font-size: 16px;
    margin-bottom: 20px;
    padding: 10px;
    border-radius: 5px;
    transition: opacity 0.5s ease-in-out;
}

.success {
    background-color: #c8e6c9; /* Vert clair */
    color: #388e3c; /* Vert foncé */
}

.error {
    background-color: #ffcdd2; /* Rouge clair */
    color: #d32f2f; /* Rouge foncé */
}

/* Effet d'animation pour les messages */
.message.success, .message.error {
    opacity: 1;
}

.message.success.fade, .message.error.fade {
    opacity: 0;
}

/* Effet de fade pour les messages */
@keyframes fadeMessage {
    0% { opacity: 1; }
    100% { opacity: 0; }
}
.floating-logo {
    position: fixed;
    top: 50%;
    right: -650px;
    transform: translateY(-50%);
    width: 500px;
    height: auto;
    animation: floatLogo 4s ease-in-out infinite, rotateLogo 20s linear infinite;
    filter: drop-shadow(0 0 10px rgba(106, 27, 154, 0.6));
    transition: transform 0.3s ease;
    z-index: 999;
}

/* Animation flottante douce */
@keyframes floatLogo {
    0% { transform: translateY(-50%) translateY(0); }
    50% { transform: translateY(-50%) translateY(-15px); }
    100% { transform: translateY(-50%) translateY(0); }
}

/* Légère rotation continue */
@keyframes rotateLogo {
    0% { transform: translateY(-50%) rotate(0deg); }
    100% { transform: translateY(-50%) rotate(360deg); }
}

/* Effet au survol : agrandissement et glow */
.floating-logo:hover {
    transform: translateY(-50%) scale(1.2);
    filter: drop-shadow(0 0 15px rgba(255, 105, 180, 0.8));
}
.floating-logo {
    animation: floatLogo 4s ease-in-out infinite, rotateLogo 20s linear infinite, pulseGlow 2s infinite alternate;
}

/* Effet pulsation glow */
@keyframes pulseGlow {
    from {
        filter: drop-shadow(0 0 10px rgba(106, 27, 154, 0.6));
    }
    to {
        filter: drop-shadow(0 0 20px rgba(255, 105, 180, 1));
    }
}
    </style>
</head>
<body>
<nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row" style="background-color: black;">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
          <a class="navbar-brand brand-logo-mini" href="index.html" style="background-color: black; color: white; padding: 10px;">
            <img src="assets/images/logo.svg" alt="logo" />
          </a>
          
          <a class="navbar-brand brand-logo" href="index.html" style="background-color: black; padding: 10px;">
            <img src="assets/images/logo.svg" alt="logo" />
          </a>
          
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span>
          </button>
          <div class="search-field d-none d-md-block">
            <form class="d-flex align-items-center h-100" action="#">
              <div class="input-group">
                <div class="input-group-prepend bg-transparent">
                  <i class="input-group-text border-0 mdi mdi-magnify"></i>
                </div>
                <input type="text" class="form-control bg-transparent border-0" placeholder="Search projects">
              </div>
            </form>
          </div>
          <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                  <img src="assets/images/faces/face1.jpg" alt="image">
                  <span class="availability-status online"></span>
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black">ANAS FDL</p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                <a class="dropdown-item" href="#">
                  <i class="mdi mdi-cached me-2 text-success"></i> Activity Log </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#">
                  <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
              </div>
            </li>
            <li class="nav-item d-none d-lg-block full-screen-link">
              <a class="nav-link">
                <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
              </a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="mdi mdi-email-outline"></i>
                <span class="count-symbol bg-warning"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                <h6 class="p-3 mb-0">Messages</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="assets/images/faces/face4.jpg" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">karim a envoye un message</h6>
                    <p class="text-gray mb-0"> 1 minute
                    </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="assets/images/faces/face2.jpg" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">molly a envoye un message</h6>
                    <p class="text-gray mb-0"> 15 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="assets/images/faces/face3.jpg" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Profile picture updated</h6>
                    <p class="text-gray mb-0"> 18 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <h6 class="p-3 mb-0 text-center">4 nouveaux messages</h6>
              </div>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-bs-toggle="dropdown">
                <i class="mdi mdi-bell-outline"></i>
                <span class="count-symbol bg-danger"></span>
              </a>
              <div class="dropdown-menu dropdown-menu-end navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <h6 class="p-3 mb-0">Notifications</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-success">
                      <i class="mdi mdi-calendar"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Event today</h6>
                    <p class="text-gray ellipsis mb-0"> Just a reminder that you have an event today </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-warning">
                      <i class="mdi mdi-cog"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Settings</h6>
                    <p class="text-gray ellipsis mb-0"> Update dashboard </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-info">
                      <i class="mdi mdi-link-variant"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Launch Admin</h6>
                    <p class="text-gray ellipsis mb-0"> New admin wow! </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <h6 class="p-3 mb-0 text-center">voir toute les notifications</h6>
              </div>
            </li>
            <li class="nav-item nav-logout d-none d-lg-block">
              <a class="nav-link" href="#">
                <i class="mdi mdi-power"></i>
              </a>
            </li>
            <li class="nav-item nav-settings d-none d-lg-block">
              <a class="nav-link" href="#">
                <i class="mdi mdi-format-line-spacing"></i>
              </a>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar" style="background-color: black; color: white; padding: 20px;">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img src="assets/images/faces/face1.jpg" alt="profile" />
                  <span class="login-status online"></span>
                  <!--change to offline or busy as needed-->
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2">ANAS FDL</span>
                  <span class="text-secondary text-small">PDG</span>
                </div>
                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="index.html">
                <span class="menu-title">tableau de bord</span>
                <i class="mdi mdi-home menu-icon"></i>
              </a>
            </li>
           
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">les entités</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="/gestion_transport/View/BacKOffice/TransportOfferList.php">gestion de transport</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/ui-features/index.html">gestion de voyage </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/ui-features/index.html">gestion de sponsor</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/ui-features/index.html">gestion de reservation</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/ui-features/index.html">gestion de reclamation</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/ui-features/index.html">gestion d utilisateur</a>
                  </li>
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <span class="menu-title">la page d'utilisateur</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-lock menu-icon"></i>
              </a>
              <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item">
                    <a class="nav-link" href="pages/samples/login.html"> se connecter</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/samples/register.html"> s'inscrire</a>
                  </li>
                </ul>
              </div>
            </li>
          </ul>
        </nav>
        
        <div class="form-container">
        <img src="assets/images/12.png" alt="Logo" class="floating-logo">
<h1>MODIFIER TRANSPORT</h1>

    <!-- Messages -->
    <?php if (!empty($successMessage)) echo "<div class='message success'>$successMessage</div>"; ?>
    <?php if (!empty($error)) echo "<div class='message error'>$error</div>"; ?>

    <!-- ID caché -->
    <form method="POST" action="?id_de_transport=<?= htmlspecialchars($id) ?>">
    <input type="hidden" name="id_de_transport" value="<?= htmlspecialchars($id) ?>">

   <?php
if ($transportActuel) {
    echo '<form method="POST" action="">';

    echo '<label for="nom_bapteme" style="font-family: \'Georgia\', serif; font-size: 18px; color: purple;">Nom du baptême:</label>';
    echo '<select id="nom_bapteme" name="nom_bapteme" required>';
    $nom_baptemes = [
        "Le Grand Voyageur",
        "Taureau d’Asphalte",
        "Vent Nomade",
        "Route d'Or",
        "Voyage Indigo",
        "Orion Prestige",
        "Monte-Carlo",
        "Galaxie Privée"
    ];
    foreach ($nom_baptemes as $nom) {
        $selected = ($transportActuel->getNomBapteme() === $nom) ? 'selected' : '';
        echo "<option value=\"$nom\" $selected>$nom</option>";
    }
    echo '</select><br>';

    echo '<label for="nbre_de_place" style="font-family: \'Georgia\', serif; font-size: 18px; color: purple;">Nombre de places:</label>';
    echo '<input type="number" id="nbre_de_place" name="nbre_de_place" min="4" max="8" required style="width: 60px;" value="' . htmlspecialchars($transportActuel->getNbreDePlace()) . '"><br>';

    echo '<label for="couleur" style="font-family: \'Georgia\', serif; font-size: 18px; color: purple;">Couleur:</label>';
    echo '<select id="couleur" name="couleur" required>';
    $couleurs = ["noir", "rouge", "bleu", "blanche", "gris"];
    foreach ($couleurs as $couleur) {
        $selected = ($transportActuel->getCouleur() === $couleur) ? 'selected' : '';
        echo "<option value=\"$couleur\" $selected>$couleur</option>";
    }
    echo '</select><br>';

    echo '<label for="marque" style="font-family: \'Georgia\', serif; font-size: 18px; color: purple;">Marque:</label>';
    echo '<select id="marque" name="marque" required>';
    $marques = ["Toyota", "Peugeot", "Renault", "Kia", "Hyundai", "Volkswagen", "Mercedes-Benz", "Audi"];
    foreach ($marques as $marque) {
        $selected = ($transportActuel->getMarque() === $marque) ? 'selected' : '';
        echo "<option value=\"$marque\" $selected>$marque</option>";
    }
    echo '</select><br>';

    echo '<label for="kilometrage" style="font-family: \'Georgia\', serif; font-size: 18px; color: purple;">Kilométrage:</label>';
    echo '<select id="kilometrage" name="kilometrage" required>';
    $kilometrages = [80000, 100000, 150000, 200000, 250000, 300000];
    foreach ($kilometrages as $km) {
        $selected = ($transportActuel->getKilometrage() == $km) ? 'selected' : '';
        echo "<option value=\"$km\" $selected>" . number_format($km, 0, ',', ' ') . " km</option>";
    }
    echo '</select><br>';

    echo '<div style="text-align: left;">';
    echo '<button type="submit" style="font-family: Georgia, serif; font-size: 16px; padding: 8px 16px;">';
    echo 'Mettre à jour';
    echo '</button>';
    echo '</div>';

    echo '</form>';
} else {
    echo '<p class="error">Impossible d\'afficher le formulaire. Aucun transport valide n’a été chargé.</p>';
}
?>

</form>

</body>
</html>
