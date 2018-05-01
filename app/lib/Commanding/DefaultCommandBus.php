<?php
/**
 * Created by PhpStorm.
 * User: Angel
 * Date: 07/05/2015
 * Time: 12:40
 */

namespace Chicane\Commanding;


use Illuminate\Foundation\Application;

class DefaultCommandBus implements CommandBus{

    protected $app;
    protected $commandTranslator;

    /**
     * CommandBus constructor.
     * @param $commandTranslator
     */
    public function __construct(Application $app, CommandTranslator $commandTranslator)
    {
        $this->app = $app;
        $this->commandTranslator = $commandTranslator;
    }


    public function execute($command)
    {
        $handler = $this->commandTranslator->toCommandHandler($command);

        return $this->app->make($handler)->handle($command);
    }
}