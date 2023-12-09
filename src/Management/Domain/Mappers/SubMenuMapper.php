<?php
namespace Memories\Management\Domain\Mappers;

use DateTime;
use Illuminate\Support\Collection;
use Memories\Management\Domain\Entities\SubMenu;

class SubMenuMapper{

    public static function fromSingleRaw($raw):?SubMenu{
        if($raw == null)
            return null;
        
        return new SubMenu(
            code:$raw->code,
            name:$raw->name,
            url:$raw->url,
            createdAt:new DateTime($raw->created_at),
            parent:$raw->parent
        );
    }

    public static function fromCollectionRaw(Collection $raw):Collection{
        $list = collect();
        foreach($raw as $item){
            $list->push(SubMenuMapper::fromSingleRaw($item));
        }
        return $list;
    }
}