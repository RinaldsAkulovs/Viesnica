<?php
$pdo = require_once 'lib/connection.php';
$selectStatement = $pdo->prepare('SELECT * FROM `singup`;');
$selectStatement->execute();
$singup = $selectStatement->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reservations</title>
    <link href="../static/bootstrap.css" rel="stylesheet">
    <link href="../static/about.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <table class="table table-bordered table-stripped">
        <thead>
        <tr>
            <th>Email</th>
            <th>Password</th>
            <th>RepeatPassword</th>
            <th class="text-center">Edit</th>
            <th class="text-center">Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($singup as $singup): ?>
            <tr>
                <td><?= htmlspecialchars($singup['Email']) ?></td>
                <td><?= htmlspecialchars($singup['Password']) ?></td>
                <td><?= htmlspecialchars($singup['RepeatPassword']) ?></td>
                <td class="text-center"><a href="EditSingUp.php?SingUpID=<?= htmlspecialchars($singup['SingUpID']) ?>" class="btn btn-primary">Edit</a></td>
                <td class="text-center"><a href="DeleteSingUp.php?SingUpID=<?= htmlspecialchars($singup['SingUpID']) ?>" class="btn btn-danger">Delete</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="row">
        <div class="col text-center">
            <a href="../php/admin.php"><button type="submit" name="submit" id="submit">Back</button></a>
        </div>
        <div class="col text-center">
            <a href="../php/AdminSingIn.php"><button type="submit" name="submit" id="submit">Continue</button></a>
        </div>
    </div>
</div>
<div class="col">
    <a href="../templates/index.html"><button class="thg" type="submit" name="submit" id="submit">Back on Montana</button></a>
</div>
</body>
</html>