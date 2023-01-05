<?php
if (isset($_POST["SingInID"]) && !is_array($_POST["SingInID"]) &&
    isset($_POST["Email"]) && !is_array($_POST["Email"]) &&
    isset($_POST["Password"]) && !is_array($_POST["Password"])
) {
    $sql = "UPDATE signin SET Email=:email, Password=:password WHERE SingInID=:userSingInID";
    $pdo = require_once 'lib/connection.php';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(":userSingInID", $_POST["SingInID"]);
    $stmt->bindValue(":email", $_POST["Email"]);
    $stmt->bindValue(":password", $_POST["Password"]);
    $stmt->execute();
    header("Location: AdminSingIn.php", true, 302);
} else {
    echo "Некорректные данные";
}
?>
