<?php

namespace App\Service;

class Cook
{

    /**
     * @var Test
     */
    private $test;

    /**
     * @var string
     */
    private $myName;

    /**
     * Cook constructor.
     *
     * @param Test $test
     * @param string     $myName
     */
    public function __construct(Test $test, string $myName)
    {
        $this->test = $test;
        $this->myName = $myName;
    }

    /**
     * French fries
     *
     */
    public function fry(): void
    {
        echo "My name is {$this->myName}! ";
        $this->test->trythis();
    }

    /**
     * Ring the bell!!!
     * 
     * @param string $key
     */
    public function ring(string $key): void
    {
        echo $key.'!!! ';
    }

}