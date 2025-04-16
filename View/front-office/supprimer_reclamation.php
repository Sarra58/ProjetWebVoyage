<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "my_database";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Check if ID is provided for deletion
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Prepare SQL query to delete the record
        $sql = "DELETE FROM Reclamation WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        // Redirect to the main page after deletion
        header("Location: http://localhost/projetWebMinyar/View/front-office/reclamations_affichage.php");
        exit();
    } else {
        echo "ID not specified for deletion.";
    }
    
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>