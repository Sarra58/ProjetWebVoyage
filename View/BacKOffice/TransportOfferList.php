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

    </style>
</head>
<body>

    <div class="container">
        <!-- En-tête motivant -->
        <header>
            <h1>Bienvenue dans la gestion des transports !</h1>
            <p>Un aperçu dynamique et motivant de vos offres de transport. Agissez maintenant pour faire une différence !</p>
        </header>

        <!-- Votre code PHP avec la table -->
        <div class="col-xl-12 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="table-responsive">
                            <table class="table table-bordered">
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
