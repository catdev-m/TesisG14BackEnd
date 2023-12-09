<?php

namespace Memories\Management\Domain\Mappers;

use DateTime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Memories\Management\Domain\Entities\Rol;
use Illuminate\Support\Collection;

class RolMapper {

    public static function fromRequest(Request $request,?int $rolId=null): Rol{

        $res = new Rol(
            rolId:$request->string('rolId'),
            name:$request->string('name'),
            active:$request->boolean('active'),
            editable:true,
            description:$request->string('description'),
            dateCreated:Carbon::now(),
            dateUpdated:Carbon::now()
        );
        return $res;
    }

    public static function fromSingleRaw($rol):Rol{
        return new Rol(
            rolId:$rol->rolid,
            name:$rol->name,
            active:$rol->active,
            description:$rol->description,
            editable:$rol->editable,
            dateCreated: new DateTime($rol->datecreated),
            dateUpdated:new DateTime($rol->dateupdated)
        );
    }

    public static function fromCollectionRaw($raw):array{
        $list = array();
        foreach($raw as $item){
            array_push($list,RolMapper::fromSingleRaw($item));
        }
        return $list;
    }

    public static function fromRawToSingleArray(Collection $raw):Collection{
        $list = collect();
        foreach($raw as $item){
            $list->push($item->rolid);
        }
        return $list;
    }

    public static function fromRawToCollection(Collection $raw):Collection{
        $list = Collect();
        foreach($raw as $item){
            $list->push(RolMapper::fromSingleRaw($item));
        }
        return $list;
    }
}
