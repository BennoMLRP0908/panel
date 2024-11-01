<?php

namespace SneakyPanel\Exceptions\Service\Database;

use SneakyPanel\Exceptions\SneakyPanelException;

class DatabaseClientFeatureNotEnabledException extends SneakyPanelException
{
    public function __construct()
    {
        parent::__construct('Client database creation is not enabled in this Panel.');
    }
}
