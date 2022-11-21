<?php
require_once("guestbook.php");
require_once("author.php");
require_once("guestbookMessage.php");

$pathToJsonFile = "../files/guestbookData.json";
$guestbook = new Guestbook($pathToJsonFile);

// input validation

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    handlePostRequest($guestbook);
}

function handlePostRequest(Guestbook $guestbook) {
    $firstName = validateInputData($_POST["firstName"] ?? "");
    $lastName = validateInputData($_POST["lastName"] ?? "");
    $message = validateInputData($_POST["message"] ?? "");
    $messageId = validateInputData($_POST["messageId"] ?? "");

    if($firstName && $lastName && $message) {
        $guestbook->addGuestbookMessage(["firstName"=> $firstName, "lastName"=> $lastName, "message"=> $message]);

    } else if($messageId) {
        $guestbook->deleteGuestbookMessage($messageId);
    }
}

function validateInputData(string $data) : string {
    return (stripslashes(trim(htmlspecialchars($data))));
}