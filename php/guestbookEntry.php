<?php

interface Message {
    public function getAuthor() : Author;
    public function getMessage() : string;
}

class GuestbookEntry implements Message, JsonSerializable {
    private $author;
    private $message;
    // private $timeOfCreation; // komt later wel

    function __construct(Author $author, string $message) {
        $this->author = $author;
        $this->message = $message;
    }
  
    // Methods
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