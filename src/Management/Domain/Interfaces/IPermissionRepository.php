<?php
namespace Memories\Management\Domain\Interfaces;

use Illuminate\Support\Collection;
use Memories\Management\Domain\Entities\PermissionRol;

interface IPermissionRepository{

    function fetchAll():Collection;
    function addRolPermission(PermissionRol $permissionRol):bool;
    function removeRolPermission(PermissionRol $permissionRol):bool;
    function getPermissionByRolId(string $rolCode):Collection;
}
