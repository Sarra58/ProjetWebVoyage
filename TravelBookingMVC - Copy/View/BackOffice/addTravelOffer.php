<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Add travel offer</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <script src="addOffer.js"></script>

</head>

<body id="page-top">
   <div class="container-fluid">
    
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add a Travel Offer</h1>
    </div>

    <div class="card shadow mb-4">
      
    <form id="myForm" action="../../View/BackOffice/Verification.php" method="POST">
            <div class="mb-3">
                <label for="title" class="form-label">Title:</label>
                <input type="text" id="title" name="title" class="form-control" minlength="3" required>
                <p id="titlecondition">Title doit contenir au moins 3 caractères. </p>
            </div>

            <div class="mb-3">
                <label for="destination" class="form-label">Destination:</label>
                <input type="text" id="destination" name="destination" class="form-control" minlength="3" pattern="[A-Za-zÀ-ÖØ-öø-ÿ\s]{3,}" required>
                <p id="destinationcondition">La destination doit contenir uniquement des lettres et des espaces, et au moins 3 caractères.</p>
            </div>

            <div class="mb-3">
                <label for="departure" class="form-label">Departure Date:</label>
                <input type="date" id="departure" name="departure" class="form-control" required>
                <p id="departureCondition">Veuillez sélectionner une date valide</p>
            </div>

            <div class="mb-3">
                <label for="return" class="form-label">Return Date:</label>
                <input type="date" id="return" name="return" class="form-control" required>
                <p id="returnCondition">Veuillez sélectionner une date valide.</p>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label">Price ($):</label>
                <input type="number" id="price" name="price" class="form-control" min="0" step="0.01" required>
                <p id="priceCondition">Le prix doit être supérieur à 0.</p>
            </div>
            <div class="mb-3">
                <label for="Avaiblity" class="form-label">Avaiblity:</label>
                <input type="checkbox" id=Avaiblity name= "Avaiblity" >
            </div>
            <div class="mb-3">
                <label for="Category" class="form-label">Category:</label>
                <select id="Category" name="Category" class="form-select">
                <option value="Ad">Adventure</option>
            </select>
            </div>
            <div class="text-center">
            <button type="submit" class="btn btn-primary">Add Offer</button>
            </div>
            
            
        </form>
    </div>
</div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
   
</body>
</html>
