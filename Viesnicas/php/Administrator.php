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
$parameters = ['login', 'password'];
$errors = [];
if (isset($_POST['continue'])){
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
        $login = $_POST['login'];
        $password = $_POST['password'];
        $selectStatement = $pdo->prepare("SELECT COUNT(*) AS qty FROM `administrator` 
        WHERE `Login` = ?  AND `Password` = ?");
        $selectStatement->execute([$login, $password]);
        if ($row = $selectStatement->fetch()){
            if ($row['qty'] > 0) {
                echo '<h1 class="error cartoon">Welcome Administrator<h1>';
                echo '<a href="/Viesnica/Viesnicas/php/admin.php"><button type="button" class="btn btn-secondary left-button" data-bs-dismiss="modal">Continue</button></a>';
                die;
            }
        }
        header('Location: /Viesnica/Viesnicas/php/admin.php', true, 302);
    } else {
        echo implode('<br>', $errors);
    }
}
?>
