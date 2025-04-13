<?php
require_once '../../controller/TravelOfferController.php';

$travelOfferC = new TravelOfferController();
$message = '';
$voyages = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete_voyage'])) {
        $email = $_POST['email'];
        $voyage_id = $_POST['voyage_id'];
        
        if ($travelOfferC->deleteVoyageByEmailAndId($email, $voyage_id)) {
            $message = '<div class="alert alert-success">Votre réservation a été annulée avec succès.</div>';
        } else {
            $message = '<div class="alert alert-danger">' . $travelOfferC->getError() . '</div>';
        }
    }
    
    if (isset($_POST['update_voyage'])) {
        $email = $_POST['email'];
        $voyage_id = $_POST['voyage_id'];
        $departure_date = $_POST['departure_date'];
        $return_date = $_POST['return_date'];
        
        if ($travelOfferC->updateVoyageByEmailAndId($email, $voyage_id, $departure_date, $return_date)) {
            $message = '<div class="alert alert-success">Votre réservation a été mise à jour avec succès.</div>';
        } else {
            $message = '<div class="alert alert-danger">' . $travelOfferC->getError() . '</div>';
        }
    }
    
    if (isset($_POST['search_voyages'])) {
        $email = $_POST['email'];
        $voyages = $travelOfferC->getUserVoyages($email);
        if (empty($voyages)) {
            $message = '<div class="alert alert-info">Aucune réservation trouvée pour cet email.</div>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Mes Voyages - Tripster</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Projet Tripster">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="styles/bootstrap4/bootstrap.min.css">
    <link href="plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="styles/contact_styles.css">
    <link rel="stylesheet" type="text/css" href="styles/contact_responsive.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        
        .search-form {
            background: #ffffff;
            padding: 40px;
            border-radius: 15px;
            margin: 30px 0;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .voyage-card {
            background: #fff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            margin-bottom: 30px;
        }

        .voyage-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .voyage-content {
            padding: 25px;
        }

        .voyage-title {
            font-size: 24px;
            font-weight: 600;
            color: #2d2c2c;
            margin-bottom: 15px;
        }

        .voyage-info {
            color: #666;
            margin-bottom: 20px;
        }

        .voyage-dates {
            display: flex;
            justify-content: space-between;
            margin-bottom: 15px;
            color: #555;
        }

        .voyage-price {
            font-size: 20px;
            font-weight: 600;
            color: #fa9e1b;
            margin-bottom: 20px;
        }

        .btn-delete {
            background: #dc3545;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-delete:hover {
            background: #c82333;
            transform: translateY(-2px);
        }

        .alert {
            border-radius: 10px;
            padding: 15px 20px;
            margin-bottom: 25px;
        }

        .btn-edit {
            background: #fa9e1b;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            transition: all 0.3s ease;
            margin-right: 10px;
        }

        .btn-edit:hover {
            background: #e88f0c;
            transform: translateY(-2px);
        }

        .modal-content {
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .modal-header {
            background: #fa9e1b;
            color: white;
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }

        .modal-title {
            font-weight: 600;
        }

        .modal-body {
            padding: 25px;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="super_container">
        <!-- Header -->
        <header class="header">
            <!-- Top Bar -->
            <div class="top_bar">
                <div class="container">
                    <div class="row">
                        <div class="col d-flex flex-row">
                            <div class="phone">+45 345 3324 56789</div>
                            <div class="social">
                                <ul class="social_list">
                                    <li class="social_list_item"><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                                    <li class="social_list_item"><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                    <li class="social_list_item"><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                    <li class="social_list_item"><a href="#"><i class="fa fa-dribbble" aria-hidden="true"></i></a></li>
                                    <li class="social_list_item"><a href="#"><i class="fa fa-behance" aria-hidden="true"></i></a></li>
                                    <li class="social_list_item"><a href="#"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                                </ul>
                            </div>
                            <div class="user_box ml-auto">
                                <div class="user_box_login user_box_link"><a href="#">connexion</a></div>
                                <div class="user_box_register user_box_link"><a href="#">s'inscrire</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Navigation -->
            <nav class="main_nav">
                <div class="container">
                    <div class="row">
                        <div class="col main_nav_col d-flex flex-row align-items-center justify-content-start">
                            <div class="logo_container">
                                <div class="logo"><a href="#"><img src="images/logotripster.png" alt="Logo Tripster" height="200px" width="200px"></a></div>
                            </div>
                            <div class="main_nav_container ml-auto">
                                <ul class="main_nav_list">
                                    <li class="main_nav_item"><a href="index.html">accueil</a></li>
                                    <li class="main_nav_item"><a href="about.html">à propos</a></li>
                                    <li class="main_nav_item"><a href="offers.html">offres</a></li>
                                    <li class="main_nav_item"><a href="blog.html">actualités</a></li>
                                    <li class="main_nav_item"><a href="voyage.php">voyage</a></li>
                                    <li class="main_nav_item"><a href="mes-voyages.php">mes voyages</a></li>
                                    <li class="main_nav_item"><a href="offerList.html">admin</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>

        <div class="menu trans_500">
            <div class="menu_content d-flex flex-column align-items-center justify-content-center text-center">
                <div class="menu_close_container"><div class="menu_close"></div></div>
                <div class="logo"><a href="#"><img src="images/logotripster.png" alt="Logo Tripster" height="125px" width="125px"></a></div>
                <ul>
                    <li class="menu_item"><a href="index.html">accueil</a></li>
                    <li class="menu_item"><a href="about.html">à propos</a></li>
                    <li class="menu_item"><a href="offers.html">offres</a></li>
                    <li class="menu_item"><a href="blog.html">actualités</a></li>
                    <li class="menu_item"><a href="voyage.php">voyage</a></li>
                    <li class="menu_item"><a href="mes-voyages.php">mes voyages</a></li>
                    <li class="menu_item"><a href="offerList.php">admin</a></li>
                </ul>
            </div>
        </div>

        <!-- Home -->
        <div class="home">
            <div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/contact_background.jpg"></div>
            <div class="home_content">
                <div class="home_title">Mes Voyages</div>
            </div>
        </div>

        <div class="container" style="margin-top: 200px;">
            <h2 class="text-center mb-4">Gérer Mes Réservations</h2>
            
            <div class="search-form">
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="email">Entrez votre email pour voir vos réservations</label>
                        <input type="email" class="form-control" id="email" name="email" required 
                               value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
                    </div>
                    <button type="submit" name="search_voyages" class="btn btn-primary">Rechercher</button>
                </form>
            </div>

            <?php echo $message; ?>

            <div class="row">
                <?php foreach ($voyages as $voyage): ?>
                    <div class="col-md-6">
                        <div class="voyage-card">
                            <img src="/travelix-masterfn/dest/images/<?php echo htmlspecialchars($voyage['image']); ?>" 
                                 alt="<?php echo htmlspecialchars($voyage['destination_name']); ?>" 
                                 class="voyage-image">
                            <div class="voyage-content">
                                <h3 class="voyage-title"><?php echo htmlspecialchars($voyage['destination_name']); ?></h3>
                                <div class="voyage-info">
                                    <div class="voyage-dates">
                                        <span>Départ: <?php echo date('d/m/Y', strtotime($voyage['departure_date'])); ?></span>
                                        <span>Retour: <?php echo date('d/m/Y', strtotime($voyage['return_date'])); ?></span>
                                    </div>
                                    <div>Durée: <?php echo $voyage['duration']; ?> jours</div>
                                </div>
                                <div class="voyage-price">
                                    Prix total: <?php echo number_format($voyage['total_price'], 0, ',', ' '); ?>€
                                </div>
                                <div class="action-buttons">
                                    <button type="button" class="btn btn-edit" data-toggle="modal" 
                                            data-target="#editModal<?php echo $voyage['id']; ?>">
                                        <i class="fa fa-edit"></i> Modifier
                                    </button>
                                    <form method="POST" action="" style="display: inline;" 
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?');">
                                        <input type="hidden" name="email" value="<?php echo htmlspecialchars($_POST['email']); ?>">
                                        <input type="hidden" name="voyage_id" value="<?php echo $voyage['id']; ?>">
                                        <button type="submit" name="delete_voyage" class="btn btn-delete">
                                            <i class="fa fa-trash"></i> Annuler la réservation
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Add Modal for each voyage -->
                    <div class="modal fade" id="editModal<?php echo $voyage['id']; ?>" tabindex="-1" role="dialog" 
                         aria-labelledby="editModalLabel<?php echo $voyage['id']; ?>" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel<?php echo $voyage['id']; ?>">
                                        Modifier la réservation - <?php echo htmlspecialchars($voyage['destination_name']); ?>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form method="POST" action="">
                                        <input type="hidden" name="email" value="<?php echo htmlspecialchars($_POST['email']); ?>">
                                        <input type="hidden" name="voyage_id" value="<?php echo $voyage['id']; ?>">
                                        
                                        <div class="form-group">
                                            <label for="departure_date<?php echo $voyage['id']; ?>">Nouvelle date de départ</label>
                                            <input type="date" class="form-control" id="departure_date<?php echo $voyage['id']; ?>" 
                                                   name="departure_date" required value="<?php echo $voyage['departure_date']; ?>">
                                        </div>
                                        
                                        <div class="form-group">
                                            <label for="return_date<?php echo $voyage['id']; ?>">Nouvelle date de retour</label>
                                            <input type="date" class="form-control" id="return_date<?php echo $voyage['id']; ?>" 
                                                   name="return_date" required value="<?php echo $voyage['return_date']; ?>">
                                        </div>
                                        
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                            <button type="submit" name="update_voyage" class="btn btn-primary">Mettre à jour</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <!-- Include your footer here -->
    </div>

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="styles/bootstrap4/popper.js"></script>
    <script src="styles/bootstrap4/bootstrap.min.js"></script>
    <script>
    $(document).ready(function() {
        // Set minimum date for departure and return dates
        var today = new Date().toISOString().split('T')[0];
        $('input[type="date"]').attr('min', today);
        
        // Update return date min value when departure date changes
        $('input[name="departure_date"]').change(function() {
            var modalId = $(this).closest('.modal').attr('id');
            $('#' + modalId + ' input[name="return_date"]').attr('min', $(this).val());
        });
    });
    </script>
</body>
</html> 