<?php

namespace Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class ExampleCommand extends Command
{
    protected $commandName = 'hello:world';
    protected $commandDescription = "Says hello world";

    protected $arguments = [
    ];

    protected function configure()
    {
        $this->setName($this->commandName)
        ->setDescription($this->commandDescription);

        foreach ($this->arguments as $arg) {
            $required = ($arg['required']) ? InputArgument::REQUIRED : InputArgument::OPTIONAL;

            $this->addArgument($arg['name'], $required, $arg['description']);
        }
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('Hello world!');
    }
}
