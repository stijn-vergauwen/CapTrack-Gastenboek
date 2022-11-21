<?php

class Guestbook {
    private $filePath;

    function __construct(string $filePath) {
        $this->filePath = $filePath;
    }

    // creating html
    
    public function getMessagesAsHTML() : string {
        $authors = $this->getDataFromFile();
        $list = ""; 
    
        foreach($authors as $author) {
            foreach($author->getMessages() as $message) {
                $list .= $this->createMessageHTML($message);
            }
        }

        if($list == "") $list = "<p class='text-center'>er zijn nog geen berichten geplaatst.</p>";
        
        return $list;
    }
    
    private function createMessageHTML(GuestbookMessage $message) : string {
        return (
            "<form class='guestbook-entry' action='' method='post'>
                <input type='hidden' name='messageId' value='{$message->getId()}'>
                <div class='author-name'>
                    {$message->getAuthor()->getName()}
                </div>
                <div class='message-created-time'>
                    geplaatst op {$message->getTimeOfCreation()}
                </div>
                <div class='message'>
                    {$message->getMessage()}
                </div>
                <input class='btn-delete-message' type='submit' value='X'>
            </form>"
        );
    }
    
    // load / save to file
    
    public function getDataFromFile() : array {
        $guestbookData = (array) json_decode(file_get_contents($this->filePath), true);
        $authors = array();
        
        foreach($guestbookData as $author) {
            array_push($authors, new Author(
                $author["firstName"],
                $author["lastName"],
                $author["messages"]
            ));
        }
        return $authors;
    }

    function saveDataToFile(array $authors) {
        $guestbookData = array();

        foreach($authors as $author) {
            array_push($guestbookData, $author->jsonSerialize());
        }

        file_put_contents($this->filePath, json_encode($authors));
    }

    // crud
    
    public function addGuestbookMessage(array $request) {
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
    
    public function deleteGuestbookMessage(string $messageId) {
        $authors = $this->getDataFromFile();

        foreach($authors as $author) {
            $messages = $author->getMessages();
            $hasFoundMessage = false;

            for($i = 0; $i < count($messages); $i++) {
                if($messages[$i]->getId() == $messageId) {
                    $author->deleteMessageAtIndex($i);
                    $hasFoundMessage = true;
                }
                if($hasFoundMessage) break;
            }
            if($hasFoundMessage) break;
        }

        $this->saveDataToFile($authors);
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