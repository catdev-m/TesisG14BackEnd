<?php

namespace Memories\Management\Infrastructure\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Memories\Management\Domain\Mappers\MenuMapper;
use Memories\Management\Domain\Interfaces\IMenuRepository;

class MenuRepository implements IMenuRepository{

    public function getAll():Collection{
        $res =  DB::table("menus")
                    ->where('active',true)
                    ->get();
        return MenuMapper::fromCollectionRaw($res);
    }

    public function searchMenusByRolId(string $rolId):Collection{
        $res = DB::table("menus_rol")
                    ->join('menus','menus_rol.menu_code','=','menus.code')
                    ->where('menus_rol.rol_code','=',$rolId)
                    ->select('menus.*')
                    ->get();
        return MenuMapper::fromCollectionRaw($res);
    }

}
