<?php

interface User {
    public function getName() : string;
    public function checkName(string $firstName, string $lastName) : bool;
}