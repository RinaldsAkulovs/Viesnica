<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Montana</title>
    <link rel="stylesheet" href="../static/error.css">
    <link rel="stylesheet" href="../static/bootstrap.css">
</head>
</html>
<?php
$parameters = ['name', 'email', 'date', 'date2', 'people_number'];
$errors = [];
if (isset($_POST['registration'])) {
    foreach ($parameters as $param) {
        if (!isset($_POST[$param]) || is_array($_POST[$param]) || trim($_POST[$param]) === '') {
            $errors[] = sprintf('<h1>Wrong or empty %s</h1>', $param);
        }
    }
    if (!$errors){
        $pdo = new PDO('mysql:host=localhost;dbname=hotel;charset=utf8', 'root', 'root', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
        $name = $_POST['name'];
        $email = $_POST['email'];
        $date = $_POST['date'];
        $date2 = $_POST['date2'];
        $peopleNumber = $_POST['people_number'];
        $selectStatement = $pdo->prepare("SELECT COUNT(*) AS qty FROM `rezervation` 
        WHERE `Email_or_personal_data` = ?");
        $selectStatement->execute([$email]);
        if ($row = $selectStatement->fetch()){
            if ($row['qty'] > 0) {
                echo '<h1 class="error cartoon">Error,This user already exists<h1>';
                die();
            }
        }
        if(!empty($_POST['name'])){
            $name2 = trim(htmlspecialchars($_POST['name']));
            if(preg_match("/^[!#$%^&*()]+$/",$name2)){
                die('<h1>Invalid Name</h1>');
            }
        }
        if(!empty($_POST['email'])) {
            $email2 = trim(htmlspecialchars($_POST['email']));
            $email2 = filter_var($email2, FILTER_VALIDATE_EMAIL);
            if ($email2 === false) {
                die('<h1>Invalid Email</h1>');
            }
        }
        if(!empty($_POST['date'])){
            $name2 = trim(htmlspecialchars($_POST['date']));
            if(preg_match("/^[!#$%^&*()]+$/",$name2)){
                die('<h1>Invalid data</h1>');
            }
        }
        if(!empty($_POST['date2'])){
            $name2 = trim(htmlspecialchars($_POST['date2']));
            if(preg_match("/^[!#$%^&*()]+$/",$name2)){
                die('<h1>Invalid data2</h1>');
            }
        }
        if(!empty($_POST['people_number'])){
            $people_number2 = trim(htmlspecialchars($_POST['people_number']));
            $people_number2 = filter_var($people_number2,FILTER_VALIDATE_INT);
            if ($people_number2 === false){
                die('<h1>Invalid People Number</h1>');
            }
        }
        $statement = $pdo->prepare("INSERT INTO `rezervation` (`Name`,`Email_or_personal_data`,`Arrival_Date`,`Number_of_departures`,`Number_of_people`) 
VALUES(?, ?, ?, ?, ?)");
        $statement->execute([$name, $email, $date, $date2, $peopleNumber]);
        echo '<h1>Esat veiksmīgi reģistrējies</h1>';
    } else {
        echo implode('<br>', $errors);
    }
}