<?php

$pathToJsonFile = "../files/guestbook.json";

HandleGuestbookInput($pathToJsonFile);

// user input

function HandleGuestbookInput(string $filePath) {
    $firstName = ValidateInputData($_POST["firstName"] ?? "");
    $lastName = ValidateInputData($_POST["lastName"] ?? "");
    $message = ValidateInputData($_POST["message"] ?? "");

    if($firstName && $lastName && $message) {
        AddMessageToGuestbook($filePath, ["firstName"=> $firstName, "lastName"=> $lastName, "message"=> $message]);

    } else {
        // dit toont hij ook als je de pagina net laad, dat is niet nodig
        echo "please fill in all fields"; // roep error message function aan instead
    }
}

function ValidateInputData(string $data) : string {
    $data = htmlspecialchars($data);
    $data = trim($data);
    $data = stripslashes($data);
    return $data;
}

// html generation

function MakeGuestbookList(string $filePath) : string {
    $guestbookArray = GetCurrentGuestbook($filePath);
    $list = ""; 

    foreach($guestbookArray as $entry) {
        $entryItem = 
            "<div class='guestbookEntry'>
                <div class='userName'>
                    {$entry['firstName']} {$entry['lastName']}
                </div>
                <div class='message'>
                    {$entry['message']}
                </div> 
            </div>";
        $list .= $entryItem;
    }
    
    return $list;
}

// data crud

function AddMessageToGuestbook(string $filePath, array $newEntry) {
    $guestbook = GetCurrentGuestbook($filePath);

    array_push($guestbook, $newEntry);

    file_put_contents($filePath, json_encode($guestbook));
}

function GetCurrentGuestbook(string $filePath) : array {
    $guestbook = json_decode(file_get_contents($filePath), true);

    return $guestbook ? array_values($guestbook) : array();
}