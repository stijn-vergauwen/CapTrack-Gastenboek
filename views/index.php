<?php
require("../php/main.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Gastenboek</title>
</head>
<body>
    <form action="" method="post">
        <div>
            <label for="firstName">voornaam</label>
            <input id="firstName" type="text" name="firstName">
        </div>

        <div>
            <label for="lastName">nanaam</label>
            <input id="lastName" type="text" name="lastName">
        </div>

        <div>
            <label for="message">bericht</label>
            <input id="message" type="text" name="message">
        </div>

        <input type="submit">
    </form>

    <section class="messages-list">
        <!-- echo result of list maak functie -->
    </section>
</body>
</html>