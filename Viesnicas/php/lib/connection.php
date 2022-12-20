<?php

try{
    $pdo=new PDO('mysql:host=localhost;dbname=hotel;charset=utf8', 'root', 'root', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
}
catch(PDOException $e){
    die("Database error: " . $e->getMessage());
}

return $pdo;