<?php
$reservation = null;
if (isset($_GET['id']) && !is_array($_GET['id']) && is_numeric($_GET['id'])) {
    $pdo = require_once 'lib/connection.php';
    $selectStatement = $pdo->prepare('SELECT * FROM `rezervation` WHERE id = ?');
    $selectStatement->execute([$_GET['id']]);
    $reservation = $selectStatement->fetch();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Edit</title>
        <link href="../static/bootstrap.css" rel="stylesheet">
    </head>
    <body>
        <div class="container mt-5">
            <?php if (!$reservation): ?>
                <div class="card">
                    <div class="card-header text-end">
                        <a class="btn btn-success" href="adin.php">Return to Reservations</a>
                    </div>
                    <div class="card-body pb-0">
                        <div class="alert alert-danger">
                            Wrong reservation ID has been provided!
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <form method="POST" class="form" action="update.php">
                    <div class="card">
                        <div class="card-header text-end">
                            <a class="btn btn-success" href="admin.php">Return to Reservations</a>
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="id" value="<?= htmlspecialchars($reservation['id']) ?>" />
  
                            <p>Name: <input type="text" required class="form-control" name="Name" value="<?= htmlspecialchars($reservation['Name']) ?>" /></p>
                            
                            <p>Email_or_personal_data: <input type="text" required class="form-control" name="Email_or_personal_data" value="<?= htmlspecialchars($reservation['Email_or_personal_data']) ?>" /></p>
                            
                            <p>Arrival_Date: <input type="text" required class="form-control" name="Arrival_Date" value="<?= htmlspecialchars($reservation['Arrival_Date']) ?>" /></p>
             
                            <p>Number_of_departures: <input type="text" required class="form-control" name="Number_of_departures" value="<?= htmlspecialchars($reservation['Number_of_departures']) ?>"/></p>
                            
                            <p>Number_of_people: <input type="number" required class="form-control" name="Number_of_people" value="<?= htmlspecialchars($reservation['Number_of_people']) ?>" /></p>
                        </div>
                        <div class="card-footer text-end">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </div>
                </form>
            <?php endif; ?>
        </div>
    </body>
</html>