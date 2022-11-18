<?php
require("../php/main.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" href = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>   
    <link rel="stylesheet" href="../css/style.css">
    <title>Gastenboek</title>
</head>
<body>
    <div class="wrapper">
        <section class="input-section">
            <p class="section-title">Plaats een nieuw bericht</p>

            <form class="input-form" action="" method="post">
                <label for="firstName" class="form-label">Voornaam</label>
                <input id="firstName" class="form-control" type="text" name="firstName" placeholder="voornaam" required>

                <label for="lastName" class="form-label">Achternaam</label>
                <input id="lastName" class="form-control" type="text" name="lastName" placeholder="achternaam" required>

                <label for="message" class="form-label">Bericht</label>
                <textarea id="message" class="form-control" type="text" name="message" placeholder="vul hier je bericht in" required rows="6"></textarea>

                <button type="submit" class="btn btn-primary">Plaats bericht</button>
            </form>
        </section>

        <section class="messages-section">
            <p class="section-title">Geplaatste berichten</p>

            <?= print_r($guestbook->sortMessagesByDate($guestbook->getAllMessages())) ?>

            <div class="messages-list">
                <?= $guestbook->getMessagesAsHTML();?>
            </div>
        </section>

    </div>
</body>
</html>