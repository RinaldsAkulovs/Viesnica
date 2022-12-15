<?php
$parameters = ['name', 'email', 'date', 'date2', 'people_number'];
$errors = [];
if (isset($_POST['registration'])) {
    foreach ($parameters as $param) {
        if (!isset($_POST[$param]) || is_array($_POST[$param]) || trim($_POST[$param]) === '') {
            $errors[] = sprintf('Wrong or empty %s', $param);
        }
    }
    if (!$errors) {
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
        WHERE `Name` = ? OR `Email_or_personal_data` = ? OR `Arrival_Date` = ? OR `Number_of_departures` = ? OR `Number_of_people` = ?");
        $selectStatement->execute([$name, $email, $date, $date2, $peopleNumber]);
        if ($row = $selectStatement->fetch()) {
            if ($row['qty'] > 0) {
                echo 'Error,This user already exists ';
                die;
            }
        }
        $statement = $pdo->prepare("INSERT INTO `rezervation` (`Name`,`Email_or_personal_data`,`Arrival_Date`,`Number_of_departures`,`Number_of_people`) 
VALUES(?, ?, ?, ?, ?)");
        $statement->execute([$name, $email, $date, $date2, $peopleNumber]);
        header('Location: /Viesnica/Viesnicas/templates/rezervation_room.html', true, 302);
    } else {
        echo implode('<br>', $errors);
    }
}


/*
$name4 = filter_var(trim($_POST['name']), FILTER_SANITIZE_STRING);
$epasts_vai_personas_dati5 = filter_var(trim($_POST['Epasts_vai_personas_dati']), FILTER_SANITIZE_STRING);
$date16 = filter_var(trim($_POST['date1']), FILTER_SANITIZE_STRING);
$date23 = filter_var(trim($_POST['date2']), FILTER_SANITIZE_STRING);
$cilvēku_skaits5 = filter_var(trim($_POST['Cilvēku_skaits']), FILTER_SANITIZE_STRING);
*/

/*
$pdo = new PDO('mysql:host=localhost;dbname=hotel;charset=utf8', 'root', 'root', [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

/*
$mysql=new mysqli('localhost', 'root', 'root', 'hotel');
$mysql->query("INSERT INTO `rezervation` (`Name`,`Email_or_personal_data`,`Arrival_Date`,`Number_of_departures`,`Number_of_people`) 
VALUES('$name4','$epasts_vai_personas_dati5','$date16','$date23','$cilvēku_skaits5')");
$mysql->close();
*/

/*
$name4 = 'a';
$epasts_vai_personas_dati5 = 'b';
$date16 = 'c';
$date23 = 'd';
$cilvēku_skaits5 = '6768';

$statement = $pdo->prepare("INSERT INTO `rezervation` (`Name`,`Email_or_personal_data`,`Arrival_Date`,`Number_of_departures`,`Number_of_people`) 
VALUES(?, ?, ?, ?, ?)");

$statement->execute([$name4, $epasts_vai_personas_dati5, $date16, $date23, $cilvēku_skaits5]);

?>
*/
?>