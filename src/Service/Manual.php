<?php

namespace App\Service;


class Manual
{

    private $name;

    private $test;

    private $terrorist;

    public function __construct(Test $test, $terrorist)
    {
        $this->name = 'Larry';
        $this->test = $test;
        $this->terrorist = $terrorist;
    }

    public function run(): void
    {
        echo 'Manual running with '.$this->name.'...';
        $this->test->trythis($this->terrorist);
    }

}