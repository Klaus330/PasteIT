<?php


namespace app\middlewares;


abstract class Middleware
{
    protected array $actions;

    /**
     * Middleware constructor
     * @param array $actions
     */
    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }

    public abstract function execute();
}