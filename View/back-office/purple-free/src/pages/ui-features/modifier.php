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
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="../../assets/vendors/font-awesome/css/font-awesome.min.css" />
    <link rel="stylesheet" href="../../assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../../assets/images/favicon.png" />
  </head>
  
  <body>
   <div class="container-scroller">
  <div class="row p-0 m-0 proBanner" id="proBanner" style="background-color: black !important;">
    <div class="col-md-12 p-0 m-0">
      <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
        <div class="ps-lg-3">
          <div class="d-flex align-items-center justify-content-between">
            <p class="mb-0 font-weight-medium me-3 buy-now-text" style="color: white;">Free 24/7 customer support, updates, and more with this template!</p>
            <a href="https://www.bootstrapdash.com/product/purple-bootstrap-admin-template/" target="_blank" class="btn me-2 buy-now-btn border-0">Buy Now</a>
          </div>
        </div>
        <div class="d-flex align-items-center justify-content-between">
          <a href="https://www.bootstrapdash.com/product/purple-bootstrap-admin-template/"><i class="mdi mdi-home me-3 text-white"></i></a>
          <button id="bannerClose" class="btn border-0 p-0">
            <i class="mdi mdi-close text-white mr-0"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

    
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row" style="background-color: black;">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
          <a class="navbar-brand brand-logo-mini" href="index.html" style="background-color: black; color: white; padding: 10px;">
            <img src="logo.svg" alt="logo" />
          </a>
          
          <a class="navbar-brand brand-logo" href="index.html" style="background-color: black; padding: 10px;">
            <img src="logo.svg" alt="logo" />
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
                  <img src="../../assets/images/faces/face1.jpg" alt="image">
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
                    <img src="../../assets/images/faces/face4.jpg" alt="image" class="profile-pic">
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
                    <img src="../../assets/images/faces/face2.jpg" alt="image" class="profile-pic">
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
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar" style="background-color: black; color: white; padding: 20px;">
          <ul class="nav">
            <li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img src="../../assets/images/faces/face1.jpg" alt="profile" />
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
              <a class="nav-link" href="../../index.html">
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
                    <a class="nav-link" href="pages/ui-features/buttons.html">gestion de transport</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/ui-features/dropdowns.html">gestion de voyage </a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/ui-features/typography.html">gestion de sponsor</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/ui-features/typography.html">gestion de reservation</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="affichage.php">gestion de reclamation</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="pages/ui-features/typography.html">gestion d utilisateur</a>
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

        <form method="POST" id="validationForm">
    <div class="mb-3">
        <label for="sujet" class="form-label">Sujet</label>
        <input type="text" class="form-control" id="sujet" name="sujet" value="<?= htmlspecialchars($reclamation['sujet']) ?>">
        <span id="sujet_error" class="text-danger"></span>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" rows="4"><?= htmlspecialchars($reclamation['description']) ?></textarea>
        <span id="description_error" class="text-danger"></span>
    </div>

    <div class="mb-3">
        <label for="statut" class="form-label">Statut</label>
        <select class="form-control" id="statut" name="statut">
            <option value="">-- Choisir un statut --</option>
            <option value="ouvert" <?= $reclamation['statut'] == 'ouvert' ? 'selected' : '' ?>>Ouvert</option>
            <option value="en cours" <?= $reclamation['statut'] == 'en cours' ? 'selected' : '' ?>>En cours</option>
            <option value="fermer" <?= $reclamation['statut'] == 'fermer' ? 'selected' : '' ?>>Fermer</option>
        </select>
        <span id="statut_error" class="text-danger"></span>
    </div>

    <div class="mb-3">
        <label for="date_creation" class="form-label">Date de création</label>
        <input type="text" class="form-control" id="date_creation" name="date_creation" value="<?= htmlspecialchars($reclamation['date_creation']) ?>" disabled>
    </div>

    <div class="mb-3">
        <label for="date_fermeture" class="form-label">Date de fermeture</label>
        <input type="datetime-local" class="form-control" id="date_fermeture" name="date_fermeture" value="<?= htmlspecialchars($reclamation['date_fermeture']) ?>">
        <span id="date_fermeture_error" class="text-danger"></span>
    </div>

    <button type="submit" class="btn btn-primary">Mettre à jour</button>
</form>

<script>
    document.getElementById('validationForm').addEventListener('submit', function(event) {
        let isValid = true;

        // Efface les messages d'erreur précédents
        document.querySelectorAll('.text-danger').forEach(span => span.textContent = '');

        const sujet = document.getElementById('sujet').value.trim();
        const description = document.getElementById('description').value.trim();
        const statut = document.getElementById('statut').value;
        const dateCreation = document.getElementById('date_creation').value;
        const dateFermeture = document.getElementById('date_fermeture').value;

        // Validation Sujet
        if (!sujet) {
            document.getElementById('sujet_error').textContent = 'Le sujet est requis.';
            isValid = false;
        }

        // Validation Description
        if (!description) {
            document.getElementById('description_error').textContent = 'La description est requise.';
            isValid = false;
        }

        // Validation Statut
        if (!statut) {
            document.getElementById('statut_error').textContent = 'Le statut doit être sélectionné.';
            isValid = false;
        }

        // Validation Date de fermeture
        if (dateFermeture && dateCreation) {
            const fermeture = new Date(dateFermeture);
            const creation = new Date(dateCreation);
            if (fermeture < creation) {
                document.getElementById('date_fermeture_error').textContent = 'La date de fermeture ne peut pas être antérieure à la date de création.';
                isValid = false;
            }
        }

        if (!isValid) {
            event.preventDefault();
        }
    });
</script>

    <br><br><br><br>
    <div class="footer">
            Conception et Réalisation par GHANNEM Minyar
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
