<?php

namespace App\Actions;

interface Action
{
    public function __construct($title, $action);

    public function getTitle();
    public function getAction();
}