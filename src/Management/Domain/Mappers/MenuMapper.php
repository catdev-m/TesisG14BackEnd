<?php

namespace Memories\Management\Domain\Mappers;

use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Memories\Management\Domain\Entities\Menu;

class MenuMapper{

    public static function fromRequestToCollection(Request $request):array{
        return array();
    }

    public static function fromSingleRaw($raw):?Menu{
        if($raw == null)
            return null;
        return new Menu(
            code:$raw->code,
            name:$raw->name,
            url:$raw->url,
            active:$raw->active,
            createdAt:new DateTime($raw->created_at),
            parent:$raw->parent,
            icon:$raw->icon
        );
    }

    public static function fromCollectionRaw(Collection $raw):Collection{
        $list = collect();
        foreach($raw as $item){
            $list->push(MenuMapper::fromSingleRaw($item));
        }
        return $list;
    }



}
