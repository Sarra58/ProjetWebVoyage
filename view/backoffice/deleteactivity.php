
<?php
include '../../controller/activityc.php'; 
$activityc = new activityc(); 
$activityc->deleteActivity($_GET["id"]); 
header('Location:activity.php');
?>