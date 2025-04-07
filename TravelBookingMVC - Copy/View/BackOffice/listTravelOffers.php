<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des offres de voyage</title>
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body id="page-top">
    <div class="container-fluid">
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Liste des offres de voyage</h1>
            <a href="addTravelOffer.php" class="btn btn-primary btn-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Ajouter une offre
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Offres de voyage disponibles</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Titre</th>
                                <th>Destination</th>
                                <th>Date de départ</th>
                                <th>Date de retour</th>
                                <th>Prix</th>
                                <th>Disponible</th>
                                <th>Catégorie</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include_once("../../Controller/TravelOfferC.php");

                            $offerC = new TravelOfferC();
                            $listeOffres = $offerC->listOffre();

                            foreach($listeOffres as $offer) {
                            ?>
                            <tr>
                                <td><?php echo $offer['id']; ?></td>
                                <td><?php echo htmlspecialchars($offer['titre']); ?></td>
                                <td><?php echo htmlspecialchars($offer['destination']); ?></td>
                                <td><?php echo $offer['date_depart']; ?></td>
                                <td><?php echo $offer['date_retour']; ?></td>
                                <td><?php echo $offer['prix']; ?> TND</td>
                                <td><?php echo $offer['disponible'] ? 'Oui' : 'Non'; ?></td>
                                <td><?php echo htmlspecialchars($offer['categorie']); ?></td>
                                <td>
                                    <a href="updateOffer.php?id=<?php echo $offer['id']; ?>" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i> Modifier
                                    </a>
                                    <a href="deleteOffer.php?id=<?php echo $offer['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette offre?');">
                                        <i class="fas fa-trash"></i> Supprimer
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

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
</body>
</html>