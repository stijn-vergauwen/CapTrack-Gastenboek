<?php
require("message.php");

class GuestbookMessage implements Message, JsonSerializable {
    private $id;
    private $author;
    private $message;
    private $createdTime;

    function __construct(string $id, Author $author, string $message, int $createdTime) {
        $this->id = $id;
        $this->author = $author;
        $this->message = $message;
        $this->createdTime = $createdTime;
    }

    public function getId() : string {
        return $this->id;
    }
  
    public function getAuthor() : Author {
        return $this->author;
    }

    public function getMessage() : string {
        return $this->message;
    }

    public function getCreatedTime() : string {
        return date("j F Y - H:i", $this->createdTime);
    }

    public function getTimestamp() : int {
        return $this->createdTime;
    }
    
    public function jsonSerialize() : array {
        return [
            "id" => $this->id,
            "createdTime" => $this->createdTime,
            "message" => $this->message
        ];
    }
}