<?php
require '_connec.php';

function addNewFriend(array $friend): void
{
    $connection = new PDO("mysql:host=" . SERVER . ";dbname=" . DATABASE . ";charset=utf8", USER, PASSWORD);
    $query = 'INSERT INTO friend (firstname, lastname) VALUES (:firstname, :lastname)';
    $statement = $connection->prepare($query);
    $statement->bindValue(':firstname', $friend['firstname']);
    $statement->bindValue(':lastname', $friend['lastname']);
    $statement->execute();
}

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $friend = array_map("trim", $_POST);

    if (empty($friend['firstname'])) {
        $errors[] = 'Please enter a valid firstname.';
    }

    $maxFirstNameLength = 45;
    if (mb_strlen($friend['firstname']) > $maxFirstNameLength) {
        $errors[] = 'Your friend\'s firstname must be les than ' . $maxFirstNameLength . ' characters.';
    }

    if (empty($friend['lastname'])) {
        $errors[] = 'Please enter a valid lastname.';
    }

    $maxLastNameLength = 45;
    if (mb_strlen($friend['lastname']) > $maxLastNameLength) {
        $errors[] = 'Your friend\'s firstname must be les than ' . $maxLastNameLength . ' characters.';
    }

    if (empty($errors)) {
        addNewFriend($friend);

        header('Location: /');
        exit();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/style/addFriend.css">
    <title>Add a new friend !</title>
</head>

<body>
    <main>
        <h1>Add a new Friend!</h1>
        <?php if (!empty($errors)) : ?>
            <ul>
                <?php foreach ($errors as $error) : ?>
                    <li><?= $error ?></li>
                <?php endforeach ?>
            </ul>
        <?php endif ?>
        <form action="" method="POST">
            <div>
                <label>Enter your Friend's firstname :</label>
                <input type="text" id="firstname" name="firstname" value="<?php $friend['firstname'] ?? '' ?>">
            </div>
            <div>
                <label>Enter your Friend's lastname :</label>
                <input type="text" id="lastname" name="lastname" value="<?php $friend['lastname'] ?? '' ?>">
            </div>
            <div>
                <button>Add !</button>
            </div>
        </form>
        <a href="index.php">Back to mainpage</a>
    </main>

</body>

</html>