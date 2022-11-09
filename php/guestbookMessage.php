<?php
require("message.php");

class GuestbookMessage implements Message, JsonSerializable {
    private $author;
    private $message;
    // private $timeOfCreation; // komt later wel

    function __construct(Author $author, string $message) {
        $this->author = $author;
        $this->message = $message;
    }
  
    public function getAuthor() : Author {
        return $this->author;
    }

    public function getMessage() : string {
        return $this->message;
    }
    
    public function jsonSerialize() : mixed {
        return $this->message;
    }
}