<?php

namespace App;

use App\Validation\InputValidator;
use Symfony\Component\Console\Application;

class ApplicationFactory
{
    public static function makeApplication(): Application
    {
        $main = new \App\MainCommand(new InputValidator());

        $application = new Application();
        $application->add($main);
        $application->setDefaultCommand($main->getName(), true);

        return $application;
    }
}
