
<?php
include '../../controller/eventc.php'; 
$eventc = new eventc(); 
$eventc->deleteEvent($_GET["id"]); 
header('Location:event.php');
?>