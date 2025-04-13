<?php
require_once '../../Controller/userController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $userId = intval($_POST['id']);

    $controller = new UserController();
    if ($controller->deleteUser($userId)) {
        header('Location: index.php');
        exit;
    } else {
        echo "Erreur lors de la suppression.";
    }
} else {
    echo "Requête invalide.";
}
