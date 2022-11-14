<?php
require("guestbook.php");
require("author.php");
require("guestbookMessage.php");

$pathToJsonFile = "../files/guestbookData.json";

$guestbook = new Guestbook($pathToJsonFile);

// input validation

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    handlePostRequest($pathToJsonFile, $guestbook);
}


function handlePostRequest(string $filePath, Guestbook $guestbook) {
    $firstName = validateInputData($_POST["firstName"] ?? "");
    $lastName = validateInputData($_POST["lastName"] ?? "");
    $message = validateInputData($_POST["message"] ?? "");
    $messageToDelete = validateInputData($_POST["messageToDelete"] ?? "");

    if($firstName && $lastName && $message) {
        $guestbook->addGuestbookMessage(["firstName"=> $firstName, "lastName"=> $lastName, "message"=> $message]);

    } else if($messageToDelete) {
        $guestbook->deleteGuestbookMessage($messageToDelete);

    } else {
        // roep error message function aan
    }
}

function validateInputData(string $data) : string {
    return stripslashes(
        trim(
            htmlspecialchars($data)
        )
    );
}