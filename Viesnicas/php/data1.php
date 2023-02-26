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
                echo '<h1>Error,This user already exists<h1>';
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
        header('Location: rezervation_room.html', true, 302);
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