<?php
namespace Memories\Management\Domain\Mappers;

use Illuminate\Support\Collection;
use Memories\Auth\Domain\Entities\UserState;
use Memories\Management\Domain\Entities\TUser;
use DateTime;

class UserMapper{
    public static function fromRawToEntity($raw):?TUser{
        if(is_null($raw))
            return null;
        return new TUser(
            userId:$raw->user_id,
            name:$raw->name,
            email:$raw->email,
            createdAt:new DateTime($raw->created_at),
            updatedAt:new DateTime($raw->updated_at),
            state:new UserState(
                stateId:$raw->state_id,
                name:$raw->state_name
            )
        );
    }

    public static function fromRawToCollection(Collection $raw):Collection{
        $list = collect();
        foreach($raw as $item){
            $list->push(UserMapper::fromRawToEntity($item));
        }
        return $list;
    }
}
