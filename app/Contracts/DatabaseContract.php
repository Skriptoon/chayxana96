<?php

namespace App\Contracts;

interface DatabaseContract {

    //public function save();
    public function get($where = null);
}