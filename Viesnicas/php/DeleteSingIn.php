<?php
if(isset($_GET['SingInID']) && !is_array($_GET['SingInID']) && is_numeric($_GET['SingInID'])){
    $pdo = require_once 'lib/connection.php';
    $deleteStatement = $pdo->prepare('DELETE FROM `signin` WHERE SingInID = ?');
    $deleteStatement->execute([$_GET['SingInID']]);
}
header('Location: AdminSingIn.php', true, 302);
?>
