<?php

namespace App\Service;

use Psr\Log\LoggerInterface;

class MessageGenerator
{

    private $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function getCrazyMessage()
    {
        $this->logger->info('About to find a happy message!');
        // ...
    }

    public function getHappyMessage(?string $name = null)
    {
        $messages = [
            'You did it! You updated the system! Amazing!',
            'That was one of the coolest updates I\'ve seen all day!',
            'Great work! Keep going!',
        ];
        $index = array_rand($messages);

        return $messages[$index].((null === $name) ? '' : ' Welcome '.$name.'!');
    }
}