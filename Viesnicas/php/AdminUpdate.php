<?php

if (isset($_POST["SingUpID"]) && !is_array($_POST["SingUpID"]) &&
    isset($_POST["Email"]) && !is_array($_POST["Email"]) &&
    isset($_POST["Password"]) && !is_array($_POST["Password"]) &&
    isset($_POST["RepeatPassword"]) && !is_array($_POST["RepeatPassword"])
) {
    $sql = "UPDATE singup SET Email=:email, Password=:password, RepeatPassword=:repeatpassword WHERE SingUpID=:userSingUpID";
    $pdo = require_once 'lib/connection.php';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":userSingUpID", $_POST["SingUpID"]);
    $stmt->bindValue(":email", $_POST["Email"]);
    $stmt->bindValue(":password", $_POST["Password"]);
    $stmt->bindValue(":repeatpassword", $_POST["RepeatPassword"]);
    $stmt->execute();
    header("Location: AdminSingUp.php", true, 302);
} else {
    echo "Некорректные данные";
}
?>