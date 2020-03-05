<?php

namespace App\Actions;

class NewQuoteAction implements Action
{
    private $title;

    private $action;

    public function __construct($title, $action)
    {
        $this->title = $title;
        $this->action = $action;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }
}