<?php

namespace Memories\Management\Domain\Interfaces;

use Memories\Management\Domain\Entities\Rol;
use Memories\Management\Domain\Entities\RolMenu;

interface IRolRepository{

    function create(Rol $rol):bool;
    function list():array;
    function update(Rol $rol):bool;
    function findById(string $rolId):?Rol;
    function searchByIdOrName(string $name,string $rolId);
    function serachByNameWithoutId(string $name, string $rolId);
    function updateMenus():bool;
    function updatePermissions():bool;
    function removeMenuRol(RolMenu $menuRol):bool;
    function addMenuRol(RolMenu $rm):bool;
}