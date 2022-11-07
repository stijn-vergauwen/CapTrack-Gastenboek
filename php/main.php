<?php

$pathToJsonFile = "../files/guestbook.json";

handleGuestbookInput($pathToJsonFile);

// input validation

function handleGuestbookInput(string $filePath) {
    $firstName = validateInputData($_POST["firstName"] ?? "");
    $lastName = validateInputData($_POST["lastName"] ?? "");
    $message = validateInputData($_POST["message"] ?? "");

    if($firstName && $lastName && $message) {
        addGuestbookEntry($filePath, ["firstName"=> $firstName, "lastName"=> $lastName, "message"=> $message]);

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

// create html elements

function createGuestbookList(string $filePath) : string {
    $guestbookArray = getGuestbookEntries($filePath);
    $list = ""; 

    foreach($guestbookArray as $entry) {
        $list .= createGuestbookEntry($entry);
    }
    
    return $list;
}

function createGuestbookEntry(array $entry) : string {
    return (
        "<div class='guestbookEntry'>
            <div class='userName'>
                {$entry['firstName']} {$entry['lastName']}
            </div>
            <div class='message'>
                {$entry['message']}
            </div>
        </div>"
    );
}

// guestbook crud

function getGuestbookEntries(string $filePath) : array {
    $entries = json_decode(file_get_contents($filePath), true);

    return $entries ? array_values($entries) : array();
}

function addGuestbookEntry(string $filePath, array $newEntry) {
    $guestbook = getGuestbookEntries($filePath);
    array_push($guestbook, $newEntry);

    file_put_contents($filePath, json_encode($guestbook));
}

function deleteGuestbookEntry(string $message) {
    // find entry by message & delete from data
}