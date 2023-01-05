<?php
$pdo = require_once 'lib/connection.php';
$selectStatement = $pdo->prepare('SELECT * FROM `signin`;');
$selectStatement->execute();
$signin = $selectStatement->fetchAll();
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
            <th class="text-center">Edit</th>
            <th class="text-center">Delete</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($signin as $signin): ?>
            <tr>
                <td><?= htmlspecialchars($signin['Email']) ?></td>
                <td><?= htmlspecialchars($signin['Password']) ?></td>
                <td class="text-center"><a href="EditSingIn.php?SingInID=<?= htmlspecialchars($signin['SingInID']) ?>" class="btn btn-primary">Edit</a></td>
                <td class="text-center"><a href="DeleteSingIn.php?SingInID=<?= htmlspecialchars($signin['SingInID']) ?>" class="btn btn-danger">Delete</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="row">
        <div class="col text-center">
            <a href="../php/AdminSingUp.php"><button type="submit" name="submit" id="submit">Back</button></a>
        </div>
    </div>
</div>
<div class="col">
    <a href="../templates/index.html"><button class="thg" type="submit" name="submit" id="submit">Back on Montana</button></a>
</div>
</body>
</html>
