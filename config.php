<?php  
class Config {
    private static $pdo = null;

    public static function getConnexion() {
        if (!isset(self::$pdo)) {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "my_database";

            try {
                self::$pdo = new PDO(
                    "mysql:host=$servername;dbname=$dbname;charset=utf8",
                    $username,
                    $password,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
                echo "Base de données connectée avec succès";
            } catch (Exception $e) {
                die('Erreur : ' . $e->getMessage());
            }
        }

        return self::$pdo;
    }
}

// Test de la connexion
Config::getConnexion();
?>
