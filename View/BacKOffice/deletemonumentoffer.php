<?php
include(__DIR__ . '/../../controller/MonumentOfferController.php');

// Vérifier si l'ID est passé en paramètre GET
if (isset($_GET['id_monument']) && !empty($_GET['id_monument'])) {
    $id_monument = $_GET['id_monument'];
    echo "ID monument reçu : " . $id_monument; // Pour le test

    // Appeler la méthode de suppression
    $monumentController = new MonumentController();
    $monumentController->deleteMonument($id_monument);

    // Redirection après suppression
    header('Location:TransportOfferList.php');
    exit;  // Toujours appeler exit après une redirection
} else {
    echo "❌ Aucun ID de monument valide trouvé dans l'URL.";
}
?>
