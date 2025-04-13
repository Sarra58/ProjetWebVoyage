<?php
require_once __DIR__ . '/../Model/user.php'; // Utilisation de __DIR__ pour obtenir le répertoire actuel du fichier
require_once __DIR__ . '/../config.php';

class UserController
{
    private $table = 'user'; // Define table name

    // LIST ALL USERS //Affichage fil back
    public function listUser()
    {
        $sql = "SELECT * FROM {$this->table}";
        $db = config::getConnexion();
        try {
            echo "Connexion réussie"; // Débogage de la connexion
            $query = $db->query($sql);
            return $query->fetchAll(PDO::FETCH_ASSOC); // Retourne un tableau associatif
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    
    
    // DELETE USER
    public function deleteUser($id)
    {
        $sql = "DELETE FROM {$this->table} WHERE id= :id";
        $db = config::getConnexion();
        try {
            $req = $db->prepare($sql);
            $req->bindValue(':id', $id);
            $req->execute();
            return true; // Return true if delete is successful
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
    public function deleteUser1($email)
    {
        $sql = "DELETE FROM {$this->table} WHERE email = :email";
        $db = config::getConnexion();
        try {
            $req = $db->prepare($sql);
            $req->bindValue(':email', $email);
            $req->execute();
            return true; // Return true if delete is successful
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
        

    // ADD USER
    public function addUser(User $user): void
    {
        $sql = "INSERT INTO {$this->table} (nom, email, password, role) VALUES (:nom, :email, :password, :role)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'nom' => $user->getName(),
                'email' => $user->getEmail(),
                'password' => $user->getPassword(),
                'role' => $user->getRole(),
            ]);
        } catch (Exception $e) {
            error_log($e->getMessage());
            throw new Exception('An error occurred while adding the user.');
        }
    }

    // CHECK IF EMAIL EXISTS //Vous avez déja un compte
    public function checkEmailExists(string $email, ?int $excludeId = null): bool
    {
        $sql = "SELECT COUNT(*) FROM {$this->table} WHERE email = :email";
        if ($excludeId) {
            $sql .= " AND id!= :exclude_id";
        }

        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue('email', $email);
            if ($excludeId) {
                $query->bindValue('exclude_id', $excludeId);
            }
            $query->execute();
            $count = $query->fetchColumn();
            return $count > 0; // True if email exists
        } catch (Exception $e) {
            error_log($e->getMessage());
            throw new Exception('Error checking email: ' . $e->getMessage());
        }
    }
   
    
    // UPDATE USER
    public function updateUser(User $user, $id)
    {
        $sql = "UPDATE {$this->table} SET nom = :nom, prenom = :prenom, email = :email, tel = :tel, role = :role WHERE id = :id";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $id,
                'nom' => $user->getName(),
                'prenom' => $user->getPrenom(),
                'email' => $user->getEmail(),
                'tel' => $user->getTel(),
                'role' => $user->getRole()
            ]);
            echo $query->rowCount() . " record(s) updated successfully.";
        } catch (PDOException $e) {
            error_log($e->getMessage());
            echo 'An error occurred while updating the user.';
        }
    }
    public function updateUser1(User $user, $email)
{
    $db = config::getConnexion();

    // Récupère l'ancien rôle basé sur l'ancien email
    $stmt = $db->prepare("SELECT role FROM user WHERE email = :oldemail");
    $stmt->execute(['oldemail' => $email]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $role = $result['role'] ?? 'user'; // Valeur par défaut 'user' si le rôle n'est pas trouvé

    // Met à jour les informations, en gardant le rôle intact
    $sql = "UPDATE user SET nom = :nom, prenom = :prenom, email = :email, tel = :tel, role = :role WHERE email = :oldemail";
    try {
        $query = $db->prepare($sql);
        $query->execute([
            'nom' => $user->getName(),
            'prenom' => $user->getPrenom(),
            'email' => $user->getEmail(),
            'oldemail' => $email,
            'tel' => $user->getTel(),
            'role' => 'user'  // On force le rôle à "user"
        ]);
        echo $query->rowCount() . " record(s) updated successfully.";
    } catch (PDOException $e) {
        error_log($e->getMessage());
        echo 'An error occurred while updating the user.';
    }
}


    
    // GET USER DETAILS BY ID //Recherche d'un utilisateur
    public function getUserById($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id= :id";
        $db = config::getConnexion();
        try {
            $req = $db->prepare($sql);
            $req->bindValue(':id', $id);
            $req->execute();
            return $req->fetch(); // Return user data
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    // CHECK USER LOGIN //Connexion
    public function checkUserLogin($email, $password) {
        $sql = "SELECT * FROM {$this->table} WHERE email = :email";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->bindValue(':email', $email);
            $query->execute();
            $user = $query->fetch(PDO::FETCH_ASSOC);
    
            // If user doesn't exist
            if (!$user) {
                return "Error: No user found with this email address.";
            }
    
            // Check if the password matches (Assuming the password is hashed in the database)
            if (password_verify($password, $user['password'])) {
                // Successful login, return true or success message
                return "Login successful!";
            } else {
                return "Error: Incorrect password.";
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return "Error: " . $e->getMessage();
        }
    }
    // Add this method to fetch user by email//Recherche par mail 
public function getUserByEmail1($email)
{
    $sql = "SELECT * FROM {$this->table} WHERE email = :email";
    $db = config::getConnexion();
    try {
        $req = $db->prepare($sql);
        $req->bindValue(':email', $email);
        $req->execute();
        return $req->fetch(); // Return user data
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}
public function getUserByEmail($email)
{
    $sql = "SELECT * FROM user WHERE email = :email";
    $db = config::getConnexion();

    try {
        $query = $db->prepare($sql);
        $query->bindParam(':email', $email);
        $query->execute();

        return $query->fetch(PDO::FETCH_ASSOC); // Un seul utilisateur (ou false)
    } catch (Exception $e) {
        die('Error: ' . $e->getMessage());
    }
}

    
}    