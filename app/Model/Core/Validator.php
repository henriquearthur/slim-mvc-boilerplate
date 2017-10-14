<?php

namespace App\Model\Core;

class Validator
{
    protected $ci;

    private $errors = array();

    public function __construct($ci)
    {
        $this->ci = $ci;
    }

    public function addError($message)
    {
        $this->errors[] = $message;
    }

    public function error()
    {
        return (boolean) count($this->errors);
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
