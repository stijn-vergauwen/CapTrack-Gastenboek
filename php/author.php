<?php
require("user.php");

class Author implements User, JsonSerializable {
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
            array_push($this->messages, new GuestbookMessage($message["id"], $this, $message["message"], $message["createdTime"]));
        }
    }

    public function createMessage(string $message) {
        array_push($this->messages, new GuestbookMessage(uniqid(rand()), $this, $message, time()));
    }

    public function deleteMessageAtIndex(string $indexToDelete) {
        unset($this->messages[$indexToDelete]);
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
    
    public function jsonSerialize() : array {
        return [
            "firstName" => $this->firstName,
            "lastName" => $this->lastName,
            "messages" => array_map(fn($message) : array => $message->jsonSerialize(), $this->messages)
        ];
    }
}