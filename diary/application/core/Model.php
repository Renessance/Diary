<?php
declare(strict_types=1);

namespace application\core;

use application\lib\Db;

abstract class Model
{

    public $db;

    public function __construct()
    {
        $this->db = new Db;
    }
}
