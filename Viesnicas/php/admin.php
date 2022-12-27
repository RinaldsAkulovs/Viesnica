<?php 
$pdo = require_once 'lib/connection.php';
$selectStatement = $pdo->prepare('SELECT * FROM `rezervation`;');
$selectStatement->execute();
$reservations = $selectStatement->fetchAll();
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
                        <th>Name</th>
                        <th>Email_or_personal_data</th>
                        <th>Arrival_Date</th>
                        <th>Number_of_departures</th>
                        <th>Number_of_people</th>
                        <th class="text-center">Edit</th>
                        <th class="text-center">Delete</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($reservations as $reservation): ?>
                    <tr>
                        <td><?= htmlspecialchars($reservation['Name']) ?></td>
                        <td><?= htmlspecialchars($reservation['Email_or_personal_data']) ?></td>
                        <td><?= htmlspecialchars($reservation['Arrival_Date']) ?></td>
                        <td><?= htmlspecialchars($reservation['Number_of_departures']) ?></td>
                        <td><?= htmlspecialchars($reservation['Number_of_people']) ?></td>
                        <td class="text-center"><a href="edit.php?id=<?= htmlspecialchars($reservation['id']) ?>" class="btn btn-primary">Edit</a></td>
                        <td class="text-center"><a href="delete.php?id=<?= htmlspecialchars($reservation['id']) ?>" class="btn btn-danger">Delete</a></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
            <div class="row">
                <div class="col text-center">
                    <a href="../php/AdminSingUp.php"><button type="submit" name="submit" id="submit">Continue</button></a>
                </div>
            </div>
        </div>
        <div class="col">
            <a href="../templates/index.html"><button class="thg" type="submit" name="submit" id="submit">Back on Montana</button></a>
        </div>
    </body>
</html>