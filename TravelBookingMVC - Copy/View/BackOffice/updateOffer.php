<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Modifier une offre de voyage</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script src="addOffer.js"></script>
</head>
<body id="page-top">
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Modifier une offre de voyage</h1>
        </div>

        <div class="card shadow mb-4">
            <?php
            include_once("../../Controller/TravelOfferC.php");
            include_once("../../Model/TravelOffer.php");

            $offerC = new TravelOfferC();
            
            // Vérifier si l'ID est présent dans l'URL
            if (isset($_GET['id'])) {
                $offerId = $_GET['id'];
                $currentOffer = $offerC->getOfferById($offerId);
                
                if (!$currentOffer) {
                    echo "<div class='alert alert-danger'>Offre introuvable.</div>";
                    exit;
                }
            } else {
                echo "<div class='alert alert-danger'>ID non spécifié.</div>";
                exit;
            }

            // Traitement du formulaire de modification
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $titre = $_POST['title'];
                $destination = $_POST['destination'];
                $date_depart = $_POST['departure'];
                $date_retour = $_POST['return'];
                $prix = $_POST['price'];
                $disponible = isset($_POST['Avaiblity']) ? 1 : 0;
                $categorie = $_POST['Category'];
                
                $offer = new TravelOffer(null, $titre, $destination, $date_depart, $date_retour, $prix, $disponible, $categorie);
                $offerC->updateOffer($offer, $offerId);
                
                echo "<div class='alert alert-success'>L'offre a été mise à jour avec succès.</div>";
                echo "<script>setTimeout(function(){ window.location.href = 'listTravelOffers.php'; }, 2000);</script>";
            }
            ?>
            
            <form id="myForm" action="" method="POST">
                <div class="mb-3">
                    <label for="title" class="form-label">Titre:</label>
                    <input type="text" id="title" name="title" class="form-control" minlength="3" required 
                           value="<?php echo htmlspecialchars($currentOffer['titre']); ?>">
                    <p id="titlecondition">Titre doit contenir au moins 3 caractères.</p>
                </div>

                <div class="mb-3">
                    <label for="destination" class="form-label">Destination:</label>
                    <input type="text" id="destination" name="destination" class="form-control" minlength="3" 
                           pattern="[A-Za-zÀ-ÖØ-öø-ÿ\s]{3,}" required 
                           value="<?php echo htmlspecialchars($currentOffer['destination']); ?>">
                    <p id="destinationcondition">La destination doit contenir uniquement des lettres et des espaces, et au moins 3 caractères.</p>
                </div>

                <div class="mb-3">
                    <label for="departure" class="form-label">Date de départ:</label>
                    <input type="date" id="departure" name="departure" class="form-control" required 
                           value="<?php echo $currentOffer['date_depart']; ?>">
                    <p id="departureCondition">Veuillez sélectionner une date valide</p>
                </div>

                <div class="mb-3">
                    <label for="return" class="form-label">Date de retour:</label>
                    <input type="date" id="return" name="return" class="form-control" required 
                           value="<?php echo $currentOffer['date_retour']; ?>">
                    <p id="returnCondition">Veuillez sélectionner une date valide.</p>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label">Prix ($):</label>
                    <input type="number" id="price" name="price" class="form-control" min="0" step="0.01" required 
                           value="<?php echo $currentOffer['prix']; ?>">
                    <p id="priceCondition">Le prix doit être supérieur à 0.</p>
                </div>
                
                <div class="mb-3">
                    <label for="Avaiblity" class="form-label">Disponible:</label>
                    <input type="checkbox" id="Avaiblity" name="Avaiblity" 
                           <?php echo $currentOffer['disponible'] ? 'checked' : ''; ?>>
                </div>
                
                <div class="mb-3">
                    <label for="Category" class="form-label">Catégorie:</label>
                    <select id="Category" name="Category" class="form-select">
                        <option value="Ad" <?php echo ($currentOffer['categorie'] == 'Ad') ? 'selected' : ''; ?>>Adventure</option>
                        <option value="Family" <?php echo ($currentOffer['categorie'] == 'Family') ? 'selected' : ''; ?>>Family</option>
                        <option value="Couples" <?php echo ($currentOffer['categorie'] == 'Couples') ? 'selected' : ''; ?>>Couples</option>
                    </select>
                </div>
                
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Mettre à jour l'offre</button>
                    <a href="listTravelOffers.php" class="btn btn-secondary">Annuler</a>
                </div>
            </form>
        </div>
    </div>

    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="js/sb-admin-2.min.js"></script>
</body>
</html>