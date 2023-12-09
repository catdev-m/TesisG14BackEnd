<?php

namespace Memories\Management\Domain\Interfaces;

use Illuminate\Support\Collection;
use Memories\Management\Domain\Entities\RolUser;

interface ITUserRepository{
    /**
     * Recupera los usuarios de la tabla correspondiente, ignora los usuarios privados
     * @return Illuminate\Support\Collection
     */

    function fetchAll():Collection;
    /**
     * Crea un registro de rol de usuario en la tabla correspondiente
     * @param Memories\Management\Domain\Entities\RolUser
     * @return bool
     */
    function insertUserRol(RolUser $rolUser):bool;
    /**
     * Remueve un registro de rol de usuario de la tabla correspondiente
     * @param Memories\Management\Domain\Entities\RolUser
     * @return bool
     */
    function removeUserRol(RolUser $rolUser):bool;

    /**
     * Recupera lista de roles que posee un usuario dado
     * @param string
     * @return Collection
     */
    function searchRolesByUserId(string $userId):Collection;
}
