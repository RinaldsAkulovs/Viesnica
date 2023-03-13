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
$parameters=['email', 'password-one'];
$errors=[];
if (isset($_POST['butt'])) {
    foreach ($parameters as $param) {
        if (!isset($_POST[$param]) || is_array($_POST[$param]) || trim($_POST[$param]) === '') {
            $errors[] = sprintf('<h1>Wrong or empty %s</h1>', $param);
        }
    }
    if (!$errors) {
        $pdo = require 'lib/connection.php';
        $email=$_POST['email'];
        $psw=$_POST['password-one'];
        $selectStatement = $pdo->prepare("SELECT COUNT(*) AS qty FROM `signin` 
        WHERE `Email` = ? OR `Password` = ?");
        $selectStatement->execute([$email, $psw]);
        if ($row = $selectStatement->fetch()){
            if ($row['qty'] > 0) {
                echo '<h1 class="error cartoon">Error,This user already exists<h1>';
                echo '<a href="../templates/Signup.html"><button type="button" class="btn btn-secondary left-button" data-bs-dismiss="modal">Back</button></a>';
                die;
            }
        }
        $statement = $pdo->prepare("INSERT INTO `signin` (`Email`,`Password`) VALUES(?, ?)");
        $statement->execute([$email, $psw]);
        echo '<h1 class="error cartoon">Esat veiksmīgi reģistrēts</h1>';
    } else {
        echo implode('<br>', $errors);
    }
}
?>