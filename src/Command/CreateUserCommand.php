<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Output\OutputInterface;

use App\Service\MessageGenerator;

class CreateUserCommand extends Command
{

    private $messageGenerator;

    public function __construct(MessageGenerator $messageGenerator)
    {
        $this->messageGenerator = $messageGenerator;

        parent::__construct();
    }

    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:create-user')
            // the short description shown while running "php bin/console list"
            ->setDescription('Creates a new user.')
            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp('This command allows you to create a user...');
        $this
            // configure an argument
            ->addArgument('username', InputArgument::REQUIRED, 'The username of the user.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(['User Creator', '============']);

        // retrieve the argument value using getArgument()
        //$output->writeln('Username: '.$input->getArgument('username'));

        $output->writeln($this->messageGenerator->getHappyMessage($input->getArgument('username')));

    }
}