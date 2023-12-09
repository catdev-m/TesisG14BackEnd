<?php
namespace Memories\Management\Infrastructure\Repositories;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Memories\Management\Domain\Entities\RolUser;
use Memories\Management\Domain\Interfaces\ITUserRepository;
use Memories\Management\Domain\Mappers\RolMapper;
use Memories\Management\Domain\Mappers\UserMapper;

class TUserRepository implements ITUserRepository{

    public  function fetchAll():Collection{
        $raw = DB::table('users')
        ->join('user_states','users.state_id','user_states.state_id')
        ->select('users.*','user_states.state_id','user_states.name as state_name')
        ->get();

        return UserMapper::fromRawToCollection($raw);

    }

    public function insertUserRol(RolUser $rolUser):bool{
        DB::table('roles_user')
            ->insert([
                "code"=>$rolUser->getCode(),
                "rol_id"=>$rolUser->getRolid(),
                "user_id"=>$rolUser->getUserId(),
                "created_at"=>$rolUser->getCreatedAt()
            ]);
        return true;
    }

    public function removeUserRol(RolUser $rolUser):bool{
        DB::table('roles_user')
            ->where('user_id','=',$rolUser->getUserId())
            ->where('rol_id','=',$rolUser->getRolid())
            ->delete();
        return true;
    }

    public function searchRolesByUserId(string $userId):Collection{
        $raw = DB::table('roles_user')
            ->join('roles','roles_user.rol_id','roles.rolid')
            ->where('roles_user.user_id','=',$userId)
            ->select('roles.*')
            ->get();
        return RolMapper::fromRawToCollection($raw);
    }
}
