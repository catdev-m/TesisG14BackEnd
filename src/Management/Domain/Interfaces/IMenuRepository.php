<?php

namespace Memories\Management\Domain\Interfaces;

use Illuminate\Support\Collection;

interface IMenuRepository{
    function getAll():Collection;
    function searchMenusByRolId(string $rolId):Collection;
}