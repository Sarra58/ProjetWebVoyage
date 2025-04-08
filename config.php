<?php  
Class Config{
 
private static $pdo=null;
 
public static function getConnexion(){
 
if (!isset(self::$pdo)){
 
$servername="localhost";
 
$username="root";
 
$password="";
 
$dbname="atelier_php";
 
}
 
Try{
 
self::$pdo=new PDO("mysql:host=$servername;dbname=$dbname",$username,$password,
 
[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
 
 
 
PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC]
 
);  
 
echo "base de de données connectée avec succées";
 
}catch (Exception $e){
 
die('Erreur'.$e->getMessage());
}
 
 
return self::$pdo;
 
}
 
}
 
Config::getConnexion()
 
?>