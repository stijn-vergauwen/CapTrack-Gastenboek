<?php

interface Message {
    public function getAuthor() : Author;
    public function getMessage() : string;
}