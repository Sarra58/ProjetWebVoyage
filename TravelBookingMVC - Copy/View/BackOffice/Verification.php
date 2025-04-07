<?php
include_once("../../Model/TravelOffer.php");
include_once("../../Controller/TravelOfferC.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titre = $_POST['title'];
    $destination = $_POST['destination'];
    $date_depart = $_POST['departure'];
    $date_retour = $_POST['return'];
    $prix = $_POST['price'];
    $disponible = isset($_POST['Avaiblity']) ? 1 : 0;
    $categorie = $_POST['Category'];
    
    // Créer un nouvel objet TravelOffer
    $offre = new TravelOffer(null, $titre, $destination, $date_depart, $date_retour, $prix, $disponible, $categorie);
    
    // Instancier le controller
    $offerC = new TravelOfferC();
    
    // Ajouter l'offre dans la base de données
    $offerC->addOffre($offre);
    
    // Rediriger vers la liste des offres
    header('Location: listTravelOffers.php');
}
?>