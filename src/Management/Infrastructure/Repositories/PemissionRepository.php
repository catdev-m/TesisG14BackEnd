<?php
namespace Memories\Management\Infrastructure\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Memories\Management\Domain\Entities\PermissionRol;
use Memories\Management\Domain\Interfaces\IPermissionRepository;
use Memories\Management\Domain\Mappers\PermissionMapper;

class PemissionRepository implements IPermissionRepository{

    private $table = 'permissions';

    public function fetchAll():Collection{
        $raw = DB::table($this->table)
                    ->where('active','=',true)
                    ->get();
        return PermissionMapper::rawToCollection($raw);
    }

    public function addRolPermission(PermissionRol $permissionRol):bool
    {
        DB::table('permissions_rol')
                ->insert([
                    'code'=>$permissionRol->getCode(),
                    'rol_code'=>$permissionRol->getRolCode(),
                    'permission_code'=>$permissionRol->getPermissionCode(),
                    'created_at'=>$permissionRol->getCreatedAt()
                ]);
        return true;
    }

    public function removeRolPermission(PermissionRol $permissionRol): bool
    {
        DB::table('permissions_rol')
                ->where('rol_code','=',$permissionRol->getRolCode())
                ->where('permission_code','=',$permissionRol->getPermissionCode())
                ->delete();
        return true;
    }

    public function    getPermissionByRolId(string $rolCode):Collection{
        $res = DB::table("permissions_rol")
        ->join('permissions','permissions_rol.permission_code','=','permissions.code')
        ->where('permissions_rol.rol_code','=',$rolCode)
        ->select('permissions.*')
        ->get();
        return PermissionMapper::rawToCollection($res);
    }
}
