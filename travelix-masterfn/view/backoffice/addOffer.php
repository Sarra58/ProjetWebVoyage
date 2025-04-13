<?php
require_once '../../controller/TravelOfferController.php';
require_once '../../Model/TravelOffer.php';

$travelOfferC = new TravelOfferController();
$destinations = $travelOfferC->getAllDestinations();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $offer = [
        'destination_id' => $_POST['destination_id'],
        'departure_date' => $_POST['departure_date'],
        'return_date' => $_POST['return_date'],
        'disponible' => isset($_POST['disponible']) ? 1 : 0,
        'category' => $_POST['category']
    ];
    
    $result = $travelOfferC->addOffer($offer);
    if ($result) {
        header('Location: offerList.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <?php include('partials/_navbar.php'); ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_sidebar.html -->
            <?php include('partials/_sidebar.php'); ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title"> Add New Offer </h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="offerList.php">Offers</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add Offer</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Add New Travel Offer</h4>
                                    <p class="card-description"> Enter the offer details below </p>
                                    <?php if ($travelOfferC->getError()): ?>
                                        <div class="alert alert-danger">
                                            <?php echo $travelOfferC->getError(); ?>
                                        </div>
                                    <?php endif; ?>
                                    <form class="forms-sample" method="POST" action="">
                                        <div class="form-group row">
                                            <label for="destination_id" class="col-sm-3 col-form-label">Destination</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="destination_id" name="destination_id" required>
                                                    <option value="">Select a destination</option>
                                                    <?php foreach ($destinations as $destination): ?>
                                                        <option value="<?php echo $destination['id']; ?>">
                                                            <?php echo htmlspecialchars($destination['name']); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="departure_date" class="col-sm-3 col-form-label">Departure Date</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" id="departure_date" name="departure_date" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="return_date" class="col-sm-3 col-form-label">Return Date</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" id="return_date" name="return_date" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="category" class="col-sm-3 col-form-label">Category</label>
                                            <div class="col-sm-9">
                                                <select class="form-control" id="category" name="category" required>
                                                    <option value="">Select a category</option>
                                                    <option value="summer">Summer</option>
                                                    <option value="winter">Winter</option>
                                                    <option value="spring">Spring</option>
                                                    <option value="autumn">Autumn</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-3 col-form-label">Availability</label>
                                            <div class="col-sm-9">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" name="disponible" checked>
                                                        Available
                                                        <i class="input-helper"></i>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-9 offset-sm-3">
                                                <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                                                <a href="offerList.php" class="btn btn-light">Cancel</a>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:partials/_footer.html -->
                <?php include('partials/_footer.php'); ?>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script>
        // Add client-side validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const departureDate = new Date(document.getElementById('departure_date').value);
            const returnDate = new Date(document.getElementById('return_date').value);
            const today = new Date();
            today.setHours(0, 0, 0, 0);

            if (departureDate < today) {
                e.preventDefault();
                alert('Departure date cannot be in the past');
                return;
            }

            if (returnDate <= departureDate) {
                e.preventDefault();
                alert('Return date must be after departure date');
                return;
            }
        });
    </script>
    <!-- End custom js for this page -->
</body>

</html> 