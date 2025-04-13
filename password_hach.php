<?php
$password = "123456"; // Remplace par le mot de passe admin en clair

// Utilisation de password_hash pour générer un mot de passe haché
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Affiche le mot de passe haché
echo $hashedPassword;
?>
