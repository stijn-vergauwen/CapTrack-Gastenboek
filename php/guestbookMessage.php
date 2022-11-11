<?php
require("message.php");

class GuestbookMessage implements Message, JsonSerializable {
    private $author;
    private $message;
    private $createdTime;

    function __construct(Author $author, string $message) {
        $this->author = $author;
        $this->message = $message;
        $this->createdTime = "not implemented";
    }
  
    public function getAuthor() : Author {
        return $this->author;
    }

    public function getMessage() : string {
        return $this->message;
    }

    public function getTimeOfCreation() : string {
        return $this->createdTime;
    }
    
    public function jsonSerialize() : array {
        return [
            "message" => $this->message,
            "createdTime" => $this->createdTime
        ];
    }
}