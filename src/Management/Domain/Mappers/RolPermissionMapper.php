<?php

namespace Memories\Management\Domain\Mappers;

use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Memories\Management\Domain\Entities\PermissionRol;

class RolPermissionMapper{

    public static function fromRequestToEntity(Request $request):PermissionRol{
        if(!$request->hasAny(['code','rolCode','permissionCode']))
            throw new Exception('Not provider any parameters');

        return new PermissionRol(
            code:$request->string('code'),
            rolCode:$request->string('rolCode'),
            permissionCode:$request->string('permissionCode'),
            createdAt:Carbon::now()
        );
    }
}
