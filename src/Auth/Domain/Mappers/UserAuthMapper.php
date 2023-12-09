<?php
namespace Memories\Auth\Domain\Mappers;

use Memories\Auth\Domain\Entities\User;
use Memories\Auth\Domain\Entities\UserState;

class UserAuthMapper
{

    public static function  fromRawToEntity($raw):?User{
        if($raw == null)
            return null;

        $entity = new User(
            userId:$raw->user_id,
            user:$raw->name,
            email:$raw->email,
            state: new UserState(
                stateId:$raw->state_id,
                name:$raw->state_name
                )
            );
        return $entity;
    }
}
