<?php
include(__DIR__ . '/../../controller/TransportOfferController.php');

// Vérifier si l'ID est passé en paramètre GET
if (isset($_GET['id_de_transport']) && !empty($_GET['id_de_transport'])) {
    $id_de_transport = $_GET['id_de_transport'];
    echo "ID transport reçu : " . $id_de_transport; // Pour le test

    // Appeler la méthode de suppression
    $travelOfferC = new TransportController();
    $travelOfferC->deleteTransport($id_de_transport);

    // Redirection après suppression
    header('Location: TransportOfferList.php');
    exit;  // Toujours appeler exit après une redirection
} else {
    echo "❌ Aucun ID de transport valide trouvé dans l'URL.";
}
?>
