<?php
require '_connec.php';

function displayAllFriends(): array
{
    $connection = new PDO("mysql:host=" . SERVER . ";dbname=" . DATABASE . ";charset=utf8", USER, PASSWORD);
    $statement = $connection->query('SELECT firstname, lastname FROM friend');

    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

$friends = displayAllFriends();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/style/index.css">
    <title>Friends!</title>
</head>

<body>
    <main>
        <h1>Friends!</h1>
        <ul>
            <?php foreach ($friends as $friend) : ?>
                <li>
                    <?= htmlentities($friend['firstname'] . ' ' . $friend['lastname']) ?>
                </li>
            <?php endforeach ?>
        </ul>
        <a href="addFriend.php">Add a new friend</a>
    </main>
</body>

</html>