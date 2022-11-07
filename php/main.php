<?php

$pathToJsonFile = "../files/guestbook.json";

HandleGuestbookInput($pathToJsonFile);

function HandleGuestbookInput($filePath) {
    $firstName = ValidateInputData($_POST["firstName"] ?? "");
    $lastName = ValidateInputData($_POST["lastName"] ?? "");
    $message = ValidateInputData($_POST["message"] ?? "");


    if($firstName && $lastName && $message) {
        echo "add entry to guestbook";
        AddMessageToGuestbook($filePath, ["firstName"=> $firstName, "lastName"=> $lastName, "message"=> $message]);

    } else {
        // dit toont hij ook als je de pagina net laad, dat is niet nodig
        echo "please fill in all fields";
    }
}

function ValidateInputData(string $data) : string {
    $data = htmlspecialchars($data);
    $data = trim($data);
    $data = stripslashes($data);
    return $data;
}

function AddMessageToGuestbook(string $filePath, $newEntry) {
    $guestbook = GetCurrentGuestbook($filePath);

    array_push($guestbook, $newEntry);

    file_put_contents($filePath, json_encode($guestbook));
}

function GetCurrentGuestbook(string $filePath) : array {
    $guestbook = json_decode(file_get_contents($filePath), true);

    return $guestbook ? array_values($guestbook) : array();
}

function MakeGuestbookList(string $filePath) {
    $guestbookArray = GetCurrentGuestbook($filePath);

    $list = ""; 

    // add all guestbook entries as html elements to list
    foreach($guestbookArray as $entry) {

        $entryItem = 
            "<div class='guestbookEntry'>
                <div class='userName'>
                    {$entry['firstName']} {$entry['lastName']}
                </div>
                <div class='message'>
                    {$entry['message']}
                </div> 
            </div>"
        ;

        $list .= $entryItem;
    }

    return $list;
}