<?php
include(__DIR__ . '/../../controller/TransportOfferController.php');
$travelOfferC = new TransportController();
$id = $_GET['id'] ?? null;

// On vérifie si un ID est passé en GET. Si c'est le cas, on affiche ce transport spécifique, sinon tous les transports.
if ($id !== null) {
    $transport = $travelOfferC->showTransport($id);
    $list = [$transport]; // On le met dans un tableau pour qu’il fonctionne dans le foreach
} else {
    $list = $travelOfferC->showAllTransports();
}

// Si $list est vide, afficher un message
if (empty($list)) {
    echo "Aucun transport disponible.";
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
     <!-- Required meta tags -->
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    <!-- plugins:css -->
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Transports</title>
    <style>
        /* Dégradé de fond orange et violet */
        body {
            background: linear-gradient(45deg, black, #8A2BE2); /* Dégradé entre orange et violet */
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            color: #fff;
            overflow-x: hidden;
        }

        /* Conteneur principal */
        .container {
            padding: 20px;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* En-tête */
        header {
            text-align: center;
            margin-bottom: 30px;
        }

        header h1 {
            font-size: 3rem;
            color: #fff;
        }

        header p {
            font-size: 1.2rem;
            color: #fff;
            margin-top: 10px;
        }

        /* Style de la table */
        table {
            width: 100%;
            border-collapse: collapse;
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }

        table th, table td {
            padding: 15px;
            text-align: center;
            font-size: 1rem;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        table th {
            background-color: rgba(255, 255, 255, 0.3);
        }

        /* Style des boutons dynamiques */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1rem;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .btn:hover {
            transform: scale(1.05);
        }

        .btn-primary {
            background-color: #FF7F50; /* Orange */
        }

        .btn-primary:hover {
            background-color: black;
        }

        .btn-danger {
            background-color: #8A2BE2; /* Violet */
        }

        .btn-danger:hover {
            background-color: #6A0DAD;
        }

        /* Formulaire */
        form {
            display: inline-block;
        }

        /* Animation du bouton motivant */
        .motivational-btn {
            background: black;
            padding: 15px 30px;
            border-radius: 50px;
            text-transform: uppercase;
            font-weight: bold;
            font-size: 1.2rem;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.2s ease;
        }

        .motivational-btn:hover {
            background: #8A2BE2;
            transform: scale(1.1);
        }

        .motivational-btn:focus {
            outline: none;
        }
        .custom-sidebar {
 background-color: black;
 color: white;
 padding: 20px;
margin-left: 20px;
 margin-top: 20px;
}
.custom-table {
 font-size: 0.8rem;
 width: 80%;
 margin-left: -20px; /* Décale la table à gauche */
}


.custom-table th,
.custom-table td {
 padding: 0.3rem 0.5rem;/* Réduit l’espace intérieur */
 white-space: nowrap;/* Empêche le retour à la ligne */
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

        <!-- Votre code PHP avec la table -->
        <div class="col-xl-12 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="table-responsive">
                        <table class="table table-bordered table-sm custom-table">

                                <thead>
                                    <tr>
                                        <th>id_de_transport</th>
                                        <th>Nom_Bapteme</th>
                                        <th>Nbre_de_place</th>
                                        <th>Couleur</th>
                                        <th>Marque</th>
                                        <th>Kilometrage</th>
                                        <th colspan="2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Affichage de la liste des transports
                                    foreach ($list as $transport) {
                                        // Échapper les données pour prévenir les attaques XSS
                                        $id_de_transport = htmlspecialchars($transport['id_de_transport']);
                                        $nom_bapteme = htmlspecialchars($transport['nom_bapteme']);
                                        $nbre_de_place = htmlspecialchars($transport['nbre_de_place']);
                                        $couleur = htmlspecialchars($transport['couleur']);
                                        $marque = htmlspecialchars($transport['marque']);
                                        $kilometrage = htmlspecialchars($transport['kilometrage']);
                                    ?>
                                        <tr>
                                            <td><?= $id_de_transport; ?></td>
                                            <td><?= $nom_bapteme; ?></td>
                                            <td><?= $nbre_de_place; ?></td>
                                            <td><?= $couleur; ?></td>
                                            <td><?= $marque; ?></td>
                                            <td><?= $kilometrage; ?></td>
                                            <td align="center">
                                                <!-- Formulaire pour mettre à jour le transport -->
                                                <form method="POST" action="UpdateTransportOffer.php" style="display:inline;">
                                                    <input type="hidden" name="id_de_transport" value="<?= $id_de_transport; ?>">
                                                    <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                                </form>
                                            </td>
                                            <td>
                                                <!-- Lien pour supprimer le transport -->
                                                <a href="DeleteTransportOffer.php?id_de_transport=<?= $id_de_transport; ?>" 
   class="btn btn-danger btn-sm" 
   onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce transport ?');">
   Delete
</a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bouton motivant -->
        <div class="text-center mt-4">
            <button class="motivational-btn" onclick="alert('Prenez action maintenant!')">Prenez action maintenant!</button>
        </div>

    </div>

    <!-- JavaScript pour les actions dynamiques -->
    <script>
        // Exemple d'effet dynamique pour un bouton motivant
        document.querySelector('.motivational-btn').addEventListener('click', function () {
            alert('Vous avez cliqué sur un bouton motivant !');
        });
    </script>

</body>
</html>
