<?php

$pathToJsonFile = "../files/guestbook.json";

AddMessageToGuestbook($pathToJsonFile, ["firstName"=> "John", "lastName"=> "Dough", "message"=>"i'm not content with my last name"]);

function AddMessageToGuestbook(string $filePath, $newEntry) {
    $guestbook = array_values(json_decode(file_get_contents($filePath), true));

    // echo print_r($guestbook);

    if($guestbook) {
        array_push($guestbook, $newEntry);

    } else {
        $guestbook = $newEntry;
    }

    file_put_contents($filePath, json_encode($guestbook));
}