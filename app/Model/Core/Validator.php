<?php

namespace App\Model\Core;

class Validator
{
    /**
     * Slim DI Container
     * @var \Slim\Container
     */
    protected $ci;

    /**
     * Error messages
     * @var array
     */
    private $errors = array();

    /**
     * Constructor
     *
     * @param \Slim\Container $ci Slim DI Container
     */
    public function __construct($ci)
    {
        $this->ci = $ci;
    }

    /**
     * Add new error message
     * @param string $message error message
     */
    public function addError($message)
    {
        $this->errors[] = $message;
    }

    /**
     * Check if instance constains error
     * @return boolean constains error
     */
    public function error()
    {
        return (boolean) count($this->errors);
    }

    /**
     * Get error messages
     * @return array error messages
     */
    public function getErrors()
    {
        return $this->errors;
    }
}
