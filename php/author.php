<?php

class Author implements JsonSerializable {
    private $firstName;
    private $lastName;
    private $messages;

    function __construct(string $firstName, string $lastName, array $messages) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->setMessagesFromArray($messages);
    }
  
    function setMessagesFromArray(array $messagesArray) {
        $this->messages = array();

        foreach($messagesArray as $message) {
            array_push($this->messages, new GuestbookMessage($this, $message));
        }
    }

    public function createMessage(string $message) {
        array_push($this->messages, new GuestbookMessage($this, $message));
    }

    public function getMessages() : array {
        return $this->messages;
    }

    public function getName() : string {
        return $this->firstName . " " . $this->lastName;
    }

    public function checkName(string $firstName, string $lastName) : bool {
        return ($this->firstName == $firstName && $this->lastName == $lastName);
    }
    
    public function jsonSerialize() : mixed {
        return [
            "firstName" => $this->firstName,
            "lastName" => $this->lastName,
            "messages" => array_map(fn($message) : string => $message->jsonSerialize(), $this->messages)
        ];
    }
}