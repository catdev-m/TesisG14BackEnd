<?php
namespace Memories\Management\Domain\Mappers;

use Exception;
use Illuminate\Http\Request;
use Memories\Management\Domain\Entities\RolUser;

class RolUserMapper{

    public static function fromRequestToEntity(Request $req, string $userId):RolUser{
        if(!$req->hasAny(['code','rol_id','user_id']))
            throw new Exception('Bad request');
        return new RolUser(
            code:$req->string('code'),
            rolId:$req->string('rolId'),
            userId:$req->string('userId')
        );
    }
}
