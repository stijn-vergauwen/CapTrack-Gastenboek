<?php

class Guestbook {
    private $filePath;

    function __construct(string $filePath) {
        $this->filePath = $filePath;
    }

    // create html elements
    
    public function getMessagesAsHTML() : string {
        $authors = $this->getDataFromFile();
        $list = ""; 
    
        foreach($authors as $author) {
            foreach($author->getMessages() as $message) {
                $list .= $this->createMessageHTML($message);
            }
        }
        
        return $list;
    }
    
    private function createMessageHTML(GuestbookMessage $message) : string {
        return (
            "<div class='guestbookEntry'>
                <div class='userName'>
                    {$message->getAuthor()->getName()}
                </div>
                <div class='message'>
                    {$message->getMessage()}
                </div>
            </div>"
        );
    }
    
    // crud
    
    public function getDataFromFile() : array {
        $guestbookData = (array) json_decode(file_get_contents($this->filePath), true);
        
        $entryArray = array();
        
        // gets array of authors, foreach, make new author with array of entries, foreach, make new guestbookEntry
        foreach($guestbookData as $entry) {
            array_push($entryArray, new Author(
                $entry["firstName"],
                $entry["lastName"],
                $entry["messages"]
            ));
        }
        return $entryArray;
    }

    function saveDataToFile(array $authors) {
        $guestbookData = array();

        foreach($authors as $author) {
            array_push($guestbookData, $author->jsonSerialize());
        }

        file_put_contents($this->filePath, json_encode($authors));
    }
    
    public function addGuestbookEntry(array $request) {
        $authors = $this->getDataFromFile();
        $author = $this->findAuthorByName($authors, $request["firstName"], $request["lastName"]);
        if($author == null) {
            $newAuthor = new Author($request["firstName"], $request["lastName"], array());
            array_push($authors, $newAuthor);
            $author = $newAuthor;
        }

        $author->createMessage($request["message"]);

        $this->saveDataToFile($authors);
    }
    
    public function deleteGuestbookEntry(string $message) {
        // find entry by message & delete from data
    }

    function findAuthorByName(array $authors, string $firstName, string $lastName) {
        foreach($authors as $author) {
            if($author->checkName($firstName, $lastName)) {
                return $author;
            }
        }
        return null;
    }
}