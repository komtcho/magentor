<?php

namespace App\Commands;

use LaravelZero\Framework\Commands\Command;

abstract class CommandMage extends Command
{
    public $magento_root;
    public $moudles_pool;

    public function __construct()
    {
        $this->magento_root = base_path();
        $this->moudles_pool = 'app/code';

        parent::__construct();
    }
}
