<?php

namespace App\Service;


class Test
{

    private $mess;

    public function __construct(MessageGenerator $messageGenerator)
    {
        $this->mess = $messageGenerator;
    }

    public function trythis($name = 'Anonym'): void
    {
        $message = $this->mess->getHappyMessage();
        echo $message.' !Have some fun with '.$name;
    }

}