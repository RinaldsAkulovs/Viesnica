<?php
if(isset($_GET['SingUpID']) && !is_array($_GET['SingUpID']) && is_numeric($_GET['SingUpID'])){
    $pdo = require_once 'lib/connection.php';
    $deleteStatement = $pdo->prepare('DELETE FROM `singup` WHERE SingUpID = ?');
    $deleteStatement->execute([$_GET['SingUpID']]);
}
header('Location: AdminSingUp.php', true, 302);
?>