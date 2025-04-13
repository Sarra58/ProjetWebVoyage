<?php
require_once '../../controller/TravelOfferController.php';
require_once '../../Model/TravelOffer.php';

$travelOfferC = new TravelOfferController();
$offer = null;

if (isset($_POST['id'])) {
    $offer = $travelOfferC->showOffer($_POST['id']);
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $destination_id = $_POST['destination_id'];
    $reservation_id = $_POST['reservation_id'];
    $departure_date = new DateTime($_POST['departure_date']);
    $return_date = new DateTime($_POST['return_date']);
    $price = $_POST['price'];
    $disponible = isset($_POST['disponible']) ? 1 : 0;
    $category = $_POST['category'];

    $updatedOffer = new TravelOffer(
        $id,
        $title,
        $destination_id,
        $reservation_id,
        $departure_date,
        $return_date,
        $price,
        $disponible,
        $category
    );

    $travelOfferC->updateOffer($updatedOffer, $id);
    header('Location: offerList.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Update Travel Offer - Admin Dashboard</title>
        <!-- plugins:css -->
        <link rel="stylesheet" href="src/assets/vendors/mdi/css/materialdesignicons.min.css">
        <link rel="stylesheet" href="src/assets/vendors/ti-icons/css/themify-icons.css">
        <link rel="stylesheet" href="src/assets/vendors/css/vendor.bundle.base.css">
        <link rel="stylesheet" href="src/assets/vendors/font-awesome/css/font-awesome.min.css">
        <!-- endinject -->
        <!-- Plugin css for this page -->
        <!-- End Plugin css for this page -->
        <!-- inject:css -->
        <!-- endinject -->
        <!-- Layout styles -->
        <link rel="stylesheet" href="src/assets/css/style.css">
        <!-- End layout styles -->
        <link rel="shortcut icon" href="src/assets/images/favicon.png" />
    </head>
    <body>
        <div class="container-scroller">
            <div class="row p-0 m-0 proBanner" id="proBanner" style="background-color: black !important;">
                <div class="col-md-12 p-0 m-0">
                    <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
                        <div class="ps-lg-3">
                            <div class="d-flex align-items-center justify-content-between">
                                <p class="mb-0 font-weight-medium me-3 buy-now-text" style="color: white;">Travel Offers Management System</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- partial:partials/_navbar.html -->
            <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row" style="background-color: black;">
                <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
                    <a class="navbar-brand brand-logo-mini" href="index.html" style="background-color: black; color: white; padding: 10px;">
                        <img src="src/assets/images/logo.svg" alt="logo" />
                    </a>
                    <a class="navbar-brand brand-logo" href="index.html" style="background-color: black; padding: 10px;">
                        <img src="src/assets/images/logo.svg" alt="logo" />
                    </a>
                </div>
                <div class="navbar-menu-wrapper d-flex align-items-stretch">
                    <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
                        <span class="mdi mdi-menu"></span>
                    </button>
                    <div class="search-field d-none d-md-block">
                        <form class="d-flex align-items-center h-100" action="#">
                            <div class="input-group">
                                <div class="input-group-prepend bg-transparent">
                                    <i class="input-group-text border-0 mdi mdi-magnify"></i>
                                </div>
                                <input type="text" class="form-control bg-transparent border-0" placeholder="Search offers">
                            </div>
                        </form>
                    </div>
                    <ul class="navbar-nav navbar-nav-right">
                        <li class="nav-item nav-profile dropdown">
                            <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="nav-profile-img">
                                    <img src="src/assets/images/faces/face1.jpg" alt="image">
                                    <span class="availability-status online"></span>
                                </div>
                                <div class="nav-profile-text">
                                    <p class="mb-1 text-black">Admin</p>
                                </div>
                            </a>
                            <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="mdi mdi-cached me-2 text-success"></i> Activity Log </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">
                                    <i class="mdi mdi-logout me-2 text-primary"></i> Signout </a>
                            </div>
                        </li>
                        <li class="nav-item d-none d-lg-block full-screen-link">
                            <a class="nav-link">
                                <i class="mdi mdi-fullscreen" id="fullscreen-button"></i>
                            </a>
                        </li>
                    </ul>
                    <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
                        <span class="mdi mdi-menu"></span>
                    </button>
                </div>
            </nav>
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_sidebar.html -->
                <nav class="sidebar sidebar-offcanvas" id="sidebar">
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="index.html">
                                <i class="mdi mdi-home menu-icon"></i>
                                <span class="menu-title">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="offerList.php">
                                <i class="mdi mdi-airplane menu-icon"></i>
                                <span class="menu-title">Travel Offers</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="addTraveloffer.php">
                                <i class="mdi mdi-plus-circle menu-icon"></i>
                                <span class="menu-title">Add Offer</span>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- partial -->
                <div class="main-panel">
                    <div class="content-wrapper">
                        <div class="row">
                            <div class="col-12 grid-margin stretch-card">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title">Update Travel Offer</h4>
                                        <?php if ($offer): ?>
                                        <form class="forms-sample" method="POST" action="updateOffer.php">
                                            <input type="hidden" name="id" value="<?= $offer['id']; ?>">
                                            <div class="form-group">
                                                <label for="title">Title</label>
                                                <input type="text" class="form-control" id="title" name="title" value="<?= $offer['title']; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="destination_id">Destination ID</label>
                                                <input type="number" class="form-control" id="destination_id" name="destination_id" value="<?= $offer['destination_id']; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="reservation_id">Reservation ID</label>
                                                <input type="number" class="form-control" id="reservation_id" name="reservation_id" value="<?= $offer['reservation_id']; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="departure_date">Departure Date</label>
                                                <input type="date" class="form-control" id="departure_date" name="departure_date" value="<?= $offer['departure_date']; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="return_date">Return Date</label>
                                                <input type="date" class="form-control" id="return_date" name="return_date" value="<?= $offer['return_date']; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="price">Price (€)</label>
                                                <input type="number" class="form-control" id="price" name="price" value="<?= $offer['price']; ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="checkbox" class="form-check-input" name="disponible" <?= $offer['disponible'] ? 'checked' : ''; ?>> Available
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="category">Category</label>
                                                <input type="text" class="form-control" id="category" name="category" value="<?= $offer['category']; ?>" required>
                                            </div>
                                            <button type="submit" name="update" class="btn btn-primary me-2">Update</button>
                                            <a href="offerList.php" class="btn btn-light">Cancel</a>
                                        </form>
                                        <?php else: ?>
                                        <div class="alert alert-danger">
                                            No offer found with the provided ID.
                                        </div>
                                        <a href="offerList.php" class="btn btn-light">Back to List</a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- content-wrapper ends -->
                    <!-- partial:partials/_footer.html -->
                    <footer class="footer">
                        <div class="d-sm-flex justify-content-center justify-content-sm-between">
                            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2024. All rights reserved.</span>
                        </div>
                    </footer>
                    <!-- partial -->
                </div>
                <!-- main-panel ends -->
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->

        <!-- plugins:js -->
        <script src="src/assets/vendors/js/vendor.bundle.base.js"></script>
        <!-- endinject -->
        <!-- Plugin js for this page -->
        <script src="src/assets/vendors/chart.js/Chart.min.js"></script>
        <script src="src/assets/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
        <!-- End plugin js for this page -->
        <!-- inject:js -->
        <script src="src/assets/js/off-canvas.js"></script>
        <script src="src/assets/js/hoverable-collapse.js"></script>
        <script src="src/assets/js/misc.js"></script>
        <script src="src/assets/js/settings.js"></script>
        <script src="src/assets/js/todolist.js"></script>
        <!-- endinject -->
        <!-- Custom js for this page -->
        <script src="src/assets/js/dashboard.js"></script>
        <!-- End custom js for this page -->
    </body>
</html>
