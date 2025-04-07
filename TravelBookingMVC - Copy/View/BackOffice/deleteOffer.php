<?php
include_once("../../Controller/TravelOfferC.php");

if (isset($_GET['id'])) {
    $offerC = new TravelOfferC();
    $offerC->deleteOffer($_GET['id']);
    header('Location: listTravelOffers.php');
} else {
    echo "ID non spécifié";
}
?>