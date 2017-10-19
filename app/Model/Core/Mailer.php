<?php

namespace App\Model\Core;

class Mailer
{
    /**
     * Dependency container provided by Slim
     * @var \Slim\Container
     */
    protected $container;

    /**
     * Mail settings
     * @var array
     */
    protected $data;

    /**
     * Save dependency container and mail settings
     * @param \Slim\App $app slim application
     */
    public function __construct($container)
    {
        $this->container = $container;

        $this->data = $this->ci->get('settings')['mail'];
    }

    /**
     * Configure PHPMailer according to environment and application requirements
     * @param  \PHPMailer $mailer PHPMailer instance to be configured
     * @return \PHPMailer         PHPMailer instance configured
     */
    public function configure($mailer)
    {
        if ($this->validateSmtp()) {
            $mailer->isSmtp();
            $mailer->SMTPAuth = true;

            $mailer->Host       = $this->data['smtp']['host'];
            $mailer->Username   = $this->data['smtp']['user'];
            $mailer->Password   = $this->data['smtp']['password'];
            $mailer->SMTPSecure = $this->data['smtp']['protocol'];
            $mailer->Port       = $this->data['smtp']['port'];
        } else {
            $this->container->monolog->warning("SMTP is not enabled. Sending mail can work better if SMTP is properly configured.");
        }

        return $mailer;
    }

    /**
     * Validate SMTP information
     * @return boolean valid information or not
     */
    private function validateSmtp()
    {
        if (empty($this->data['smtp']['host'])) {
            return false;
        }

        if (empty($this->data['smtp']['user'])) {
            return false;
        }

        if (empty($this->data['smtp']['password'])) {
            return false;
        }

        if (empty($this->data['smtp']['protocol'])) {
            return false;
        }

        if ($this->data['smtp']['protocol'] != 'ssl' && $this->data['smtp']['protocol'] != 'tls') {
            return false;
        }

        if (empty($this->data['smtp']['port'])) {
            return false;
        }

        return true;
    }

    /**
     * Get PHPMailer instance properly configured
     * @return \PHPMailer
     */
    public function getMailer()
    {
        $mailer = new \PHPMailer;
        $mailer = $this->configure($mailer);

        return $mailer;
    }
}
