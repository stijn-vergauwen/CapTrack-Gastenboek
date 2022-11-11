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
        print_r("add something");
        $guestbook->addGuestbookMessage(["firstName"=> $firstName, "lastName"=> $lastName, "message"=> $message]);

    } else if($messageToDelete) {
        print_r("delete something");
        $guestbook->deleteGuestbookMessage($messageToDelete);

    } else {
        // roep error message function aan
    }
}

function validateInputData(string $data) : string {
    $data = htmlspecialchars($data);
    $data = trim($data);
    $data = stripslashes($data);
    return $data;
}