<?php

namespace Script\Utils\Interfaces;

use Monolog\Logger;

interface Runnable
{
    public function run(): void;

    public function getLogger(): Logger;
}