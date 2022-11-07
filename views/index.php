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
    <div class="wrapper">
        <section class="guestbookInput">

            <form action="" method="post">

                    <label for="firstName">Voornaam</label>
                    <input id="firstName" type="text" name="firstName">

                    <label for="lastName">Achternaam</label>
                    <input id="lastName" type="text" name="lastName">

                    <label for="message">Bericht</label>
                    <input id="message" type="text" name="message" required>

                <input id="submit" type="submit">
            </form>
        </section>


        <section class="messagesList">
            <div class="guestbookEntry">
                <div class="userName">
                    John Dough
                </div>
                <div class="message">
                    TestEntry
                </div> 
            </div>

        
        <!-- echo result of list maak functie -->
        </section>

    </div>
</body>
</html>