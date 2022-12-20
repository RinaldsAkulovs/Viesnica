<?php 
if(isset($_POST["id"]) && !is_array($_POST["id"]) &&
    isset($_POST["Name"]) && !is_array($_POST["Name"]) &&
    isset($_POST["Email_or_personal_data"]) && !is_array($_POST["Email_or_personal_data"]) &&
    isset($_POST["Arrival_Date"]) && !is_array($_POST["Arrival_Date"]) &&
    isset($_POST["Number_of_departures"]) && !is_array($_POST["Number_of_departures"]) &&
    isset($_POST["Number_of_people"]) && !is_array($_POST["Number_of_people"])
){
    $sql = "UPDATE rezervation SET Name=:username, Email_or_personal_data=:email_or_personal_data, Arrival_Date=:arrival_date, Number_of_departures=:number_of_departures, Number_of_people=:number_of_people WHERE id = :userid";
    $pdo = require_once 'lib/connection.php';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":userid", $_POST["id"]);
    $stmt->bindValue(":username", $_POST["Name"]);
    $stmt->bindValue(":email_or_personal_data", $_POST["Email_or_personal_data"]);
    $stmt->bindValue(":arrival_date", $_POST["Arrival_Date"]);
    $stmt->bindValue(":number_of_departures", $_POST["Number_of_departures"]);
    $stmt->bindValue(":number_of_people", $_POST["Number_of_people"]);
    $stmt->execute();
    header("Location: admin.php", true, 302);
} 
else{
    echo "Некорректные данные";
}