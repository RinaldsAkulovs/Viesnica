<?php
if(isset($_GET['id']) && !is_array($_GET['id']) && is_numeric($_GET['id'])){
    $pdo = require_once 'lib/connection.php';
    $deleteStatement = $pdo->prepare('DELETE FROM `rezervation` WHERE id = ?');
    $deleteStatement->execute([$_GET['id']]);
}
header('Location: admin.php', true, 302);