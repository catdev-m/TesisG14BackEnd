<?php
namespace Memories\Auth\Infrastructure\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Memories\Auth\Domain\Entities\User;
use Memories\Auth\Domain\Interfaces\IUserRepository;
use Memories\Auth\Domain\Mappers\UserAuthMapper;
use Memories\Management\Domain\Mappers\MenuMapper;
use Memories\Management\Domain\Mappers\PermissionMapper;
use Memories\Management\Domain\Mappers\RolMapper;

class UserRepository implements IUserRepository
{

    public function getUserByEmail(string $email): ?User{
        $raw = DB::table('users')
                    ->join('user_states','users.state_id','user_states.state_id')
                    ->where('users.email','=',$email)
                    ->select('users.*','user_states.state_id','user_states.name as state_name')
                    ->first();
        return UserAuthMapper::fromRawToEntity($raw);
    }

    public function getRoles(string $userId): Collection{
        $raw = DB::table('roles')
                    ->join('roles_user','roles.rolid','roles_user.rol_id')
                    ->where('roles_user.user_id','=',$userId)
                    ->where('roles.active','=',true)
                    ->select('roles.rolid')
                    ->get();

        return RolMapper::fromRawToSingleArray($raw);
    }

    public function getPermissions(Collection $rolList): Collection
    {
        $raw = DB::table('permissions')
                ->join('permissions_rol','permissions.code','permissions_rol.permission_code')
                ->whereIn('permissions_rol.rol_code',$rolList->all())
                ->select('permissions.*')->get();
        return PermissionMapper::rawToCollection($raw);
    }

    public function getMenus(Collection $rolList): Collection{
        $raw = DB::table('menus')
                ->join('menus_rol','menus.code','menus_rol.menu_code')
                ->whereIn('menus_rol.rol_code',$rolList->all())
                ->select('menus.*')->get();
        return MenuMapper::fromCollectionRaw($raw);
    }
}
