<?php
$pdo = new PDO('mysql:host=localhost;dbname=hotel;charset=utf8', 'root', 'root', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

$statement = $pdo->prepare('SELECT * FROM `rezervation`;');
$statement->execute();
$rezervations = $statement->fetchAll();

foreach ($rezervations as $rezervation){
    echo '<br>';
    echo 'Name:', $rezervation['Name'], '<br>';
    echo 'Email_or_personal_data:', $rezervation['Email_or_personal_data'], '<br>';
    echo 'Arrival_Date:', $rezervation['Arrival_Date'], '<br>';
    echo 'Number_of_departures:', $rezervation['Number_of_departures'], '<br>';
    echo 'Number_of_people:', $rezervation['Number_of_people'], '<br>';
}
?>