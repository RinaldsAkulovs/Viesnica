<?php
$singin = null;
if (isset($_GET['SingInID']) && !is_array($_GET['SingInID']) && is_numeric($_GET['SingInID'])) {
    $pdo = require_once 'lib/connection.php';
    $selectStatement = $pdo->prepare('SELECT * FROM `signin` WHERE SingInID = ?');
    $selectStatement->execute([$_GET['SingInID']]);
    $singin = $selectStatement->fetch();
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
    <?php if (!$singin): ?>
        <div class="card">
            <div class="card-header text-end">
                <a class="btn btn-success" href="AdminSingIn.php">Return to Reservations</a>
            </div>
            <div class="card-body pb-0">
                <div class="alert alert-danger">
                    Wrong reservation ID has been provided!
                </div>
            </div>
        </div>
    <?php else: ?>
        <form method="POST" class="form" action="UpdateSingIn.php">
            <div class="card">
                <div class="card-header text-end">
                    <a class="btn btn-success" href="AdminSingIn.php">Return to Reservations</a>
                </div>
                <div class="card-body">
                    <input type="hidden" name="SingInID" value="<?= htmlspecialchars($singin['SingInID']) ?>" />

                    <p>Email: <input type="text" required class="form-control" name="Email" value="<?= htmlspecialchars($singin['Email']) ?>" /></p>

                    <p>Password: <input type="text" required class="form-control" name="Password" value="<?= htmlspecialchars($singin['Password']) ?>"/></p>
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