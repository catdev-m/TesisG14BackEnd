<?php

namespace Memories\Auth\Domain\Interfaces;

use Memories\Auth\Domain\Entities\User;
use Illuminate\Support\Collection;

interface IUserRepository
{
    /**
     * Retrive user by email.
     * @return Memories\Auth\Domain\Entities\User
     */
    function getUserByEmail(string $email):?User;

    /**
     * Retrive menus of user by email.
     * @return Illuminate\Database\Eloquent\Collection
     */
    function getPermissions(Collection $rolList):Collection;

    /**
     * Retrive menus of user by email.
     * @return Illuminate\Database\Eloquent\Collection
     */
    function getMenus(Collection $rolList):Collection;

    /**
     * Retrive the roles list from db from user espcified
     *
     */
    function getRoles(string $userId):Collection;

}
