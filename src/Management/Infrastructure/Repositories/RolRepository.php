<?php

namespace Memories\Management\Infrastructure\Repositories;

use Illuminate\Support\Facades\DB;
use Memories\Management\Domain\Entities\Rol;
use Memories\Management\Domain\Entities\RolMenu;
use Memories\Management\Domain\Interfaces\IRolRepository;
use Memories\Management\Domain\Mappers\RolMapper;


class RolRepository implements IRolRepository {

    private $table='roles';

    public function list():array{
        $roles = DB::table('roles')
                    ->where('editable',true)
                    ->get();
        return RolMapper::fromCollectionRaw($roles);
    }

    public function create(Rol $rol):bool{
        $res = DB::table('roles')
                    ->insert([
                        'rolid'=> $rol->getRolId(),
                        'name'=>    $rol->getName(),
                        'description'=>$rol->getDescription(),
                        'active'=>$rol->isActive(),
                        'editable'=>$rol->isEditable(),
                        'datecreated'=>$rol->getDateCreated(),
                        'dateupdated'=>$rol->getDateUpdated()
                    ]);
        return true;
    }

    public function findById(string $rolId):?Rol{
        
        $rol = DB::table($this->table)
                ->where('rolid','=',$rolId)
                ->first();

        if($rol != null){
            return RolMapper::fromSingleRaw($rol);
        }
        return null;
    }

    public function update(Rol $rol):bool{
        DB::table("roles")
            ->where('rolid',$rol->getRolId())
            ->update([
                'name'=>$rol->getName(),
                'active'=>$rol->isActive(),
                'description'=>$rol->getDescription(),
                'dateupdated'=>$rol->getDateUpdated()
            ]);
        return true;
    }

    public function searchByIdOrName(string $name,string $rolId):?Rol{
        $raw = DB::table('roles')
            ->where('rolid','=',$rolId)
            ->orWhere('name','=',$name)
            ->first();
        return $raw == null ? null:RolMapper::fromSingleRaw($raw);
    }

    public function serachByNameWithoutId(string $name,string $rolId):?Rol{
        $raw = DB::table('roles')
            ->where('rolid','<>',$rolId)
            ->where('name','=',$name)
            ->first();
        return $raw == null ? null:RolMapper::fromSingleRaw($raw);
    }

    public function addMenuRol(RolMenu $rm): bool
    {
        DB::table('menus_rol')
            ->insert([
                "code"=>$rm->getCode(),
                "rol_code"=>$rm->getRolCode(),
                "menu_code"=>$rm->getMenuCode(),
                'created_at'=>$rm->getCreatedAt()
            ]);
        return true;
    }

    public function removeMenuRol(RolMenu $menuRol): bool
    {
        DB::table('menus_rol')
            ->where('rol_code','=',$menuRol->getRolCode())
            ->where('menu_code','=',$menuRol->getMenuCode())
            ->delete();
        return true;
    }

    public function updatePermissions():bool{
        return true;
    }
    public function updateMenus():bool{
        return false;
    }
}