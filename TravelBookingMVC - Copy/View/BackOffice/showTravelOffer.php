<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Travel Offers</title>
</head>
<body>
    <?php
    session_start();
    include_once("../../Model/TravelOffer.php");
    include_once("../../Controller/TravelOfferController.php");

    $controller = new TravelOfferController();

    if (!empty($_SESSION['travelOffers'])) {
        foreach ($_SESSION['travelOffers'] as $offer) {
            $controller->showTravelOffer($offer);
        }
    } else {
        echo "<p>No travel offers available.</p>";
    }
    ?>
</body>
</html>

