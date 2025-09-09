<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Display Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <?php
    if (isset($users)) {
        foreach ($users as $u) {
            var_dump($u);
        }
    } else {
        echo "Get Id";
    }
    ?>

    <div class="container mx-auto">
        <div class="row mx-auto mt-5">
            <div class="col-md-8">
                <table class="table table-bordered table-stripped">
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Username</th>
                    </tr>
                    <?php foreach ($users as $u): ?>
                        <tr>
                            <td> <?= $u['id'] ?></td>
                            <td> <?= $u['firstName'] ?? '' ?></td>
                            <td> <?= $u['lastName'] ?? '' ?></td>
                            <td> <?= $u['email'] ?? '' ?></td>
                            <td> <?= $u['username'] ?></td>
                        </tr>
                    <?php endforeach; ?>

                </table>
            </div>
        </div>
    </div>
</body>

</html>