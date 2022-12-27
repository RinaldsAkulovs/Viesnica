<?php
$singup = null;
if (isset($_GET['SingUpID']) && !is_array($_GET['SingUpID']) && is_numeric($_GET['SingUpID'])) {
    $pdo = require_once 'lib/connection.php';
    $selectStatement = $pdo->prepare('SELECT * FROM `singup` WHERE SingUpID = ?');
    $selectStatement->execute([$_GET['SingUpID']]);
    $singup = $selectStatement->fetch();
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
            <?php if (!$singup): ?>
                <div class="card">
                    <div class="card-header text-end">
                        <a class="btn btn-success" href="AdminSingUp.php">Return to Reservations</a>
                    </div>
                    <div class="card-body pb-0">
                        <div class="alert alert-danger">
                            Wrong reservation ID has been provided!
                        </div>
                    </div>
                </div>
            <?php else: ?>
                <form method="POST" class="form" action="AdminUpdate.php">
                    <div class="card">
                        <div class="card-header text-end">
                            <a class="btn btn-success" href="AdminSingUp.php">Return to Reservations</a>
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="SingUpID" value="<?= htmlspecialchars($singup['SingUpID']) ?>" />

                            <p>Email: <input type="text" required class="form-control" name="Email" value="<?= htmlspecialchars($singup['Email']) ?>" /></p>

                            <p>Password: <input type="text" required class="form-control" name="Password" value="<?= htmlspecialchars($singup['Password']) ?>"/></p>

                            <p>RepeatPassword: <input type="text" required class="form-control" name="RepeatPassword" value="<?= htmlspecialchars($singup['RepeatPassword']) ?>" /></p>

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