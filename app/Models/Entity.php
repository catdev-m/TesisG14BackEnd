<?php

namespace App\Models;

abstract class Entity{
    abstract public function toArray():array;
}