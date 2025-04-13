<?php
include(__DIR__ . '/../config.php');
include(__DIR__ . '/../Model/TravelOffer.php');

class TravelOfferController
{
    private $conn;
    private $error = "";
    private $success = "";

    public function __construct() {
        $host = '127.0.0.1';
        $dbname = 'atelierphp';
        $username = 'root';
        $password = '';

        try {
            $this->conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    public function listOffre()
    {
        $sql = "SELECT v.*, d.name as destination_name 
                FROM voyage v 
                JOIN destination d ON v.destination_id = d.id";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            $offers = [];
            while ($row = $liste->fetch()) {
                $departure = new DateTime($row['departure_date']);
                $return = new DateTime($row['return_date']);
                $interval = $departure->diff($return);
                $row['duration'] = $interval->days;
                $offers[] = $row;
            }
            return $offers;
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function getAllDestinations()
    {
        $sql = "SELECT * FROM destination";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste->fetchAll();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function getDestinationsByCategory($category)
    {
        $sql = "SELECT * FROM destination WHERE category = :category";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['category' => $category]);
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function getDestinationById($id)
    {
        $sql = "SELECT * FROM destination WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id' => $id]);
            return $query->fetch();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    public function getDestinationCard($destination)
    {
        $imagePath = '/travelix-masterfn/dest/images/' . $destination['image'];
        $price = number_format($destination['price'], 0, ',', ' ');
        
        return '
        <div class="col-md-6 mb-4">
            <div class="destination-card" data-destination-id="' . $destination['id'] . '">
                <img src="' . $imagePath . '" alt="' . htmlspecialchars($destination['name']) . '" class="destination-image">
                <div class="destination-content">
                    <h3>' . htmlspecialchars($destination['name']) . '</h3>
                    <p class="description">' . htmlspecialchars($destination['description']) . '</p>
                    <div class="destination-footer">
                        <span class="category">' . htmlspecialchars($destination['category']) . '</span>
                        <span class="price">' . $price . '€ / jour</span>
                    </div>
                </div>
            </div>
        </div>';
    }

    public function getAllDestinationCards()
    {
        $destinations = $this->getAllDestinations();
        $html = '';
        foreach ($destinations as $destination) {
            $html .= $this->getDestinationCard($destination);
        }
        return $html;
    }

    public function getDestinationCardsByCategory($category)
    {
        $destinations = $this->getDestinationsByCategory($category);
        $html = '';
        foreach ($destinations as $destination) {
            $html .= $this->getDestinationCard($destination);
        }
        return $html;
    }

    function deleteOffer($id)
    {
        $sql = "DELETE FROM voyage WHERE id = :id";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id', $id);

        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error:' . $e->getMessage());
        }
    }

    function addOffer($offer)
    {
        $sql = "INSERT INTO voyage (destination_id, reservation_id, departure_date, return_date, price, disponible, category) 
                VALUES (:destination_id, :reservation_id, :departure_date, :return_date, :price, :disponible, :category)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'destination_id' => $offer->getDestinationId(),
                'reservation_id' => $offer->getReservationId(),
                'departure_date' => $offer->getDepartureDate()->format('Y-m-d'),
                'return_date' => $offer->getReturnDate()->format('Y-m-d'),
                'price' => $offer->getPrice(),
                'disponible' => $offer->isDisponible() ? 1 : 0,
                'category' => $offer->getCategory()
            ]);
        } catch (Exception $e) {
            echo 'Error: ' . $e->getMessage();
        }
    }

    function updateOffer($offer, $id)
    {
        try {
            $db = config::getConnexion();
            $query = $db->prepare(
                'UPDATE voyage SET 
                    destination_id = :destination_id,
                    reservation_id = :reservation_id,
                    departure_date = :departure_date,
                    return_date = :return_date,
                    price = :price,
                    disponible = :disponible,
                    category = :category
                WHERE id = :id'
            );

            $query->execute([
                'id' => $id,
                'destination_id' => $offer->getDestinationId(),
                'reservation_id' => $offer->getReservationId(),
                'departure_date' => $offer->getDepartureDate()->format('Y-m-d'),
                'return_date' => $offer->getReturnDate()->format('Y-m-d'),
                'price' => $offer->getPrice(),
                'disponible' => $offer->isDisponible() ? 1 : 0,
                'category' => $offer->getCategory()
            ]);

            echo $query->rowCount() . " records UPDATED successfully <br>";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    function showOffer($id)
    {
        $sql = "SELECT v.*, d.name as destination_name 
                FROM voyage v 
                JOIN destination d ON v.destination_id = d.id 
                WHERE v.id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':id', $id);
            $query->execute();
            $offer = $query->fetch();
            return $offer;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function handleBooking() {
        if (isset($_POST['submit_booking'])) {
            $errors = [];
            
            if (empty($_POST['email'])) {
                $errors[] = "L'adresse email est requise.";
            } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = "L'adresse email n'est pas valide.";
            }
            
            if (empty($_POST['departure_date'])) {
                $errors[] = "La date de départ est requise.";
            }
            
            if (empty($_POST['return_date'])) {
                $errors[] = "La date de retour est requise.";
            }
            
            if (empty($_POST['destination_id'])) {
                $errors[] = "Veuillez sélectionner une destination.";
            }
            
            if (!empty($_POST['departure_date']) && !empty($_POST['return_date'])) {
                $departure_date = new DateTime($_POST['departure_date']);
                $return_date = new DateTime($_POST['return_date']);
                $today = new DateTime();
                
                if ($departure_date < $today) {
                    $errors[] = "La date de départ ne peut pas être dans le passé.";
                }
                
                if ($return_date <= $departure_date) {
                    $errors[] = "La date de retour doit être postérieure à la date de départ.";
                }
            }
            
            if (empty($errors)) {
                try {
                    // Commencer une transaction
                    $this->conn->beginTransaction();
                    
                    // 1. Insérer la réservation
                    $stmt = $this->conn->prepare("INSERT INTO reservation (email) VALUES (?)");
                    $stmt->execute([$_POST['email']]);
                    $reservation_id = $this->conn->lastInsertId();
                    
                    // 2. Insérer le voyage
                    $destination_id = $_POST['destination_id'];
                    $departure_date = $_POST['departure_date'];
                    $return_date = $_POST['return_date'];
                    
                    // Récupérer le prix de la destination
                    $destination = $this->getDestinationById($destination_id);
                    $price = $destination['price'];
                    
                    $stmt = $this->conn->prepare("INSERT INTO voyage (destination_id, reservation_id, departure_date, return_date, price, disponible, category) 
                                             VALUES (?, ?, ?, ?, ?, 1, ?)");
                    $stmt->execute([
                        $destination_id,
                        $reservation_id,
                        $departure_date,
                        $return_date,
                        $price,
                        $destination['category']
                    ]);
                    
                    // Valider la transaction
                    $this->conn->commit();
                    
                    // Calculer le nombre de jours et le prix total
                    $interval = (new DateTime($departure_date))->diff(new DateTime($return_date));
                    $days = $interval->days;
                    $total_price = $price * $days;
                    
                    $this->success = "Votre réservation a été enregistrée avec succès !<br>
                                   Destination: " . $destination['name'] . "<br>
                                   Prix total: " . number_format($total_price, 0, ',', ' ') . "€ pour " . $days . " jours.";
                    
                } catch(PDOException $e) {
                    // En cas d'erreur, annuler la transaction
                    $this->conn->rollBack();
                    $errors[] = "Une erreur est survenue lors de l'enregistrement de votre réservation. Veuillez réessayer.";
                }
            }
            
            if (!empty($errors)) {
                $this->error = implode("<br>", $errors);
            }
        }
    }

    public function getError() {
        return $this->error;
    }

    public function getSuccess() {
        return $this->success;
    }

    public function deleteVoyageByEmailAndId($email, $voyage_id) {
        try {
            // First verify if the voyage belongs to the email
            $sql = "SELECT v.id 
                   FROM voyage v 
                   JOIN reservation r ON v.reservation_id = r.id 
                   WHERE v.id = :voyage_id AND r.email = :email";
            
            $query = $this->conn->prepare($sql);
            $query->execute([
                'voyage_id' => $voyage_id,
                'email' => $email
            ]);
            
            if ($query->rowCount() > 0) {
                // If found, delete the voyage
                $this->conn->beginTransaction();
                
                // Delete the voyage first
                $deleteVoyage = $this->conn->prepare("DELETE FROM voyage WHERE id = :voyage_id");
                $deleteVoyage->execute(['voyage_id' => $voyage_id]);
                
                // Then delete the associated reservation
                $deleteReservation = $this->conn->prepare("DELETE FROM reservation WHERE email = :email AND id IN (SELECT reservation_id FROM voyage WHERE id = :voyage_id)");
                $deleteReservation->execute([
                    'email' => $email,
                    'voyage_id' => $voyage_id
                ]);
                
                $this->conn->commit();
                $this->success = "Votre réservation a été annulée avec succès.";
                return true;
            } else {
                $this->error = "Aucune réservation trouvée avec cet email et cet identifiant.";
                return false;
            }
        } catch(PDOException $e) {
            if ($this->conn->inTransaction()) {
                $this->conn->rollBack();
            }
            $this->error = "Une erreur est survenue lors de l'annulation de la réservation.";
            return false;
        }
    }

    public function getUserVoyages($email) {
        $sql = "SELECT v.*, d.name as destination_name, d.image, d.category 
                FROM voyage v 
                JOIN reservation r ON v.reservation_id = r.id 
                JOIN destination d ON v.destination_id = d.id 
                WHERE r.email = :email 
                ORDER BY v.departure_date";
        
        try {
            $query = $this->conn->prepare($sql);
            $query->execute(['email' => $email]);
            $voyages = [];
            while ($row = $query->fetch()) {
                // Calculate duration and total price
                $departure = new DateTime($row['departure_date']);
                $return = new DateTime($row['return_date']);
                $interval = $departure->diff($return);
                $row['duration'] = $interval->days;
                $row['total_price'] = $row['price'] * $row['duration'];
                $voyages[] = $row;
            }
            return $voyages;
        } catch(PDOException $e) {
            $this->error = "Une erreur est survenue lors de la récupération de vos réservations.";
            return [];
        }
    }

    public function updateVoyageByEmailAndId($email, $voyage_id, $departure_date, $return_date) {
        try {
            $departure = new DateTime($departure_date);
            $return = new DateTime($return_date);
            
            if ($departure > $return) {
                $this->error = "La date de retour doit être postérieure à la date de départ.";
                return false;
            }
            
            if ($departure < new DateTime()) {
                $this->error = "La date de départ ne peut pas être dans le passé.";
                return false;
            }

            // Calculate new duration and total price
            $duration = $departure->diff($return)->days;
            
            // Get the base price from the destination
            $sql = "SELECT d.price FROM voyage v 
                    JOIN destination d ON v.destination_id = d.id 
                    JOIN reservation r ON v.reservation_id = r.id
                    WHERE v.id = :voyage_id AND r.email = :email";
            
            $stmt = $this->conn->prepare($sql);
            $stmt->execute(['voyage_id' => $voyage_id, 'email' => $email]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (!$result) {
                $this->error = "Réservation non trouvée.";
                return false;
            }
            
            $total_price = $result['price'] * $duration;

            // Update the voyage
            $sql = "UPDATE voyage v
                    JOIN reservation r ON v.reservation_id = r.id
                    SET v.departure_date = :departure_date,
                        v.return_date = :return_date,
                        v.total_price = :total_price
                    WHERE v.id = :voyage_id AND r.email = :email";
                    
            $stmt = $this->conn->prepare($sql);
            $success = $stmt->execute([
                'departure_date' => $departure_date,
                'return_date' => $return_date,
                'total_price' => $total_price,
                'voyage_id' => $voyage_id,
                'email' => $email
            ]);
            
            if (!$success) {
                $this->error = "Erreur lors de la mise à jour de la réservation.";
                return false;
            }
            
            return true;
        } catch (Exception $e) {
            $this->error = "Une erreur est survenue lors de la mise à jour: " . $e->getMessage();
            return false;
        }
    }
}
