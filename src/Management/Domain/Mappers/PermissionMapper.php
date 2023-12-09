<?php
namespace Memories\Management\Domain\Mappers;

use DateTime;
use Illuminate\Support\Collection;
use Memories\Management\Domain\Entities\Permission;

class PermissionMapper{

    public static function rawToEntity($raw):Permission{
        return new Permission(
            code:$raw->code,
            identifier:$raw->identifier,
            name:$raw->name,
            menu:$raw->menu,
            createdAt:new DateTime($raw->created_at)
        );
    }

    public static function rawToCollection(Collection $raw):Collection{
        $list = collect();
        foreach($raw as $item){
            $list->push(PermissionMapper::rawToEntity($item));
        }
        return $list;
    }
}
